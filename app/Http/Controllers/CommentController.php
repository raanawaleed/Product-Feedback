<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Notification;
use Illuminate\Http\Request;

use App\Notifications\NewCommentNotification;

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

        // Create a notification for the user who submitted the feedback
        $notification = new Notification();
        $notification->user_id = $feedback->user_id; // The user who submitted the feedback
        $notification->feedback_id = $feedback->id;
        $notification->message = 'New comment on your feedback item';
        $notification->save();

        // send notification 
        //$user->notify(new NewCommentNotification($feedback));
        
        return redirect()->route('feedback.index')->with('success', 'Comment added successfully.');
    }

    public function getComments($feedbackId)
    {
        $feedback = Feedback::with('comments')->find($feedbackId);

        return view('comment.comments', compact('feedback'));
    }
}
