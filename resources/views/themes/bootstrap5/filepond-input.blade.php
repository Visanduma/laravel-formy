<div class="{{ $input->getWrapperClass() }}">
    <label for="{{$input->getAttribute('id')}}" class="{{ $input->getLabelClass() }}">{{ $input->getAttribute('label') }}</label>
    <div class="{{ $input->getParentClass() }}">
        <input
            class="{{ $input->classString() }} "
            {!! $input->attributesString() !!}
        >
        <div class="text-danger form-text">{{ $errors->first($input->getAttribute('name')) }}</div>
        <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
    </div>
</div>

<script>
    FilePond.create(
        document.getElementById('{{ $input->getAttribute('id')  }}'),
        @json($input->options())
    )
</script>
