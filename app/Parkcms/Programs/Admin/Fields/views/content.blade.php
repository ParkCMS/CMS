<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <textarea ui-tinymce="{plugins: 'image code link', menubar: false, toolbar1: 'undo redo | cut copy paste | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect', toolbar2: 'bullist numlist | outdent indent | blockquote | removeformat subscript superscript | image | code | link unlink'}" {{ $attributes }} ng-model="form.{{ $name }}" ng-init="form.{{ $name }}='{{ $value }}'" name="{{ $name }}">{{ $value }}</textarea>
</div>