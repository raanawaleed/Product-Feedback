<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::with('comments')->latest()->paginate(10); // Assuming 10 feedback items per page
        return view('feedback.index', compact('feedback'));
    }
    public function create()
    {
        return view('feedback.create');
    }

    public function store(FeedbackRequest $request)
    {
        $feedback = new Feedback;
        $feedback->title = $request->input('title');
        $feedback->description = $request->input('description');
        $feedback->category = $request->input('category');
        $feedback->user_id = auth()->user()->id;
        $feedback->save();

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback submitted successfully');
    }
}
