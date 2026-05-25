@props([
    'class' => '',
    'height' => 10, // Tailwind scale (bukan px string)
    'fallback' => true,
])

@php
    $logo = \App\Models\Setting::where('key', 'school_logo')->where('is_active', true)->value('value');
    $logoDark = \App\Models\Setting::where('key', 'school_logo_dark')->where('is_active', true)->value('value');
    $logoText = \App\Models\Setting::where('key', 'school_logo_text')->where('is_active', true)->value('value') ?? 'SMK BANJAR ASRI';
@endphp

@if($logo)

    <img
        src="{{ asset('storage/' . $logo) }}"
        alt="{{ $logoText }}"
        data-logo
        @if($logoDark) data-dark-src="{{ asset('storage/' . $logoDark) }}" @endif
        {{ $attributes->merge([
            'class' => "h-{$height} w-auto object-contain transition-all duration-300 {$class}",
            'loading' => 'lazy',
            'decoding' => 'async',
        ]) }}
    />

@elseif($fallback)

    <div {{ $attributes->merge([
        'class' => "flex items-center gap-2 h-{$height} {$class}"
    ]) }}>

        <svg
            class="w-8 h-8 text-emerald-500 flex-shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>

        <span class="font-bold text-white tracking-tight text-sm sm:text-base">
            {{ $logoText }}
        </span>

    </div>

@endif

{{-- DARK MODE SCRIPT (SAFE GLOBAL - NO DUPLICATE LOOP) --}}
@if($logoDark)
@once
<script>
document.addEventListener("DOMContentLoaded", () => {
    const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (!isDark) return;

    document.querySelectorAll('img[data-dark-src]').forEach(img => {
        const darkSrc = img.dataset.darkSrc;
        if (darkSrc) img.src = darkSrc;
    });
});
</script>
@endonce
@endif