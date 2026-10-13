<?php

return [

    // Ganti dengan nama penerima & nama kamu
    'recipient_name' => env('RECIPIENT_NAME', 'Kamu'),
    'sender_name' => env('SENDER_NAME', 'Seseorang yang peduli'),

    // Taruh file mp3 kamu di public/audio/background.mp3
    'music' => 'audio/background.mp3',

    // Placeholder foto - taruh file asli di public/images/
    'photos' => [
        ['image' => 'images/photo-1.jpg', 'caption' => 'hari yang menyenangkan, kayaknya'],
        ['image' => 'images/photo-2.jpg', 'caption' => 'momen random #1'],
        ['image' => 'images/photo-3.jpg', 'caption' => 'yang ini lucu sih jujur'],
        ['image' => 'images/photo-4.jpg', 'caption' => 'pengen aja'],
    ],

    // Playlist placeholder - ganti judul & file mp3-nya
    'playlist' => [
        ['title' => 'Harry Styles - As It Was', 'file' => 'audio/song-1.mp3', 'duration' => '2:43'],
        ['title' => 'Harry Styles - Watermelon Sugar', 'file' => 'audio/song-2.mp3', 'duration' => '2:57'],
        ['title' => 'Dua Lipa - Levitating', 'file' => 'audio/song-3.mp3', 'duration' => '3:22'],
        ['title' => 'Ellie Goulding, Diplo, Swae Lee - Close To Me', 'file' => 'audio/song-4.mp3', 'duration' => '3:04'],
    ],

    'good_vibes' => [
        "Kamu pasti bisa ♡",
        "Santai aja hari ini.",
        "Jangan lupa senyum.",
        "Kamu baik-baik aja kok.",
        "Satu-satu aja dulu.",
        "Baik-baik sama diri sendiri ya.",
        "Kamu pantas dapet hari yang baik.",
        "Terus jalan, pelan-pelan juga gapapa.",
        "Hari ini masih bisa jadi hari yang baik.",
        "Hei, kamu udah hebat banget.",
    ],

    'compliments' => [
        "Kamu tuh keren lho.",
        "Aura kamu enak banget.",
        "Kamu pantas dapet hal-hal baik.",
        "Kamu lebih hebat dari yang kamu kira.",
        "Jangan lupa hargai diri sendiri.",
        "Kamu bikin semuanya jadi sedikit lebih cerah.",
        "Kamu orang yang pantas didukung.",
        "Tetap jadi diri kamu ya.",
    ],

    'star_messages' => [
        "Kamu bisa ✨",
        "Terus semangat.",
        "Jalani satu hari demi satu hari.",
        "Kamu pantas dapet hal-hal baik.",
        "Jangan lupa istirahat.",
        "Jaga senyummu ya.",
        "Hal baik butuh waktu.",
    ],

    'mood_responses' => [
        '😊' => "Yesss, pertahankan energinya ✨",
        '😌' => "Asik. Nikmati hari yang tenang ini.",
        '😴' => "Oke tukang ngantuk, sana istirahat dulu 😴",
        '😵‍💫' => "Santai aja hari ini.",
        '🥹' => "Kirim semangat ekstra buat kamu ♡",
        '😎' => "Okeee, si paling keren.",
        '🤍' => "Kirim sedikit kehangatan buat kamu.",
    ],

    'lucky_boxes' => [
        ['emoji' => '🍀', 'label' => 'Sedikit keberuntungan 🍀'],
        ['emoji' => '🫂', 'label' => 'Pelukan virtual 🫂'],
        ['emoji' => '✨', 'label' => 'Semangat ekstra ✨'],
    ],

];
