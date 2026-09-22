# A Little Something For You ♡

A tiny, cute, interactive "good vibes corner" built with Laravel + Blade +
Tailwind + vanilla JS. No lectures, no therapy-speak — just a small digital
gift meant to make one specific person smile.

This folder contains **all the custom application code** (routes,
controller, Blade views, config, CSS, JS) described in the brief. Because
this sandbox's network is locked down to package registries only (no
Packagist access), it can't run `composer create-project` for you — so the
one manual step below creates the plain Laravel skeleton, and then you drop
these files on top of it.

## 1. Create the base Laravel app

You need PHP 8.2+, Composer, and Node 18+ installed locally. Then:

```bash
composer create-project laravel/laravel encouragement-site
cd encouragement-site
```

This generates the standard Laravel boilerplate (`artisan`, `bootstrap/`,
`app/Http/Controllers/Controller.php`, `public/index.php`, etc.) that every
Laravel app needs and that isn't specific to this project.

## 2. Copy these custom files in

From this delivered folder, copy everything **over** the fresh Laravel
project (overwriting `routes/web.php`, `resources/css/app.css`, and
`package.json` is expected):

```
app/Http/Controllers/EncouragementController.php
config/encouragement.php
routes/web.php
resources/css/app.css
resources/css/encouragement.css
resources/js/app.js
resources/js/encouragement.js
resources/views/layouts/app.blade.php
resources/views/encouragement/index.blade.php
resources/views/components/*
package.json
tailwind.config.js
postcss.config.js
vite.config.js
public/audio/
public/images/
.env.example  (merge RECIPIENT_NAME / SENDER_NAME into your real .env)
```

## 3. Install dependencies

```bash
composer install
npm install
```

## 4. Configure it for your person

Open `config/encouragement.php` (or set env vars) and edit:

- `RECIPIENT_NAME`, `SENDER_NAME` — in `.env`
- `photos` — captions for the gallery (Section 15)
- `playlist` — song titles (Section 11)
- `good_vibes`, `compliments`, `star_messages`, `mood_responses`,
  `lucky_boxes` — all the little message pools

Then drop real files into:

- `public/audio/background.mp3` — looping background music
- `public/audio/song-1.mp3` … `song-4.mp3` — playlist tracks
- `public/images/photo-1.jpg` … `photo-4.jpg` — gallery photos
- `public/images/favicon.png` — a placeholder pink-circle favicon is
  already included so the site never 404s on this

None of this is required to run the site — every asset reference fails
gracefully (silent audio, pastel placeholder photos) if the file isn't
there yet.

## 5. Run it

```bash
php artisan key:generate
php artisan serve
```

In a second terminal:

```bash
npm run dev
```

Visit **http://localhost:8000**.

## What's implemented

- Fullscreen opening screen ("heyy... aku punya sesuatu buat kamu :)") with
  a confetti burst + music start on the "Buka ✨" button
- Hero section with the recipient's name, floating decor
- "Today's little reminder" shuffling good-vibes card
- Three mini games: Catch the Hearts, Pop the Bubbles, Lucky Box
- Digital gift box reveal
- Playlist UI with per-track progress bars
- Emoji mood picker with per-mood responses
- Little garden you can plant and grow (seed → sprout → flower)
- Interactive night-sky constellation with per-star messages + a hidden
  star easter egg
- Photo gallery with a lightbox (ESC to close, graceful placeholder art
  if a photo file is missing)
- "Do NOT click this button" surprise button
- Compliment slot-machine
- Soft sunset ending section that fades in on scroll, signed by the sender
- Reusable canvas confetti system fired from every celebratory moment
- Floating navigation (desktop side-dots / mobile menu button) with
  smooth scroll + active-section highlighting
- A small music player (play/pause/volume/mute) that only starts after
  the opening button is pressed
- Easter eggs: click the ♡ logo 7 times, type "vibe" anywhere, and a faint
  hidden star in the night sky
- `prefers-reduced-motion` support (fewer particles/parallax, animations
  disabled) and keyboard/focus-visible support throughout
- Fully responsive, no horizontal scroll, touch-friendly game targets

## Editing later

Everything personal (names, messages, photo captions, playlist titles)
lives in **`config/encouragement.php`** — you never need to touch the
Blade or JS files just to change the content.
