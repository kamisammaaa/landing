<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\PortalLink;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PublicController extends Controller
{
    protected int $cacheDuration = 300;

    protected function getSetting(string $key, string $default = ''): string
    {
        return Cache::remember(
            "setting_{$key}",
            $this->cacheDuration,
            function () use ($key, $default): string {
                return Setting::where('key', $key)
                    ->where('is_active', true)
                    ->value('value') ?? $default;
            }
        );
    }

    /**
     * FIX PHPStan:
     * @param array<string, mixed> $params
     */
    protected function makeCacheKey(string $prefix, array $params): string
    {
        ksort($params);

        return $prefix . '_' . md5(
            json_encode($params, JSON_THROW_ON_ERROR)
        );
    }

    public function home(): View
    {
        $data = Cache::remember('public_home_data', $this->cacheDuration, function (): array {
            return [
                'featuredPosts' => Post::where('status', 'published')
                    ->where('is_featured', true)
                    ->with('author:id,name')
                    ->latest()
                    ->take(3)
                    ->get(),

                'activeJurusan' => Jurusan::where('is_active', true)
                    ->orderBy('urutan')
                    ->take(4)
                    ->get(),

                'portalLinks' => PortalLink::where('is_visible', true)
                    ->where('status', 'active')
                    ->orderBy('urutan')
                    ->get(),

                'latestGallery' => Gallery::where('is_published', true)
                    ->latest()
                    ->take(8)
                    ->get(),
            ];
        });

        $data['school_name'] = $this->getSetting('school_name', 'SMK BANJAR ASRI');
        $data['school_address'] = $this->getSetting('school_address');

        view()->share('seo_title', $data['school_name'] . ' - Portal Resmi Sekolah');
        view()->share('seo_description', $this->getSetting('meta_description'));

        return view('pages.home', $data);
    }

    public function profile(): View
    {
        $schoolName = $this->getSetting('school_name', 'SMK BANJAR ASRI');

        $data = [
            'school_name' => $schoolName,
            'school_address' => $this->getSetting('school_address'),
            'school_phone' => $this->getSetting('school_phone'),
            'school_email' => $this->getSetting('school_email'),
            'meta_description' => $this->getSetting('meta_description'),
        ];

        view()->share('seo_title', 'Profil Sekolah - ' . $schoolName);
        view()->share('seo_description', $data['meta_description']);

        return view('pages.profile', $data);
    }

    public function jurusan(): View
    {
        $jurusans = Cache::remember('public_jurusan_list_data', $this->cacheDuration, function () {
            return Jurusan::where('is_active', true)
                ->orderBy('urutan')
                ->orderBy('nama')
                ->get();
        });

        view()->share('seo_title', 'Kompetensi Keahlian - ' . $this->getSetting('school_name'));
        view()->share('seo_description', 'Pilihan jurusan terbaik.');

        return view('pages.jurusan', compact('jurusans'));
    }

    public function jurusanShow(string $slug): View
    {
        $jurusan = Cache::remember("public_jurusan_{$slug}", $this->cacheDuration, function () use ($slug) {
            return Jurusan::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $jurusan->timestamps = false;
        $jurusan->increment('views');

        $related = Cache::remember(
            "public_jurusan_related_{$jurusan->id}",
            $this->cacheDuration,
            function () use ($jurusan) {
                return Jurusan::where('is_active', true)
                    ->where('id', '!=', $jurusan->id)
                    ->orderBy('urutan')
                    ->take(3)
                    ->get();
            }
        );

        view()->share('seo_title', 'Jurusan ' . $jurusan->nama);
        view()->share('seo_description', Str::limit(strip_tags($jurusan->deskripsi ?? ''), 160));

        return view('pages.jurusan-show', compact('jurusan', 'related'));
    }

    public function berita(Request $request): View
    {
        $kategori = $request->input('kategori');
        $search = $request->input('q');
        $page = (int) $request->input('page', 1);

        $cacheKey = $this->makeCacheKey('public_berita_page_' . $page, [
            'kategori' => $kategori,
            'search' => $search,
        ]);

        $posts = Cache::remember($cacheKey, $this->cacheDuration, function () use ($kategori, $search) {
            $query = Post::where('status', 'published')
                ->with('author:id,name');

            if (in_array($kategori, ['akademik', 'ekstrakurikuler', 'prestasi', 'pengumuman'], true)) {
                $query->where('kategori', $kategori);
            }

            if (is_string($search) && $search !== '') {
                $query->where(function ($q) use ($search): void {
                    $q->where('judul', 'LIKE', "%{$search}%")
                        ->orWhere('konten', 'LIKE', "%{$search}%");
                });
            }

            return $query->latest()->paginate(9);
        });

        $posts->withQueryString();

        view()->share('seo_title', 'Berita & Informasi - ' . $this->getSetting('school_name'));
        view()->share('seo_description', 'Berita terbaru sekolah.');

        return view('pages.berita', compact('posts'));
    }

    public function beritaShow(string $slug): View
    {
        $post = Cache::remember("public_berita_detail_{$slug}", $this->cacheDuration, function () use ($slug) {
            return Post::where('slug', $slug)
                ->where('status', 'published')
                ->with('author:id,name')
                ->firstOrFail();
        });

        $post->timestamps = false;
        $post->increment('views');

        $related = Cache::remember(
            "public_berita_related_{$post->kategori}_{$post->id}",
            $this->cacheDuration,
            function () use ($post) {
                return Post::where('status', 'published')
                    ->where('id', '!=', $post->id)
                    ->where('kategori', $post->kategori)
                    ->latest()
                    ->take(3)
                    ->get();
            }
        );

        view()->share('seo_title', $post->judul);
        view()->share('seo_description', Str::limit(strip_tags($post->konten ?? ''), 160));

        return view('pages.berita-show', compact('post', 'related'));
    }

    public function galeri(Request $request): View
    {
        $kategori = $request->input('kategori');
        $page = (int) $request->input('page', 1);

        $cacheKey = $this->makeCacheKey("public_galeri_page_{$page}", [
            'kategori' => $kategori,
        ]);

        $galleries = Cache::remember($cacheKey, $this->cacheDuration, function () use ($kategori) {
            $query = Gallery::where('is_published', true)
                ->with('jurusan:id,nama,kode');

            if (in_array($kategori, ['image', 'video'], true)) {
                $query->where('file_type', $kategori);
            }

            return $query->latest()->paginate(12);
        });

        $galleries->withQueryString();

        return view('pages.galeri', compact('galleries'));
    }

    public function portal(): View
    {
        $links = Cache::remember('public_portal_links_data', $this->cacheDuration, function () {
            return PortalLink::where('is_visible', true)
                ->where('status', 'active')
                ->orderBy('urutan')
                ->get();
        });

        return view('pages.portal', compact('links'));
    }

    public function trackPortalClick(Request $request): JsonResponse
    {
        $request->validate([
            'link_id' => 'required|integer|exists:portal_links,id',
        ]);

        PortalLink::where('id', $request->link_id)->increment('click_count');

        return response()->json(['success' => true]);
    }

    public function sitemap(): Response
    {
        $baseUrl = config('app.url');
        $lastMod = now()->toW3cString();

        $urls = collect([
            ['loc' => $baseUrl, 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('profile'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('jurusan'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route('berita'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('galeri'), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => route('portal'), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ]);

        $jurusans = Jurusan::where('is_active', true)->select('slug', 'updated_at')->get();
        foreach ($jurusans as $j) {
            $urls->push([
                'loc' => route('jurusan.show', $j->slug),
                'changefreq' => 'monthly',
                'priority' => '0.7',
                'lastmod' => $j->updated_at?->toW3cString() ?? $lastMod,
            ]);
        }

        $posts = Post::where('status', 'published')->select('slug', 'published_at')->latest()->take(100)->get();
        foreach ($posts as $p) {
            $urls->push([
                'loc' => route('berita.show', $p->slug),
                'changefreq' => 'monthly',
                'priority' => '0.6',
                'lastmod' => $p->published_at?->toW3cString() ?? $lastMod,
            ]);
        }

        $xml = \Illuminate\Support\Facades\View::make('sitemap.xml', compact('urls'))->render();

        return response($xml, 200)
            ->header('Content-Type', 'text/xml');
    }

    public function robotsTxt(): Response
    {
        return response(
            "User-agent: *\nAllow: /\nDisallow: /admin/\nSitemap: " . config('app.url') . "/sitemap.xml"
        )->header('Content-Type', 'text/plain');
    }

    public function notFound(): Response
    {
        return response()->view('errors.404', [], 404);
    }
}