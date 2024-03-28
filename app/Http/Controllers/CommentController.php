<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Message::latest()->get();
        return view('admin.comments.comments', compact('comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:200',
            'email_address' => 'required|string|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Message::create($validatedData);

        return redirect()->back()->with('success',[
            'message' => 'Your message has been sent.',
            'duration' => $this->alert_message_duration
        ]);
    }

    public function show(Message $comment)
    {
        return view('admin.comments.comment', compact('comment'));
    }

    public function destroy(Message $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->with('success', [
            'message' =>"Comment has been deleted.",
            'duration' => $this->alert_message_duration,
        ]);
    }
}
