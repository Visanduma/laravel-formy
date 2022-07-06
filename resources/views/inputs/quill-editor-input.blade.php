<div class="mb-3">
    <label for="{{$input->getAttribute('id')}}" class="form-label">{{ $input->getAttribute('label') }}</label>

    <div class="{{ $input->classString() }}"  {!! $input->attributesString() !!}>
        {{ old($input->getAttribute('name'),$input->getAttribute('value')) }}
    </div>
    <div class="invalid-feedback">
        {{ $errors->first($input->getAttribute('name')) }}
        {{ $input->getErrorMessage() }}
    </div>
    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
    <input type="hidden" name="{{ $input->getAttribute('name') }}" value="" id="formy-quill-content">
</div>

<script>
    var options = @json($input->options());
    var quill = new Quill('#{{ $input->getAttribute('id') }}', options);

    quill.on('editor-change',function(){
        document.getElementById('formy-quill-content').value = quill.root.innerHTML
    })

</script>
