@extends('layouts.admin')

@section('content')
    <h1>Feedback Items</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedbackItems as $feedback)
                <tr>
                    <td>{{ $feedback->title }}</td>
                    <td>{{ $feedback->category }}</td>
                    <td>
                        <a href="{{ route('admin.feedback.edit', $feedback->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this feedback item?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
