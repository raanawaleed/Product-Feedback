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
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped" id="feedback-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Comments</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedback as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>@if ($item->comments->count() > 0)
                                        <a href='#' class="open-modal" data-id="{{ $item->id }}">View comments</a>
                                        @else
                                        <a href="{{ url('comments/create/' . $item->id) }}">Add Comment</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Content for the modal goes here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#feedback-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $('#content').summernote({
            toolbar: [
                ['style', ['bold', 'italic']],
            ],
        });
    });
    $(document).on('click', '.open-modal', function() {
        var feedbackId = $(this).data('id');
        $.ajax({
            url: '/get-comments/' + feedbackId, // Replace with your route
            type: 'GET',
            success: function(data) {
                $('.modal-body').html(data);
                $('#myModal').modal('show');
            }
        });
    });
</script>
@endsection