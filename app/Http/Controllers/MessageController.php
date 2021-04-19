<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->latest()->take(20)->get();
        return response()->json($messages, 200);
    }

    public function store(Request $request)
    {
        $message = Auth::user()->messages()->create([
            'body' => $request->get('body')
        ]);

        broadcast(new MessageCreated($message))->toOthers();

        return response()->json($message, 200);
    }
}
