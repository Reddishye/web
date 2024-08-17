<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $unreadMessagesCount = [];

        foreach ($users as $user) {
            $unreadMessagesCount[$user->id] = Message::where('from', $user->id)
                ->where('to', Auth::id())
                ->where('is_read', false)
                ->count();
        }

        return view('messages.index', compact('users', 'unreadMessagesCount'));
    }

    public function show(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->route('messages.index');
        }
        return view('messages.show', compact('user'));
    }
}
