@extends('layouts.admin')

@section('content')
    <h1>Edit Feedback Item</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.feedback.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $feedback->title }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $feedback->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="bug" @if ($feedback->category === 'bug') selected @endif>Bug Report</option>
                <option value="feature" @if ($feedback->category === 'feature') selected @endif>Feature Request</option>
                <!-- Add other category options here -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
