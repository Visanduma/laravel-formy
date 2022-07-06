<div class="mb-3">
    <label for="{{$input->getAttribute('id')}}" class="form-label">{{ $input->getAttribute('label') }}</label>
    <input
            class="{{ $input->classString() }} "
            {!! $input->attributesString() !!}
    >
    <div class="invalid-feedback">
        {{ $errors->first($input->getAttribute('name')) }}
        {{ $input->getErrorMessage() }}
    </div>

    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>

<script>
    var options = @json($input->options());

    const el = document.getElementById('{{ $input->getAttribute('id')  }}')
    const pond = FilePond.create(el,options)
</script>
