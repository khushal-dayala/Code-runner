@extends('admin.layouts.master')
@section('css')
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-4">Recent Codes</h5>
            <a href="{{route('codes.create')}}">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover text-center mb-0" id="codesTable">
                <thead>
                    <tr class="text-white">
                    <th scope="col">Category</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

@endsection
@section('js')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#codesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('codes.index') }}', // URL for AJAX request
            columns: [
                { data: 'category' },
                { data: 'title' },
                { data: 'author' },
                { data: 'created_at' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection
