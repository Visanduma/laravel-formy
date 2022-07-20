<div class="mb-3">
    <label for="{{$input->getAttribute('id')}}" class="form-label">{{ $input->getAttribute('label') }}</label>
    <input
            class="{{ $input->classString() }} "
            {!! $input->attributesString() !!}
    >


    <div class="text-danger form-text">{{ $errors->first($input->getAttribute('name')) }}</div>
    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>

<script>

    FilePond.create(
        document.getElementById('{{ $input->getAttribute('id')  }}'),
        @json($input->options())
    )
</script>
