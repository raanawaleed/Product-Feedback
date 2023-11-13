<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackAdminController extends Controller
{
    public function index()
    {
        $feedbackItems = Feedback::all();

        return view('admin.feedback.index', compact('feedbackItems'));
    }

    // Display the form for editing a feedback item
    public function edit($id)
    {
        $feedback = Feedback::find($id);

        return view('admin.feedback.edit', compact('feedback'));
    }

    // Update a feedback item
    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);

        // Validate and update the feedback item
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $feedback->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
        ]);

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback item updated successfully.');
    }

    // Delete a feedback item
    public function destroy($id)
    {
        $feedback = Feedback::find($id);

        if ($feedback) {
            $feedback->delete();
            return redirect()->route('admin.feedback.index')->with('success', 'Feedback item deleted.');
        }

        return redirect()->route('admin.feedback.index')->with('error', 'Feedback item not found.');
    }
}
