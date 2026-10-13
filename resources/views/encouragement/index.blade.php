<x-layouts.app>

    {{-- ================= OPENING OVERLAY ================= --}}
    <div id="opening-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center text-center px-6 opening-bg">
        <div class="opening-particles absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true"></div>

        <div class="relative z-10">
            <p class="font-display text-3xl md:text-5xl text-slate-700 mb-3 reveal-text">heyy...</p>
            <p class="font-body text-lg md:text-2xl text-slate-600 mb-10 reveal-text reveal-delay-1">
                aku punya sesuatu buat kamu :)
            </p>
            <button id="open-button" type="button"
                    class="font-display text-lg md:text-xl bg-pink-deep text-white px-8 py-3 rounded-full shadow-glow hover:scale-105 active:scale-95 transition-transform reveal-text reveal-delay-2 focus:outline-none focus-visible:ring-4 focus-visible:ring-pink-soft">
                Buka ✨
            </button>
        </div>
    </div>

    {{-- ================= MAIN CONTENT ================= --}}
    <div id="main-content" class="hidden">

        <x-floating-nav />
        <x-music-player :music="$music" />

        {{-- Cursor trail canvas --}}
        <canvas id="cursor-trail" class="fixed inset-0 pointer-events-none z-30" aria-hidden="true"></canvas>
        {{-- Confetti canvas --}}
        <canvas id="confetti-canvas" class="fixed inset-0 pointer-events-none z-[60]" aria-hidden="true"></canvas>

        {{-- ============ 1. HERO ============ --}}
        <section id="home" class="relative min-h-screen flex flex-col items-center justify-center text-center px-6 bg-gradient-to-b from-babyblue/40 via-cream to-pink-soft/30 overflow-hidden">
            <div class="floating-decor absolute inset-0 pointer-events-none" aria-hidden="true"></div>

            <button id="logo-easter-egg" type="button" aria-label="little heart logo"
                    class="mb-6 text-4xl select-none hover:scale-110 transition-transform">♡</button>

            <h1 class="font-display text-4xl md:text-6xl text-slate-700 mb-3">
                Hallow, {{ $recipientName }} :3
            </h1>
            <p class="font-body text-lg md:text-2xl text-slate-600 mb-2">Just a little something for you.</p>
            <p class="font-body text-sm md:text-base text-slate-500 mb-8 italic">No reason. Just because.</p>

            <a href="#good-vibes"
               class="font-display bg-white/80 backdrop-blur text-pink-deep px-7 py-3 rounded-full shadow-soft hover:scale-105 active:scale-95 transition-transform">
                Let's go →
            </a>
        </section>

        {{-- ============ 2. GOOD VIBES ============ --}}
        <section id="good-vibes" class="relative py-24 px-6 flex flex-col items-center text-center bg-gradient-to-b from-pink-soft/30 to-yellow-soft/30">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-8">Today's little reminder ✨</h2>

            <div class="relative w-full max-w-sm">
                <div id="vibe-card" class="bg-white/85 backdrop-blur rounded-[2rem] shadow-soft px-8 py-14 min-h-[180px] flex items-center justify-center">
                    <p id="vibe-text" class="font-display text-xl md:text-2xl text-slate-700"></p>
                </div>
            </div>

            <button id="another-vibe" type="button" data-good-vibes='@json($goodVibes)'
                    class="mt-8 font-display bg-lavender/70 text-slate-700 px-6 py-3 rounded-full shadow-soft hover:scale-105 active:scale-95 transition-transform">
                Another one!
            </button>
        </section>

        {{-- ============ 3. MINI GAMES ============ --}}
        <section id="games" class="relative py-24 px-6 bg-gradient-to-b from-yellow-soft/30 to-babyblue/30">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-12 text-center">A few little games</h2>

            <div class="grid gap-8 max-w-5xl mx-auto md:grid-cols-3 items-stretch">

                {{-- Game 1: Catch the Hearts --}}
                <x-game-card id="game-hearts" title="Catch The Hearts 💗">
                    <div id="hearts-field" class="relative h-64 rounded-2xl bg-pink-soft/20 overflow-hidden touch-none" aria-live="polite">
                        <p id="hearts-score" class="absolute top-2 left-2 text-sm font-display text-pink-deep z-10">Score: 0 / 10</p>
                        <p id="hearts-result" class="hidden absolute inset-0 flex-col items-center justify-center gap-2 text-center bg-white/90 z-20">
                            <span class="font-display text-lg">YAY! 🎉</span>
                            <span class="text-sm">You caught them all!</span>
                        </p>
                    </div>
                    <button data-game-restart="hearts" type="button" class="mt-auto w-full font-display text-sm bg-pink-deep/90 text-white py-2 rounded-full hover:scale-105 active:scale-95 transition-transform">
                        Lagieh :3
                    </button>
                </x-game-card>

                {{-- Game 2: Pop the Bubbles --}}
                <x-game-card id="game-bubbles" title="Pop The Bubbles 🫧">
                    <div id="bubbles-field" class="relative h-64 rounded-2xl bg-babyblue/20 overflow-hidden touch-none" aria-live="polite">
                        <p id="bubbles-score" class="absolute top-2 left-2 text-sm font-display text-blue-500 z-10">Popped: 0</p>
                        <p id="bubbles-result" class="hidden absolute inset-x-2 bottom-2 text-center text-xs font-display bg-white/90 rounded-full py-2 z-20">
                            Okayyy, you're pretty good at this 👀
                        </p>
                    </div>
                    <button data-game-restart="bubbles" type="button" class="mt-auto w-full font-display text-sm bg-blue-400/90 text-white py-2 rounded-full hover:scale-105 active:scale-95 transition-transform">
                        Lagieh :3
                    </button>
                </x-game-card>

                {{-- Game 3: Lucky Box --}}
                <x-game-card id="game-lucky" title="Pick one.">
                    <div id="lucky-boxes" class="flex justify-center gap-4">
                        @foreach ($luckyBoxes as $i => $box)
                            <button type="button" data-lucky-box="{{ $i }}" data-label="{{ $box['label'] }}"
                                    class="lucky-box w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-lavender/60 shadow-soft flex items-center justify-center text-2xl hover:scale-110 active:scale-95 transition-transform">
                                🎁
                            </button>
                        @endforeach
                    </div>
                    <p id="lucky-result" class="mt-4 text-center font-display text-lg min-h-[2rem]"></p>
                    <button data-game-restart="lucky" type="button" class="mt-auto w-full font-display text-sm bg-lavender text-slate-700 py-2 rounded-full hover:scale-105 active:scale-95 transition-transform">
                        Lagieh :3
                    </button>
                </x-game-card>
            </div>
        </section>

        {{-- ============ 4. GIFT ============ --}}
        <section id="gift" class="relative py-28 px-6 flex flex-col items-center text-center bg-gradient-to-b from-babyblue/30 to-peach/30 overflow-hidden">
            <p class="font-display text-xl md:text-2xl text-slate-700 mb-10">Oh, Ngehehe tekan ka ^^</p>

            <button id="gift-box" type="button" aria-label="Open your gift"
                    class="text-7xl md:text-8xl hover:scale-110 active:scale-95 transition-transform">
                🎁
            </button>

            <div id="gift-message" class="hidden mt-8 max-w-md bg-white/85 backdrop-blur rounded-[2rem] shadow-soft px-8 py-8">
                <p class="font-display text-xl text-slate-700 mb-3">This is for you ♡</p>
                <p class="text-slate-600">A tiny reminder that someone out there is wishing you a good day.</p>
            </div>
        </section>

        {{-- ============ 5. PLAYLIST ============ --}}
        <section id="playlist" class="relative py-24 px-6 bg-gradient-to-b from-peach/30 to-lavender/30">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-10 text-center">Nambah nambah aja biar ga flat T.T</h2>

            <div class="max-w-lg mx-auto bg-white/80 backdrop-blur rounded-[2rem] shadow-soft p-4 md:p-6">
                @foreach ($playlist as $i => $song)
                    <div class="playlist-item flex items-center gap-3 p-3 rounded-2xl hover:bg-pink-soft/20 transition-colors"
                         data-src="{{ asset($song['file']) }}" data-index="{{ $i }}">
                        <button type="button" data-playlist-play="{{ $i }}"
                                aria-label="Play {{ $song['title'] }}"
                                class="w-10 h-10 shrink-0 rounded-full bg-pink-deep/90 text-white flex items-center justify-center">
                            <span class="playlist-icon">▶</span>
                        </button>
                        <div class="flex-1 min-w-0">
                            <p class="font-display text-sm md:text-base text-slate-700 truncate">
                                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }} — {{ $song['title'] }}
                            </p>
                            <div class="h-1.5 bg-pink-soft/40 rounded-full mt-1.5 overflow-hidden">
                                <div class="playlist-progress h-full bg-pink-deep w-0 transition-all"></div>
                            </div>
                        </div>
                        <span class="text-xs text-slate-500 shrink-0">{{ $song['duration'] }}</span>
                    </div>
                @endforeach
                <audio id="playlist-audio" preload="none"></audio>
                <p class="text-xs text-slate-400 mt-3 text-center">
                    (Gatau lagu fav {{ $recipientName }} T.T)
                </p>
            </div>
        </section>

        {{-- ============ 6. MOOD PICKER ============ --}}
        <section id="mood" class="relative py-24 px-6 flex flex-col items-center text-center bg-gradient-to-b from-lavender/30 to-yellow-soft/30">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-8">Perasaan {{ $recipientName }} sekarang^^</h2>

            <div class="flex flex-wrap justify-center gap-3 max-w-lg">
                @foreach ($moodResponses as $emoji => $response)
                    <button type="button" data-mood-response="{{ $response }}"
                            aria-label="Mood: {{ $emoji }}"
                            class="mood-btn text-3xl md:text-4xl bg-white/70 rounded-2xl shadow-soft w-16 h-16 md:w-20 md:h-20 flex items-center justify-center hover:scale-110 active:scale-95 transition-transform">
                        {{ $emoji }}
                    </button>
                @endforeach
            </div>

            <p id="mood-result" class="mt-8 font-display text-lg text-slate-700 min-h-[2rem]"></p>
        </section>

        {{-- ============ 7. GARDEN ============ --}}
        <section id="garden" class="relative py-24 px-6 flex flex-col items-center text-center bg-gradient-to-b from-yellow-soft/30 to-babyblue/30">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-3">Little Garden 🌱</h2>
            <p class="text-slate-500 mb-8 text-sm">Plant a little something.</p>

            <div id="garden-plot" class="relative w-full max-w-xl min-h-[10rem] rounded-[2rem] bg-gradient-to-b from-yellow-soft/40 to-[#c9a876]/30 shadow-soft flex flex-wrap items-end justify-center gap-2 p-4"></div>

            <div class="flex flex-wrap gap-3 justify-center mt-6">
                <button id="plant-button" type="button"
                        class="font-display bg-pink-deep/90 text-white px-6 py-3 rounded-full shadow-soft hover:scale-105 active:scale-95 transition-transform">
                    Plant something 🌱
                </button>
                <button id="garden-reset" type="button"
                        class="font-display bg-white/70 text-slate-600 px-6 py-3 rounded-full shadow-soft hover:scale-105 active:scale-95 transition-transform">
                    Reset garden
                </button>
            </div>
            <p id="garden-message" class="mt-6 font-display text-slate-700 min-h-[1.5rem]"></p>
        </section>

        {{-- ============ 8. CONSTELLATION ============ --}}
        <section id="stars" class="relative py-28 px-6 bg-gradient-to-b from-[#1b1436] to-[#3a2b63] text-white overflow-hidden">
            <h2 class="font-display text-2xl md:text-3xl mb-3 text-center">Wish ⭐</h2>
            <p class="text-white/70 mb-10 text-center text-sm">Tekan Bintangnya.</p>

            <div id="constellation-sky" class="relative max-w-3xl mx-auto h-72 md:h-96" data-star-messages='@json($starMessages)'></div>

            <p id="constellation-message" class="mt-8 text-center font-display text-lg min-h-[2rem]"></p>
        </section>

        {{-- ============ 9. PHOTOS ============ --}}
        <section id="photos" class="relative py-24 px-6 bg-gradient-to-b from-[#3a2b63] to-pink-soft/30">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-10 text-center">Memori kecil kecil ajah</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
                @foreach ($photos as $i => $photo)
                    <x-memory-card :image="$photo['image']" :caption="$photo['caption']" :index="$i + 1" />
                @endforeach
            </div>
        </section>

        {{-- Lightbox modal --}}
        <div id="lightbox" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/70 backdrop-blur-sm px-6" role="dialog" aria-modal="true" aria-label="Photo viewer">
            <button id="lightbox-close" type="button" aria-label="Close" class="absolute top-5 right-5 text-white text-3xl">&times;</button>
            <figure class="max-w-lg w-full">
                <img id="lightbox-image" src="" alt="" class="w-full rounded-2xl shadow-glow">
                <figcaption id="lightbox-caption" class="text-white text-center mt-4 font-display"></figcaption>
            </figure>
        </div>

        {{-- ============ 10. SURPRISE BUTTON ============ --}}
        <section class="relative py-24 px-6 flex flex-col items-center text-center bg-gradient-to-b from-pink-soft/30 to-lavender/30">
            <button id="surprise-button" type="button"
                    class="font-display text-lg md:text-xl bg-slate-700 text-white px-8 py-4 rounded-full shadow-soft hover:scale-105 active:scale-95 transition-transform">
                Jangan DITEKAN TOMBOL INI :3.
            </button>
            <div id="surprise-message" class="hidden mt-8 max-w-md bg-white/85 backdrop-blur rounded-[2rem] shadow-soft px-8 py-8">
                <p class="font-display text-lg text-slate-700 mb-2">I told you not to click it 😭</p>
                <p class="text-slate-600">Anyway... here's some extra happiness for you ♡</p>
            </div>
        </section>

        {{-- ============ 11. COMPLIMENT MACHINE ============ --}}
        <section class="relative py-24 px-6 flex flex-col items-center text-center bg-gradient-to-b from-lavender/30 to-cream">
            <h2 class="font-display text-2xl md:text-3xl text-slate-700 mb-8">Press the button.</h2>

            <div id="compliment-slot" class="bg-white/85 backdrop-blur rounded-[2rem] shadow-soft px-8 py-10 min-h-[120px] w-full max-w-sm flex items-center justify-center overflow-hidden">
                <p id="compliment-text" class="font-display text-lg md:text-xl text-slate-700"></p>
            </div>

            <button id="compliment-button" type="button" data-compliments='@json($compliments)'
                    class="mt-8 font-display bg-peach/80 text-slate-700 px-7 py-3 rounded-full shadow-soft hover:scale-105 active:scale-95 transition-transform">
                Give me one →
            </button>
        </section>

        {{-- ============ 12. ENDING ============ --}}
        <section id="ending" class="relative py-32 px-6 flex flex-col items-center text-center sunset-bg text-slate-700">
            <p class="font-display text-2xl md:text-3xl mb-4 ending-line">That's it...</p>
            <p class="font-body text-base md:text-lg mb-3 max-w-md ending-line">I just wanted to leave a little something here for you.</p>
            <p class="font-body text-base md:text-lg mb-3 max-w-md ending-line">Hope it made you smile, even just a little.</p>
            <p class="font-body text-base md:text-lg mb-8 max-w-md ending-line">Take care of yourself, okay? ♡</p>
            <p class="font-display text-xl mb-2 ending-line">See you around ✨</p>
            <p class="text-sm text-slate-500 ending-line">— {{ $senderName }}</p>
        </section>
    </div>

    <div id="easter-egg-toast" class="hidden fixed bottom-24 left-1/2 -translate-x-1/2 z-50 bg-white/95 shadow-soft rounded-full px-5 py-2 font-display text-sm text-slate-700"></div>

</x-layouts.app>
