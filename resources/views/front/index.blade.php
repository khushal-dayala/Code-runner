@extends('front.layouts.master')
@section('content')
<div class="main-content">
    <div class="header">
        <h1>PHP Code Runner</h1>
        <button id="run-code">Run Code</button>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Code Editor Area -->
            <textarea id="code" class="code-editor"></textarea>
        </div>
        <div class="col-md-6">
            <!-- Output Section -->
            <div id="output" class="output">Output will be displayed here...</div>
        </div>
    </div>
</div>
@endsection