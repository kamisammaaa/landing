{{-- SEO Meta Tags --}}
@php
    $seoTitle = $seo_title ?? (\App\Models\Setting::where('key', 'meta_title')->where('is_active', true)->value('value') ?? (\App\Models\Setting::where('key', 'school_name')->value('value') ?? 'SMK BANJAR ASRI') . ' - Portal Resmi');
    $seoDesc = $seo_description ?? (\App\Models\Setting::where('key', 'meta_description')->where('is_active', true)->value('value') ?? 'Mencetak Generasi Kompeten, Berkarakter, dan Siap Kerja di Era Digital.');
    $seoKeywords = \App\Models\Setting::where('key', 'meta_keywords')->where('is_active', true)->value('value') ?? 'SMK Banjar Asri, SMK Cimaung, TJKT, TKR, TAV, sekolah kejuruan Bandung';
    $ogImage = \App\Models\Setting::where('key', 'school_logo')->where('is_active', true)->value('value');
    $canonical = url()->current();
@endphp

<title>{{ $seoTitle }}</title>

{{-- Primary Meta --}}
<meta name="title" content="{{ Str::limit($seoTitle, 60) }}">
<meta name="description" content="{{ Str::limit($seoDesc, 160) }}">
<meta name="keywords" content="{{ $seoKeywords }}">
<meta name="author" content="{{ \App\Models\Setting::where('key', 'school_name')->value('value') ?? 'SMK BANJAR ASRI' }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $canonical }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:title" content="{{ Str::limit($seoTitle, 60) }}">
<meta property="og:description" content="{{ Str::limit($seoDesc, 160) }}">
<meta property="og:image" content="{{ $ogImage ? asset('storage/' . $ogImage) : asset('images/og-default.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:type" content="image/png">
<meta property="og:site_name" content="{{ \App\Models\Setting::where('key', 'school_name')->value('value') ?? 'SMK BANJAR ASRI' }}">
<meta property="og:locale" content="id_ID">

{{-- Twitter Card --}}
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $canonical }}">
<meta property="twitter:title" content="{{ Str::limit($seoTitle, 60) }}">
<meta property="twitter:description" content="{{ Str::limit($seoDesc, 160) }}">
<meta property="twitter:image" content="{{ $ogImage ? asset('storage/' . $ogImage) : asset('images/og-default.jpg') }}">

{{-- Schema.org JSON-LD (EducationalOrganization) --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ \App\Models\Setting::where('key', 'school_name')->value('value') ?? 'SMK BANJAR ASRI' }}",
  "url": "{{ config('app.url') }}",
  "logo": "{{ $ogImage ? asset('storage/' . $ogImage) : asset('images/logo.png') }}",
  "image": "{{ $ogImage ? asset('storage/' . $ogImage) : asset('images/og-default.jpg') }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ \App\Models\Setting::where('key', 'school_address')->value('value') ?? 'Jl. Gunung Puntang Km.01' }}",
    "addressLocality": "Cimaung",
    "addressRegion": "Jawa Barat",
    "postalCode": "40374",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "{{ \App\Models\Setting::where('key', 'phone')->value('value') ?? '(022) 1234-5678' }}",
    "contactType": "customer service",
    "email": "{{ \App\Models\Setting::where('key', 'email')->value('value') ?? 'info@smkba.sch.id' }}"
  },
  "sameAs": [
    @php
        $socials = [];
        foreach(['facebook_url', 'instagram_url', 'youtube_url'] as $key) {
            $val = \App\Models\Setting::where('key', $key)->where('is_active', true)->value('value');
            if($val) $socials[] = $val;
        }
        echo '"' . implode('", "', $socials) . '"';
    @endphp
  ]
}
</script>