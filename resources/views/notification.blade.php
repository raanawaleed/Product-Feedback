@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notifications</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if ($notifications->isEmpty())
                    <p>No notifications to display.</p>
                    @else
                    <ul class="list-group">
                        @foreach ($notifications as $notification)
                        <li class="list-group-item {{ $notification->read ? 'read' : 'unread' }}">
                            <strong>{{ $notification->message }}</strong>
                            <br>
                            {{ $notification->created_at }}
                        </li>
                        <li>
                            <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-primary">Mark as Read</a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection