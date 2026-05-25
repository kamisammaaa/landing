<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    // Set nilai default awal agar tidak bernilai null di layout Blade
/**
 * @var array{title: string, description: string}
 */
protected array $seoData = [
    'title' => 'SMK Banjar Asri',
    'description' => 'Website Resmi SMK Banjar Asri Cimaung Kab. Bandung',
];
    
    /**
     * Helper untuk dynamic SEO meta tags (Fluent Interface)
     * Sekaligus otomatis melakukan update ke View Share Laravel
     */
    protected function seo(): self
    {
        // Fungsi ini memastikan data SEO saat ini langsung terlempar ke View
        View::share('seo', $this->seoData);
        return $this;
    }

    public function title(string $title): self
    {
        $this->seoData['title'] = $title;
        
        // Daftarkan ulang ke view share agar nilainya terupdate secara realtime
        View::share('seo', $this->seoData);
        return $this;
    }

    public function description(string $desc): self
    {
        // PERBAIKAN: Fungsi pembersih dipindahkan langsung ke dalam method menggunakan Helper bawaan Laravel
        $cleanDesc = strip_tags($desc);
        $this->seoData['description'] = Str::limit($cleanDesc, 160, '');
        
        View::share('seo', $this->seoData);
        return $this;
    }

/**
 * @return array{title: string, description: string}
 */
protected function getSeoData(): array
{
    return $this->seoData;
}
}