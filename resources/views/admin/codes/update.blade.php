@extends('admin.layouts.master')
@section('css')
<style>
.suggestion-item {
    padding: 8px;
    cursor: pointer;
    background: #191c24;
    border: 1px solid #ddd;
    color: white;
}

.suggestion-item:hover {
    background: #EB1616;
    /* Lighter shade for hover effect */
    color: white;
    /* Example text color change on hover */
}

.suggestion-item:hover {
    background: #191c24;
    color: white;
}

#category-list {
    position: absolute;
    width: 100%;
    z-index: 1000;
    border: 1px solid #ddd;
    background: white;
    display: none;
}
</style>
@endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h5 class="mb-4">Update Code</h5>
                <form action="{{ route('codes.update', [$code->id]) }}" method="post" id="codeForm">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="mb-3 position-relative">
                        <input type="text" class="form-control @error('category') is-invalid @enderror" id="category"
                            name="category" value="{{ $code->category ? $code->category->title : '' }}"
                            aria-describedby="category" placeholder="Category">
                        <div id="category-list"></div>
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" aria-describedby="title"
                            value="{{$code->title}}">
                        <div id="title" class="form-text">We'll never share your email with anyone else.
                        </div>
                    </div>
                    <div class="form-floating">
                        <textarea name="code" class="form-control" placeholder="Write a code here" id="code"
                            style="height: 150px;">{{$code->code}}</textarea>
                        <label for="code">Code</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    $("#codeForm").validate({
        rules: {
            category: {
                required: true,
                maxlength: 255
            },
            title: {
                required: true,
                maxlength: 255
            },
            code: {
                required: true
            }
        },
        messages: {
            title: {
                required: "Please enter a title.",
                maxlength: "Title cannot exceed 255 characters."
            },
            code: {
                required: "Please write some code."
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
            if (element.prop("tagName").toLowerCase() === "textarea") {
                error.insertAfter(element);
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#category").on('input', function() {
        let query = $(this).val();

        if (query.length > 1) { // Ensure there's at least some input
            $.ajax({
                url: "{{ route('category.suggestions') }}",
                type: "GET",
                dataType: "json",
                data: {
                    query: query
                },
                success: function(data) {
                    let suggestions = "";
                    if (data.length > 0) {
                        data.forEach(function(category) {
                            suggestions +=
                                `<div class="suggestion-item" onclick="selectCategory('${category}')">${category}</div>`;
                        });
                    } else {
                        suggestions =
                            `<div class="suggestion-item">No results found</div>`;
                    }
                    $("#category-list").html(suggestions).show();
                }
            });
        } else {
            $("#category-list").hide();
        }
    });

    // Hide the suggestions when clicking outside
    $(document).on("click", function(e) {
        if (!$(e.target).closest("#category, #category-list").length) {
            $("#category-list").hide();
        }
    });
});

function selectCategory(value) {
    $("#category").val(value);
    $("#category-list").hide();
}
</script>
@endsection