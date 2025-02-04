@extends('admin.layouts.master')
@section('css')
<link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="updaetCategory-div"></div>
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-4">Recent Categories</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover text-center mb-0" id="codesTable">
                <thead>
                    <tr class="text-white">
                        <th scope="col">Title</th>
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
    $("#categoryUpdateForm").validate({
        rules: {
            title: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            title: {
                required: "Please enter a title.",
                maxlength: "Title cannot exceed 255 characters."
            }
        },
        errorElement: "div",
        errorClass: "invalid-feedback",
        highlight: function(element) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        }
    });

    let table = $('#codesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('categories.index') }}', // Ensure this is the correct route
        columns: [
            { data: 'title' },
            { data: 'created_at' },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    // Handle Edit button click
    $(document).on('click', '.editCategory', function() {
        let categoryId = $(this).data('id');
        let url = "{{ route('categories.edit', ':id') }}".replace(':id', categoryId);
        $.ajax({
            url: url, // Call Laravel Controller
            type: 'GET',
            success: function(response) {
                $('.updaetCategory-div').html(response); // Append component inside the div
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>
@endsection