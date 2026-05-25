<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes for SMK Banjar Asri Portal (CLEAN VERSION)
|--------------------------------------------------------------------------
|
| Only public routes here. Admin panel is handled by Filament.
|
*/

// =============================================================================
// í¿  HOMEPAGE
// =============================================================================
Route::get('/', [PublicController::class, 'home'])->name('home');

// =============================================================================
// í³‹ COMPANY PROFILE
// =============================================================================
Route::get('/profil', [PublicController::class, 'profile'])->name('profile');

Route::redirect('/visi-misi', '/profil#visi-misi', 301);
Route::redirect('/sejarah', '/profil#sejarah', 301);
Route::redirect('/struktur-organisasi', '/profil#struktur', 301);
Route::redirect('/fasilitas', '/profil#fasilitas', 301);
Route::redirect('/kontak', '/profil#kontak', 301);

// =============================================================================
// í¾“ JURUSAN
// =============================================================================
Route::prefix('jurusan')->name('jurusan.')->group(function () {
    Route::get('/', [PublicController::class, 'jurusan'])->name('index');

    Route::get('/{slug}', [PublicController::class, 'jurusanShow'])
        ->name('show')
        ->where('slug', 'teknik-jaringan-komputer-telekomunikasi|teknik-kendaraan-ringan|teknik-audio-video');
});

// =============================================================================
// í³° BERITA
// =============================================================================
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [PublicController::class, 'berita'])->name('index');

    Route::get('/{slug}', [PublicController::class, 'beritaShow'])
        ->name('show')
        ->where('slug', '[a-z0-9\-]+');
});

// =============================================================================
// í¶¼ï¸ GALERI & PORTAL
// =============================================================================
Route::get('/galeri', [PublicController::class, 'galeri'])->name('galeri');
Route::get('/portal', [PublicController::class, 'portal'])->name('portal');

Route::redirect('/sistem', '/portal', 301);
Route::redirect('/e-learning', 'https://learning.smkba.sch.id', 302);
Route::redirect('/pkl', 'https://pkl.smkba.sch.id', 302);
Route::redirect('/ujian', 'https://upin.smkba.sch.id', 302);
Route::redirect('/produktif', 'https://produktif.smkba.sch.id', 302);

// =============================================================================
//  API & SEO
// =============================================================================
Route::prefix('api')->name('api.')->group(function () {
    Route::post('/portal-click', [PublicController::class, 'trackPortalClick'])->name('portal-click');
    Route::get('/health', function () {
        return response()->json(['status' => 'ok', 'timestamp' => now()]);
    })->name('health');
});

Route::get('/sitemap.xml', [PublicController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [PublicController::class, 'robotsTxt'])->name('robots');

// =============================================================================
// í´„ LEGACY REDIRECTS
// =============================================================================
Route::redirect('/berita-kegiatan', '/berita', 301);
Route::redirect('/kompetensi-keahlian', '/jurusan', 301);
Route::redirect('/daftar-jurusan', '/jurusan', 301);

// =============================================================================
// âŒ FALLBACK
// =============================================================================
Route::fallback([PublicController::class, 'notFound'])->name('fallback');
