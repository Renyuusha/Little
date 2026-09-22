@props(['image', 'caption', 'index'])

<button type="button"
        class="memory-card group relative aspect-square overflow-hidden rounded-3xl shadow-soft focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-deep"
        data-lightbox-trigger
        data-image="{{ asset($image) }}"
        data-caption="{{ $caption }}"
        aria-label="View photo: {{ $caption }}">
    <img src="{{ asset($image) }}"
         onerror="this.onerror=null;this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect width=%22100%25%22 height=%22100%25%22 fill=%22%23FBD3E9%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22sans-serif%22 font-size=%2222%22 fill=%22%23fff%22%3Ephoto {{ $index }}%3C/text%3E%3C/svg%3E';"
         alt="{{ $caption }}"
         loading="lazy"
         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
    <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/50 to-transparent text-white text-xs md:text-sm py-2 px-3 text-left opacity-0 group-hover:opacity-100 transition-opacity">
        {{ $caption }}
    </span>
</button>
