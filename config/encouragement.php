<?php

return [

    // Ganti dengan nama penerima & nama kamu
    'recipient_name' => env('RECIPIENT_NAME', 'Kamu'),
    'sender_name' => env('SENDER_NAME', 'Seseorang yang peduli'),

    // Taruh file mp3 kamu di public/audio/background.mp3
    'music' => 'audio/background.mp3',

    // Placeholder foto - taruh file asli di public/images/
    'photos' => [
        ['image' => 'images/photo-1.jpg', 'caption' => 'a good day, i think'],
        ['image' => 'images/photo-2.jpg', 'caption' => 'random moment #1'],
        ['image' => 'images/photo-3.jpg', 'caption' => 'this one\'s cute ngl'],
        ['image' => 'images/photo-4.jpg', 'caption' => 'just because'],
    ],

    // Playlist placeholder - ganti judul & file mp3-nya
    'playlist' => [
        ['title' => 'Song One', 'file' => 'audio/song-1.mp3', 'duration' => '3:24'],
        ['title' => 'Song Two', 'file' => 'audio/song-2.mp3', 'duration' => '2:58'],
        ['title' => 'Song Three', 'file' => 'audio/song-3.mp3', 'duration' => '4:01'],
        ['title' => 'Song Four', 'file' => 'audio/song-4.mp3', 'duration' => '3:12'],
    ],

    'good_vibes' => [
        "You got this ♡",
        "Take it easy today.",
        "Don't forget to smile.",
        "You're doing fine.",
        "One thing at a time.",
        "Be nice to yourself.",
        "You deserve a good day.",
        "Keep going, slowly is okay.",
        "Today can still be a good day.",
        "Hey, you're doing great.",
    ],

    'compliments' => [
        "You're pretty cool.",
        "You have a nice vibe.",
        "You deserve good things.",
        "You're doing better than you think.",
        "Don't forget to appreciate yourself.",
        "You make things a little brighter.",
        "You're someone worth rooting for.",
        "Keep being you.",
    ],

    'star_messages' => [
        "You can do it ✨",
        "Keep going.",
        "One day at a time.",
        "You deserve good things.",
        "Don't forget to rest.",
        "Keep your smile.",
        "Good things take time.",
    ],

    'mood_responses' => [
        '😊' => "Yesss, keep that energy ✨",
        '😌' => "Nice. Enjoy the calm day.",
        '😴' => "Okay sleepyhead, go get some rest 😴",
        '😵‍💫' => "Take it easy today.",
        '🥹' => "Sending extra good vibes your way ♡",
        '😎' => "Okayyy, cool kid.",
        '🤍' => "Sending a little warmth your way.",
    ],

    'lucky_boxes' => [
        ['emoji' => '🍀', 'label' => 'A little luck 🍀'],
        ['emoji' => '🫂', 'label' => 'A virtual hug 🫂'],
        ['emoji' => '✨', 'label' => 'Extra good vibes ✨'],
    ],

];
