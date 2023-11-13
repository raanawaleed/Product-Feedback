@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Comment') }}</div>

                <div class="card-body">
                    <div class="container mt-4">
                        <h6 class="display-4">{{ $feedback->title }}</h6>
                        <p class="lead">{{ $feedback->description }}</p>
                        <p class="font-weight-bold">Category: {{ $feedback->category }}</p>
                    </div>

                    <div class="container mt-4">
                        @if ($feedback->comments->count() > 0)
                        <h3>Comments:</h3>
                        <ul class="list-group">
                            @foreach ($feedback->comments as $comment)
                            <li class="list-group-item">
                                <div class="font-weight-bold">{{ $comment->user->name }} said:</div>
                                {{ $comment->content }}
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <!-- Comment Form -->
                        <form class="mt-4" method="POST" action="{{ route('comments.store', $feedback->id) }}">
                            @csrf
                            <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                            <div class="form-group">
                                <label for="content">Add a Comment:</label>
                                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                            </div>
                            </br>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#content').summernote({
            toolbar: [
                ['style', ['bold', 'italic']],
            ],
        });
    });
</script>
@endsection