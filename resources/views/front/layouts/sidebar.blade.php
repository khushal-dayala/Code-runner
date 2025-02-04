<div class="sidebar">
    <h4>Code Snippets</h4>
    <div class="category-container">
        <!-- Category Header -->
        @foreach($categories as $category)
            <button class="category-header text-center">{{$category->title}}</button>
            <!-- Dropdown Content -->
            <div class="category-dropdown">
                @if($category->code_listing)
                    @foreach($category->code_listing as $code)
                        <a href="#" class="code-snippet" data-snippet="{{$code->code}}">{{$code->title}}</a>
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
</div>
