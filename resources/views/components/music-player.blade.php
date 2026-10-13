@props(['music'])

<div id="music-player"
     class="fixed bottom-5 left-5 z-40 flex items-center gap-2 bg-white/90 backdrop-blur rounded-full shadow-soft px-3 py-2 opacity-0 pointer-events-none transition-opacity duration-500"
     role="region" aria-label="Kontrol musik latar">

    <audio id="bg-audio" loop preload="none" src="{{ asset($music) }}"></audio>

    <button id="music-toggle" type="button" aria-label="Putar atau jeda musik"
            class="w-9 h-9 rounded-full bg-pink-soft/60 flex items-center justify-center hover:bg-pink-soft transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-deep">
        <span id="music-icon">▶️</span>
    </button>

    <input id="music-volume" type="range" min="0" max="1" step="0.05" value="0.5"
           aria-label="Volume" class="w-16 accent-pink-deep">

    <button id="music-mute" type="button" aria-label="Bisukan atau nyalakan suara"
            class="w-9 h-9 rounded-full bg-pink-soft/60 flex items-center justify-center hover:bg-pink-soft transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-pink-deep">
        <span id="mute-icon">🔊</span>
    </button>
</div>
