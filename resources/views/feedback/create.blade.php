@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('feedback.store') }}">
                        @csrf
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"></textarea>
                        <label for="category">Category</label>
                        <input type="text" name="category" id="category">
                        <button type="submit">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection