<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

{{--<link href="https://unpkg.com/tailwindcss@^2.2.7/dist/tailwind.min.css" rel="stylesheet">--}}

<form {{ $form->attributesString() }} class="form {{ $form->classString() }}">
    @csrf
    {!! $html !!}
    <button class="btn btn-primary">{{ $form->getConfig('btn.text') }}</button>
</form>

