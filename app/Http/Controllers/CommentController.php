<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create($id)
    {
        $feedback = Feedback::with('comments')->find($id);

        return view('comment.create', compact('feedback'));
    }

    public function store(CommentRequest $request, $feedbackId)
    {
        $feedback = Feedback::find($feedbackId);

        if (!$feedback) {
            return back()->with('error', 'Feedback not found.');
        }

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user_id = auth()->user()->id;
        $comment->feedback_id = $request->input('feedback_id'); // Associate the comment with the feedback item


        $feedback->comments()->save($comment);

        return redirect()->route('feedback.index')->with('success', 'Comment added successfully.');
    }

    public function getComments($feedbackId){
        $feedback = Feedback::with('comments')->find($feedbackId);
        
        return view('comment.comments', compact('feedback'));
    }
}
