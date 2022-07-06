<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<form {{ $form->attributesString() }} class="form {{ $form->classString() }}">
    @csrf
    {!! $html !!}
    <button class="btn btn-primary">{{ $form->getConfig('btn.text') }}</button>
</form>

