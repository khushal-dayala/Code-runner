<script>
// Initialize CodeMirror with PHP syntax highlighting
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
    mode: "application/x-httpd-php",
    theme: "material",
    lineNumbers: true,
    lineWrapping: true
});

// Code snippet selection
$(document).on('click', '.code-snippet', function() {
    var snippet = $(this).data('snippet');
    editor.setValue(snippet); // Insert the snippet into the editor
});

// Run code function
$('#run-code').click(function() {
    const code = editor.getValue();

    $.ajax({
        url: "{{ route('php-execute') }}",
        method: "POST",
        data: {
            code: code,
            _token: "{{ csrf_token() }}"
        },
        success: function(response) {
            $('#output').html('<pre>' + response.output + '</pre>');
        },
        error: function(xhr) {
            $('#output').html('<pre>Error: ' + xhr.responseText + '</pre>');
        }
    });
});

// Event listener for toggling dropdown
document.querySelector('.category-header').addEventListener('click', function() {
    var dropdown = document.querySelector('.category-dropdown');
    dropdown.classList.toggle('open'); // Toggle dropdown visibility
});
</script>