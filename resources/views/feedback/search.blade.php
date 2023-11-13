@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Search') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{ route('feedback.search') }}" method="GET">
                        <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
                        <select name="category">
                            <option value="">All Categories</option>
                            <option value="bug">Bug Report</option>
                            <option value="feature">Feature Request</option>
                            <!-- Add other category options here -->
                        </select>
                        <button type="submit">Search</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection