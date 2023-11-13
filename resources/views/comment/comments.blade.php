<div>
    <div class="container mt-4">
        <p><strong>Title:</strong> {{ $feedback->title }}</p>
        <p><strong>Description:</strong> {{ $feedback->description }}</p>
    </div>
    <div class="container mt-4">
        <div class="comments">
            @foreach ($feedback->comments as $comment)
            <div class="comment">
                <strong>Author: </strong>
                {{ $comment->user->name }} - {{ $comment->created_at }}
                </br>
                <strong>Content: </strong>
                <p>{{ $comment->content }}</p>
            </div>
            @endforeach
        </div>
    </div>
    <hr>
    <div class="container mt-4">
        <form method="POST" action="{{ route('comments.store', $feedback->id) }}">
            @csrf
            <div class="form-group">
                <label for="content">Add a New Comment:</label>
                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
            </div></br>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    </div>

</div>