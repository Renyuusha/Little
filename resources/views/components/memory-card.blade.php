@props(['image', 'caption', 'index'])

@php
    // Pink placeholder shown when the real photo file is missing
    $placeholderSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="400" height="400">'
        . '<rect width="100%" height="100%" fill="#FBD3E9"/>'
        . '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="sans-serif" font-size="22" fill="#fff">photo ' . $index . '</text>'
        . '</svg>';
    $placeholder = 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($placeholderSvg);
@endphp

<button type="button"
        class="memory-card group relative aspect-square overflow-hidden rounded-3xl shadow-soft focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-deep"
        data-lightbox-trigger
        data-image="{{ asset($image) }}"
        data-caption="{{ $caption }}"
        aria-label="View photo: {{ $caption }}">
    <img src="{{ asset($image) }}"
         data-fallback="{{ $placeholder }}"
         onerror="this.onerror=null;this.src=this.dataset.fallback;"
         alt="{{ $caption }}"
         loading="lazy"
         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/50 to-transparent text-white text-xs md:text-sm py-2 px-3 text-left opacity-0 group-hover:opacity-100 transition-opacity">
        {{ $caption }}
    </span>
</button>
