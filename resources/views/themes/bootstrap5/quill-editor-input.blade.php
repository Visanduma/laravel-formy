<div class="{{ $input->getWrapperClass() }}">
    <label for="{{$input->getAttribute('id')}}" class="{{ $input->getLabelClass() }}">{{ $input->getAttribute('label') }}</label>

    <div class="{{ $input->getParentClass() }}">
        <div class="{{ $input->classString() }}"  {!! $input->attributesString() !!}>
            {!! old($input->getAttribute('name'),$input->getAttribute('value')) !!}
        </div>
        <div class="text-danger">
            {{ $errors->first($input->getAttribute('name')) }}
            {{ $input->getErrorMessage() }}
        </div>
        <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
                <input type="hidden" name="{{ $input->getAttribute('name') }}" value="{{ old($input->getAttribute('name'),$input->getAttribute('value')) }}" id="formy-quill-content">
    </div>

</div>

@push('formy-js')
    <script>
        var options = @json($input->options());
        var quill = new Quill('#{{ $input->getAttribute('id') }}', options);

        quill.on('editor-change',function(){
            document.getElementById('formy-quill-content').value = quill.root.innerHTML
        })

    </script>
@endpush
