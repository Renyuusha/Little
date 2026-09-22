@php
$sections = [
    'home' => 'Home',
    'good-vibes' => 'Good Vibes',
    'games' => 'Games',
    'gift' => 'Gift',
    'playlist' => 'Playlist',
    'mood' => 'Mood',
    'garden' => 'Garden',
    'stars' => 'Stars',
    'photos' => 'Photos',
    'ending' => 'Ending',
];
@endphp

<nav aria-label="Section navigation">
    {{-- Desktop: floating dots on the right --}}
    <ul class="hidden md:flex flex-col gap-3 fixed right-5 top-1/2 -translate-y-1/2 z-40">
        @foreach ($sections as $id => $label)
            <li>
                <a href="#{{ $id }}"
                   data-nav-dot="{{ $id }}"
                   aria-label="Go to {{ $label }}"
                   class="group relative block w-3 h-3 rounded-full bg-white/70 border border-pink-deep/30 shadow-soft transition-all hover:scale-125 hover:bg-pink-deep/70 focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-deep">
                    <span class="pointer-events-none absolute right-6 top-1/2 -translate-y-1/2 whitespace-nowrap rounded-full bg-white/90 px-3 py-1 text-xs font-display opacity-0 shadow-soft transition-opacity group-hover:opacity-100">
                        {{ $label }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Mobile: floating menu button --}}
    <div class="md:hidden fixed bottom-5 right-5 z-40">
        <button id="mobile-nav-toggle"
                aria-label="Open navigation menu"
                aria-expanded="false"
                class="w-14 h-14 rounded-full bg-pink-deep text-white shadow-glow flex items-center justify-center text-xl active:scale-90 transition-transform">
            ✨
        </button>
        <ul id="mobile-nav-menu"
            class="hidden flex-col gap-2 absolute bottom-16 right-0 bg-white/95 backdrop-blur rounded-3xl shadow-soft p-3 min-w-[170px]">
            @foreach ($sections as $id => $label)
                <li>
                    <a href="#{{ $id }}" data-mobile-nav-link
                       class="block rounded-full px-4 py-2 text-sm font-display text-slate-600 hover:bg-pink-soft/50">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
