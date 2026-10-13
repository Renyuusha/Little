/**
 * "A Little Something For You" — interaction layer.
 * Plain vanilla JS, no framework. Organized by section.
 */

const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

document.addEventListener('DOMContentLoaded', () => {
    initOpening();
    initFloatingDecor();
    initCursorTrail();
    initGoodVibes();
    initHeartsGame();
    initBubblesGame();
    initLuckyBox();
    initGiftBox();
    initPlaylist();
    initMoodPicker();
    initGarden();
    initConstellation();
    initLightbox();
    initSurpriseButton();
    initComplimentMachine();
    initEndingReveal();
    initFloatingNav();
    initMusicPlayer();
    initEasterEggs();
});

/* ============================================================
 * CONFETTI SYSTEM — reusable, pastel, lightweight
 * ============================================================ */
const confettiCanvas = document.getElementById('confetti-canvas');
const confettiCtx = confettiCanvas ? confettiCanvas.getContext('2d') : null;
let confettiParticles = [];
let confettiRunning = false;

function resizeConfettiCanvas() {
    if (!confettiCanvas) return;
    confettiCanvas.width = window.innerWidth;
    confettiCanvas.height = window.innerHeight;
}
window.addEventListener('resize', resizeConfettiCanvas);
resizeConfettiCanvas();

const CONFETTI_COLORS = ['#FBD3E9', '#F49AC2', '#FFD9B7', '#E4D9FF', '#CFEFFF', '#FFF3B0'];

function fireConfetti(count = 60) {
    if (!confettiCtx || prefersReducedMotion) return;

    for (let i = 0; i < count; i++) {
        confettiParticles.push({
            x: Math.random() * confettiCanvas.width,
            y: -20 - Math.random() * 100,
            size: 6 + Math.random() * 6,
            color: CONFETTI_COLORS[Math.floor(Math.random() * CONFETTI_COLORS.length)],
            speedY: 2 + Math.random() * 3,
            speedX: -1.5 + Math.random() * 3,
            rotation: Math.random() * 360,
            spin: -6 + Math.random() * 12,
            life: 0,
        });
    }

    if (!confettiRunning) {
        confettiRunning = true;
        requestAnimationFrame(animateConfetti);
    }
}

function animateConfetti() {
    confettiCtx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);

    confettiParticles.forEach((p) => {
        p.x += p.speedX;
        p.y += p.speedY;
        p.rotation += p.spin;
        p.life += 1;

        confettiCtx.save();
        confettiCtx.translate(p.x, p.y);
        confettiCtx.rotate((p.rotation * Math.PI) / 180);
        confettiCtx.fillStyle = p.color;
        confettiCtx.fillRect(-p.size / 2, -p.size / 2, p.size, p.size * 0.6);
        confettiCtx.restore();
    });

    confettiParticles = confettiParticles.filter((p) => p.y < confettiCanvas.height + 40 && p.life < 400);

    if (confettiParticles.length > 0) {
        requestAnimationFrame(animateConfetti);
    } else {
        confettiRunning = false;
        confettiCtx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
    }
}

/* ============================================================
 * OPENING SCREEN
 * ============================================================ */
function initOpening() {
    const openBtn = document.getElementById('open-button');
    const openingScreen = document.getElementById('opening-screen');
    const mainContent = document.getElementById('main-content');
    const musicPlayer = document.getElementById('music-player');
    const audio = document.getElementById('bg-audio');

    // fill opening particles with little emoji decorations
    const particleHost = openingScreen?.querySelector('.opening-particles');
    if (particleHost && !prefersReducedMotion) {
        scatterEmojis(particleHost, ['✨', '⭐', '☁️', '💫'], 14, {
            minSize: 1, sizeRange: 1.4, durationRange: 5, maxDelay: 4,
        });
    }

    openBtn?.addEventListener('click', () => {
        fireConfetti(90);

        // try to start music (best effort, autoplay policies allow this since it's a user gesture)
        if (audio) {
            audio.volume = 0.5;
            audio.play().catch(() => {
                /* if the placeholder file doesn't exist yet, fail silently */
            });
        }
        musicPlayer?.classList.add('visible');

        openingScreen.style.transition = 'opacity 0.6s ease';
        openingScreen.style.opacity = '0';

        setTimeout(() => {
            openingScreen.remove();
            mainContent.classList.remove('hidden');
            document.body.style.overflow = '';
        }, 600);
    });
}

/* ============================================================
 * FLOATING DECOR (hero background hearts/stars/clouds)
 * ============================================================ */
function initFloatingDecor() {
    const host = document.querySelector('.floating-decor');
    if (!host || prefersReducedMotion) return;

    scatterEmojis(host, ['♡', '✨', '☁️', '🌸', '⭐'], 12, {
        minSize: 1.2, sizeRange: 1.6, durationRange: 6, maxDelay: 3, opacity: '0.5',
    });
}

/**
 * Scatter floating emoji spans at random positions inside a host element.
 * The animation itself comes from CSS; this only randomizes size and timing.
 */
function scatterEmojis(host, emojis, count, { minSize, sizeRange, durationRange, maxDelay, opacity }) {
    for (let i = 0; i < count; i++) {
        const span = document.createElement('span');
        span.textContent = emojis[i % emojis.length];
        span.style.left = `${Math.random() * 100}%`;
        span.style.top = `${Math.random() * 100}%`;
        span.style.fontSize = `${minSize + Math.random() * sizeRange}rem`;
        if (opacity) span.style.opacity = opacity;
        span.style.animationDuration = `${5 + Math.random() * durationRange}s`;
        span.style.animationDelay = `${Math.random() * maxDelay}s`;
        host.appendChild(span);
    }
}

/* ============================================================
 * CURSOR TRAIL (subtle sparkle trail, desktop only, lightweight)
 * ============================================================ */
function initCursorTrail() {
    const canvas = document.getElementById('cursor-trail');
    if (!canvas || prefersReducedMotion || window.matchMedia('(pointer: coarse)').matches) return;

    const ctx = canvas.getContext('2d');
    let trail = [];

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resize);
    resize();

    window.addEventListener('mousemove', (e) => {
        trail.push({ x: e.clientX, y: e.clientY, life: 0 });
        if (trail.length > 20) trail.shift();
    });

    function loop() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        trail.forEach((point, i) => {
            point.life += 1;
            const alpha = Math.max(0, 1 - point.life / 20);
            ctx.beginPath();
            ctx.arc(point.x, point.y, 2 + (i / trail.length) * 3, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(244, 154, 194, ${alpha * 0.5})`;
            ctx.fill();
        });
        trail = trail.filter((p) => p.life < 20);
        requestAnimationFrame(loop);
    }
    loop();
}

/* ============================================================
 * GOOD VIBES CARD
 * ============================================================ */
function initGoodVibes() {
    const btn = document.getElementById('another-vibe');
    const text = document.getElementById('vibe-text');
    if (!btn || !text) return;

    const messages = JSON.parse(btn.dataset.goodVibes || '[]');
    let lastIndex = -1;

    function showRandom() {
        let index;
        do {
            index = Math.floor(Math.random() * messages.length);
        } while (index === lastIndex && messages.length > 1);
        lastIndex = index;

        text.style.opacity = '0';
        text.style.transform = 'translateY(6px)';
        setTimeout(() => {
            text.textContent = messages[index];
            text.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
            text.style.opacity = '1';
            text.style.transform = 'translateY(0)';
        }, 150);
    }

    showRandom();
    btn.addEventListener('click', showRandom);
}

/* ============================================================
 * GAME 1 — CATCH THE HEARTS
 * ============================================================ */
function initHeartsGame() {
    const field = document.getElementById('hearts-field');
    const scoreEl = document.getElementById('hearts-score');
    const resultEl = document.getElementById('hearts-result');
    const restartBtn = document.querySelector('[data-game-restart="hearts"]');
    if (!field) return;

    let score = 0;
    let spawnInterval = null;
    const TARGET = 10;
    const HEART_EMOJIS = ['💗', '💕', '💖', '💘'];

    function spawnHeart() {
        if (score >= TARGET) return;
        spawnTapTarget(field, {
            className: 'falling-heart',
            symbol: HEART_EMOJIS[Math.floor(Math.random() * HEART_EMOJIS.length)],
            label: 'Catch this heart',
            duration: 3 + Math.random() * 2,
            onTap: catchHeart,
        });
    }

    function catchHeart(heart) {
        if (score >= TARGET) return;
        score += 1;
        scoreEl.textContent = `Score: ${score} / ${TARGET}`;
        burstParticles(heart, field, '+1');
        heart.remove();

        if (score >= TARGET) {
            clearInterval(spawnInterval);
            resultEl.classList.remove('hidden');
            resultEl.classList.add('flex');
            fireConfetti(50);
        }
    }

    function startGame() {
        score = 0;
        scoreEl.textContent = `Score: 0 / ${TARGET}`;
        resultEl.classList.add('hidden');
        resultEl.classList.remove('flex');
        field.querySelectorAll('.falling-heart').forEach((h) => h.remove());
        clearInterval(spawnInterval);
        spawnInterval = setInterval(spawnHeart, prefersReducedMotion ? 1200 : 700);
    }

    startGame();
    restartBtn?.addEventListener('click', startGame);
}

/* ============================================================
 * GAME 2 — POP THE BUBBLES
 * ============================================================ */
function initBubblesGame() {
    const field = document.getElementById('bubbles-field');
    const scoreEl = document.getElementById('bubbles-score');
    const resultEl = document.getElementById('bubbles-result');
    const restartBtn = document.querySelector('[data-game-restart="bubbles"]');
    if (!field) return;

    let popped = 0;
    let spawnInterval = null;
    const TARGET = 12;

    function spawnBubble() {
        const bubble = spawnTapTarget(field, {
            className: 'floating-bubble',
            symbol: '🫧',
            label: 'Pop this bubble',
            duration: 4 + Math.random() * 2,
            onTap: popBubble,
        });
        bubble.style.bottom = '0';
    }

    function popBubble(bubble) {
        popped += 1;
        scoreEl.textContent = `Popped: ${popped}`;
        burstParticles(bubble, field, '✨');
        bubble.remove();

        if (popped === TARGET) {
            resultEl.classList.remove('hidden');
            fireConfetti(30);
        }
    }

    function startGame() {
        popped = 0;
        scoreEl.textContent = 'Popped: 0';
        resultEl.classList.add('hidden');
        field.querySelectorAll('.floating-bubble').forEach((b) => b.remove());
        clearInterval(spawnInterval);
        spawnInterval = setInterval(spawnBubble, prefersReducedMotion ? 1400 : 800);
    }

    startGame();
    restartBtn?.addEventListener('click', startGame);
}

/**
 * Spawn an animated, tappable emoji button inside a game field (shared by both catch/pop games).
 * It removes itself when its CSS animation ends.
 */
function spawnTapTarget(field, { className, symbol, label, duration, onTap }) {
    const target = document.createElement('button');
    target.type = 'button';
    target.className = className;
    target.textContent = symbol;
    target.style.left = `${5 + Math.random() * 85}%`;
    target.style.animationDuration = `${duration}s`;
    target.setAttribute('aria-label', label);

    target.addEventListener('animationend', () => target.remove());
    target.addEventListener('click', () => onTap(target));
    target.addEventListener('touchstart', (e) => {
        e.preventDefault();
        onTap(target);
    }, { passive: false });

    field.appendChild(target);
    return target;
}

/**
 * Small shared "burst" particle effect used by both catch/pop games.
 */
function burstParticles(sourceEl, container, symbol) {
    if (prefersReducedMotion) return;
    const rect = sourceEl.getBoundingClientRect();
    const containerRect = container.getBoundingClientRect();

    for (let i = 0; i < 5; i++) {
        const p = document.createElement('span');
        p.className = 'pop-particle';
        p.textContent = symbol;
        p.style.left = `${rect.left - containerRect.left + rect.width / 2}px`;
        p.style.top = `${rect.top - containerRect.top + rect.height / 2}px`;
        p.style.setProperty('--dx', `${-25 + Math.random() * 50}px`);
        p.style.setProperty('--dy', `${-30 - Math.random() * 20}px`);
        container.appendChild(p);
        p.addEventListener('animationend', () => p.remove());
    }
}

/* ============================================================
 * GAME 3 — LUCKY BOX
 * ============================================================ */
function initLuckyBox() {
    const boxes = document.querySelectorAll('.lucky-box');
    const resultEl = document.getElementById('lucky-result');
    const restartBtn = document.querySelector('[data-game-restart="lucky"]');
    if (!boxes.length) return;

    boxes.forEach((box) => {
        box.addEventListener('click', () => {
            if (box.disabled) return;
            boxes.forEach((b) => (b.disabled = true));
            box.textContent = '💫';
            box.classList.add('animate-pop');
            resultEl.textContent = box.dataset.label;
            fireConfetti(35);
        });
    });

    restartBtn?.addEventListener('click', () => {
        boxes.forEach((b) => {
            b.disabled = false;
            b.textContent = '🎁';
            b.classList.remove('animate-pop');
        });
        resultEl.textContent = '';
    });
}

/* ============================================================
 * GIFT BOX
 * ============================================================ */
function initGiftBox() {
    const box = document.getElementById('gift-box');
    const message = document.getElementById('gift-message');
    if (!box) return;

    box.addEventListener('click', () => {
        if (box.dataset.opened) return;
        box.dataset.opened = 'true';
        box.textContent = '🎉';
        fireConfetti(70);
        message.classList.remove('hidden');
        message.classList.add('animate-pop');
    });
}

/* ============================================================
 * PLAYLIST (UI-only progress simulation; plays real audio if present)
 * ============================================================ */
function initPlaylist() {
    const items = document.querySelectorAll('.playlist-item');
    const audio = document.getElementById('playlist-audio');
    if (!items.length || !audio) return;

    let current = null;

    items.forEach((item) => {
        const playBtn = item.querySelector('[data-playlist-play]');

        playBtn.addEventListener('click', () => {
            const isPlaying = item.classList.contains('playing');

            items.forEach((i) => {
                i.classList.remove('playing');
                i.querySelector('.playlist-progress').style.width = '0';
            });

            if (isPlaying) {
                audio.pause();
                current = null;
                return;
            }

            audio.src = item.dataset.src;
            audio.currentTime = 0;
            audio.play().catch(() => {
                /* placeholder file may not exist yet — UI still shows state */
            });
            item.classList.add('playing');
            current = item;
        });
    });

    audio.addEventListener('timeupdate', () => {
        if (!current || !audio.duration) return;
        const bar = current.querySelector('.playlist-progress');
        bar.style.width = `${(audio.currentTime / audio.duration) * 100}%`;
    });

    audio.addEventListener('ended', () => {
        current?.classList.remove('playing');
        current = null;
    });
}

/* ============================================================
 * MOOD PICKER
 * ============================================================ */
function initMoodPicker() {
    const buttons = document.querySelectorAll('.mood-btn');
    const result = document.getElementById('mood-result');
    if (!buttons.length) return;

    buttons.forEach((btn) => {
        btn.addEventListener('click', () => {
            buttons.forEach((b) => b.classList.remove('ring-2', 'ring-pink-deep'));
            btn.classList.add('ring-2', 'ring-pink-deep');
            result.style.opacity = '0';
            setTimeout(() => {
                result.textContent = btn.dataset.moodResponse;
                result.style.transition = 'opacity 0.3s ease';
                result.style.opacity = '1';
            }, 120);
        });
    });
}

/* ============================================================
 * LITTLE GARDEN
 * ============================================================ */
function initGarden() {
    const plot = document.getElementById('garden-plot');
    const plantBtn = document.getElementById('plant-button');
    const resetBtn = document.getElementById('garden-reset');
    const message = document.getElementById('garden-message');
    if (!plot) return;

    const STAGES = ['🌱', '🌿', '🌷', '🌸'];
    const MAX_PLANTS = 8;
    let count = 0;
    let growthTimers = [];

    plantBtn.addEventListener('click', () => {
        if (count >= MAX_PLANTS) return;
        count += 1;

        const plant = document.createElement('span');
        plant.className = 'garden-plant';
        plant.textContent = STAGES[0];
        plant.dataset.stage = '0';
        plot.appendChild(plant);

        // grow through stages
        let stage = 0;
        const growth = setInterval(() => {
            stage += 1;
            if (stage >= STAGES.length) {
                clearInterval(growth);
                return;
            }
            plant.textContent = STAGES[stage];
            plant.classList.remove('garden-plant');
            void plant.offsetWidth; // restart animation
            plant.classList.add('garden-plant');
        }, 700);
        growthTimers.push(growth);

        if (count === MAX_PLANTS) {
            message.textContent = 'Look at that little garden 🌷';
            setTimeout(() => {
                message.textContent = 'Pretty nice, right?';
            }, 2200);
            fireConfetti(25);
        }
    });

    resetBtn.addEventListener('click', () => {
        growthTimers.forEach(clearInterval);
        growthTimers = [];
        plot.innerHTML = '';
        count = 0;
        message.textContent = '';
    });
}

/* ============================================================
 * CONSTELLATION
 * ============================================================ */
function initConstellation() {
    const sky = document.getElementById('constellation-sky');
    const message = document.getElementById('constellation-message');
    if (!sky) return;

    const messages = JSON.parse(sky.dataset.starMessages || '[]');
    const STAR_COUNT = messages.length || 7;
    let foundCount = 0;

    for (let i = 0; i < STAR_COUNT; i++) {
        const star = document.createElement('button');
        star.type = 'button';
        star.className = 'constellation-star';
        star.textContent = '⭐';
        star.style.left = `${5 + Math.random() * 90}%`;
        star.style.top = `${5 + Math.random() * 85}%`;
        star.style.animationDelay = `${Math.random() * 2}s`;
        star.setAttribute('aria-label', 'Tap this star');
        star.dataset.message = messages[i] || 'You deserve good things.';

        star.addEventListener('click', () => {
            if (star.classList.contains('found')) return;
            star.classList.add('found');
            foundCount += 1;
            message.textContent = star.dataset.message;

            if (foundCount === STAR_COUNT) {
                fireConfetti(40);
                setTimeout(() => {
                    message.textContent = 'You found them all ⭐';
                    setTimeout(() => {
                        message.textContent = 'Looks like the sky has something to say today.';
                    }, 2200);
                }, 800);
            }
        });

        sky.appendChild(star);
    }

    // one secret hidden star easter egg, slightly transparent
    const secretStar = document.createElement('button');
    secretStar.type = 'button';
    secretStar.className = 'constellation-star opacity-20';
    secretStar.textContent = '✦';
    secretStar.style.left = '92%';
    secretStar.style.top = '8%';
    secretStar.setAttribute('aria-label', 'A faint star');
    secretStar.addEventListener('click', () => showEasterEggToast('You found me.'));
    sky.appendChild(secretStar);
}

/* ============================================================
 * PHOTO LIGHTBOX
 * ============================================================ */
function initLightbox() {
    const triggers = document.querySelectorAll('[data-lightbox-trigger]');
    const lightbox = document.getElementById('lightbox');
    const image = document.getElementById('lightbox-image');
    const caption = document.getElementById('lightbox-caption');
    const closeBtn = document.getElementById('lightbox-close');
    if (!triggers.length || !lightbox) return;

    function open(trigger) {
        image.src = trigger.dataset.image;
        image.alt = trigger.dataset.caption;
        caption.textContent = trigger.dataset.caption;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        closeBtn.focus();
    }

    function close() {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
    }

    triggers.forEach((trigger) => trigger.addEventListener('click', () => open(trigger)));
    closeBtn.addEventListener('click', close);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) close();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !lightbox.classList.contains('hidden')) close();
    });
}

/* ============================================================
 * SURPRISE BUTTON
 * ============================================================ */
function initSurpriseButton() {
    const btn = document.getElementById('surprise-button');
    const message = document.getElementById('surprise-message');
    if (!btn) return;

    btn.addEventListener('click', () => {
        fireConfetti(80);
        message.classList.remove('hidden');
        message.classList.add('animate-pop');

        if (!prefersReducedMotion) {
            document.body.style.transition = 'transform 0.1s ease';
            document.body.style.transform = 'translateX(-4px)';
            setTimeout(() => (document.body.style.transform = 'translateX(4px)'), 80);
            setTimeout(() => (document.body.style.transform = 'translateX(0)'), 160);
        }

        btn.textContent = 'Yeuu dibilang XD';
        btn.disabled = true;
    });
}

/* ============================================================
 * COMPLIMENT MACHINE
 * ============================================================ */
function initComplimentMachine() {
    const btn = document.getElementById('compliment-button');
    const text = document.getElementById('compliment-text');
    if (!btn || !text) return;

    const compliments = JSON.parse(btn.dataset.compliments || '[]');

    btn.addEventListener('click', () => {
        let ticks = 0;
        const maxTicks = prefersReducedMotion ? 2 : 10;
        const interval = setInterval(() => {
            text.textContent = compliments[Math.floor(Math.random() * compliments.length)];
            ticks += 1;
            if (ticks >= maxTicks) {
                clearInterval(interval);
            }
        }, 80);
    });
}

/* ============================================================
 * ENDING REVEAL (fade lines in on scroll)
 * ============================================================ */
function initEndingReveal() {
    const lines = document.querySelectorAll('.ending-line');
    if (!lines.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.4 }
    );

    lines.forEach((line, i) => {
        line.style.transitionDelay = `${i * 0.15}s`;
        observer.observe(line);
    });
}

/* ============================================================
 * FLOATING NAVIGATION
 * ============================================================ */
function initFloatingNav() {
    const dots = document.querySelectorAll('[data-nav-dot]');
    const sections = Array.from(dots).map((dot) => document.getElementById(dot.dataset.navDot)).filter(Boolean);

    const mobileToggle = document.getElementById('mobile-nav-toggle');
    const mobileMenu = document.getElementById('mobile-nav-menu');

    mobileToggle?.addEventListener('click', () => {
        const isOpen = !mobileMenu.classList.contains('hidden');
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('flex');
        mobileToggle.setAttribute('aria-expanded', String(!isOpen));
    });

    document.querySelectorAll('[data-mobile-nav-link]').forEach((link) => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            mobileMenu.classList.remove('flex');
        });
    });

    if (!sections.length) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    dots.forEach((dot) => dot.classList.remove('bg-pink-deep', 'scale-125'));
                    const activeDot = document.querySelector(`[data-nav-dot="${entry.target.id}"]`);
                    activeDot?.classList.add('bg-pink-deep', 'scale-125');
                }
            });
        },
        { threshold: 0.5 }
    );

    sections.forEach((section) => observer.observe(section));
}

/* ============================================================
 * MUSIC PLAYER CONTROLS
 * ============================================================ */
function initMusicPlayer() {
    const audio = document.getElementById('bg-audio');
    const toggleBtn = document.getElementById('music-toggle');
    const icon = document.getElementById('music-icon');
    const volume = document.getElementById('music-volume');
    const muteBtn = document.getElementById('music-mute');
    const muteIcon = document.getElementById('mute-icon');
    if (!audio || !toggleBtn) return;

    // keep the icon in sync with the real playback state (music may also start from the opening screen)
    audio.addEventListener('play', () => (icon.textContent = '⏸️'));
    audio.addEventListener('pause', () => (icon.textContent = '▶️'));

    toggleBtn.addEventListener('click', () => {
        if (audio.paused) {
            audio.play().catch(() => {});
        } else {
            audio.pause();
        }
    });

    volume?.addEventListener('input', () => {
        audio.volume = Number(volume.value);
        audio.muted = false;
        muteIcon.textContent = '🔊';
    });

    muteBtn?.addEventListener('click', () => {
        audio.muted = !audio.muted;
        muteIcon.textContent = audio.muted ? '🔇' : '🔊';
    });
}

/* ============================================================
 * EASTER EGGS
 * ============================================================ */
function initEasterEggs() {
    // 1. Click the heart logo 7 times
    const logo = document.getElementById('logo-easter-egg');
    let logoClicks = 0;
    logo?.addEventListener('click', () => {
        logoClicks += 1;
        if (logoClicks === 7) {
            showEasterEggToast('Okay, you\'re curious huh? 😂');
            logoClicks = 0;
        }
    });

    // 2. Secret keyboard sequence: type "vibe"
    const secretWord = 'vibe';
    let typed = '';
    document.addEventListener('keydown', (e) => {
        if (e.key.length !== 1) return;
        typed = (typed + e.key.toLowerCase()).slice(-secretWord.length);
        if (typed === secretWord) {
            showEasterEggToast('Secret unlocked ✨');
            fireConfetti(40);
        }
    });

    // 3. Hidden star — handled inside initConstellation()
}

function showEasterEggToast(text) {
    const toast = document.getElementById('easter-egg-toast');
    if (!toast) return;
    toast.textContent = text;
    toast.classList.remove('hidden');
    clearTimeout(showEasterEggToast._timer);
    showEasterEggToast._timer = setTimeout(() => toast.classList.add('hidden'), 2600);
}
