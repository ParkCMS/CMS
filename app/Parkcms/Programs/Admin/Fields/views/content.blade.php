<div class="form-group">
    @if ($label)
        <label for="form-{{ $name }}">{{ $label }}</label>
    @endif
    @if ($wysiwyg)
    <textarea ui-tinymce="{resize: true, plugins: 'image code link', menubar: false, toolbar1: 'undo redo | cut copy paste | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect', toolbar2: 'bullist numlist | outdent indent | blockquote | removeformat subscript superscript | image | code | link unlink'}" {{ $attributes }} ng-model="form.{{ $name }}" name="{{ $name }}">{{ $value }}</textarea>
    @else
    <textarea {{ $attributes }} ng-model="form.{{ $name }}" name="{{ $name }}">{{ $value }}</textarea>
    @endif
</div>