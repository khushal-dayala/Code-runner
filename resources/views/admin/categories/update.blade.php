<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h5 class="mb-4">Update Category</h5>
                <form action="{{ route('categories.update', [$category->id]) }}" method="post" id="categoryUpdateForm">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ $category->title }}" aria-describedby="title" placeholder="Title">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>