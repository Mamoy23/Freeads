<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::all()->where('id', '!=', Auth::user()->id);
        return view('chat.index', compact('users'));
    }

    public function show(User $user)
    {
        $users = User::all()->where('id', '!=', Auth::user()->id);
        //$msgs = Chat::where('from_id', Auth::user()->id)->where('to_id', $user->id)->get();
        $msgs = Chat::where(function ($query) use($user){
                $query->where('from_id', Auth::user()->id)
                    ->where('to_id', $user->id);
                })
                ->orWhere(function ($query) use($user){
                $query->where('from_id', $user->id)
                    ->where('to_id', Auth::user()->id);
                })
                ->oldest()
                ->get();
        return view('chat.show', compact('users', 'user', 'msgs'));
    }

    public function store(User $user, Request $request)
    {
        $id_user = Auth::id();

        $this->validate($request, [
            'content' => 'required',
        ]);

        $msg = Chat::create([
            'from_id' => $id_user,
            'to_id' => $user->id,
            'content' => $request->content,
        ]);
        $msg->save();

        return redirect()->route('chat.show', $user)->with('success', 'Your message is sent !');
    }
}
