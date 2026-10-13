<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class EncouragementController extends Controller
{
    public function index(): View
    {
        $data = config('encouragement');

        return view('encouragement.index', [
            'recipientName' => $data['recipient_name'],
            'senderName' => $data['sender_name'],
            'music' => $data['music'],
            'photos' => $data['photos'],
            'playlist' => $data['playlist'],
            'goodVibes' => $data['good_vibes'],
            'compliments' => $data['compliments'],
            'starMessages' => $data['star_messages'],
            'moodResponses' => $data['mood_responses'],
            'luckyBoxes' => $data['lucky_boxes'],
        ]);
    }
}
