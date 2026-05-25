<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "{{ $settings['school_name'] ?? 'SMK Banjar Asri' }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Gunung Puntang Km.01 Cimaung",
    "addressRegion": "Jawa Barat",
    "addressCountry": "ID"
  },
  "url": "{{ config('app.url') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "sameAs": [
    "https://facebook.com/smkbajarasri",
    "https://instagram.com/smkbajarasri"
  ]
}
</script>