<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index() {
        return response()->json(['success' => Chat::where(['user_id' => auth()->user()->id])->get()]);
    }

    public function all() {
        return response()->json(['success' => Chat::all()]);
    }

    public function send(Request $request) {
        $chat = new Chat();
        $chat->chat = $request->chat;
        $chat->datetime = date('Y-m-d H-i-s');
        $chat->status = "chat";
        $chat->user_id = auth()->user()->id;
        $chat->to_user_id = $request->to_user_id;

        $rule = $chat->sender->type[0].$chat->recipient->type[0];

        if(($rule == 'CC' || $rule[0] == 'S') && $chat->save()) {
            return response()->json(['success' => 'Massage has been sent', 200]);
        }
        return response()->json(['error' => 'Failed']);
    }

    public function feedback(Request $request) {
        $chat = new Chat();
        $chat->chat = $request->chat;
        $chat->datetime = date('Y-m-d H-i-s');
        $chat->status = "feedback";
        $chat->user_id = auth()->user()->id;
        $chat->to_user_id = $request->to_user_id;

        $rule = $chat->sender->type[0].$chat->recipient->type[0];

        if($rule == 'CS' && $chat->save()) {
            return response()->json(['success' => 'Feedback has been sent', 200]);
        }
        return response()->json(['error' => 'Failed']);
    }

    public function report(Request $request) {
        $chat = new Chat();
        $chat->chat = $request->chat;
        $chat->datetime = date('Y-m-d H-i-s');
        $chat->status = "report";
        $chat->user_id = auth()->user()->id;
        $chat->to_user_id = $request->to_user_id;

        $rule = $chat->sender->type[0].$chat->recipient->type[0];

        if($rule == 'CC' && $chat->save()) {
            return response()->json(['success' => 'Report has been sent', 200]);
        }
        return response()->json(['error' => 'Failed']);
    }
}
