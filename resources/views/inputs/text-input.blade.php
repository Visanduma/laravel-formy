<div class="mb-3">
    <label for="{{$input->getAttribute('id')}}" class="form-label">{{ $input->getAttribute('label') }}</label>
    <input
            class="form-control {{ $input->classString() }} @if($errors->has($input->getAttribute('name'))) is-invalid @endif"
            {!! $input->attributesString() !!}
    >
    <div class="invalid-feedback">
        {{ $errors->first($input->getAttribute('name')) }}
        {{ $input->getErrorMessage() }}
    </div>

    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>