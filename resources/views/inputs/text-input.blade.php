<div class="{{ $input->getWrapperClass() }}">
    <label for="{{$input->getAttribute('id')}}" class="{{ $input->getLabelClass() }}">{{ $input->getAttribute('label') }}</label>
    <div class="{{ $input->getParentClass() }}">
        <input
                class="form-control {{ $input->classString() }} @if($errors->has($input->getAttribute('name'))) is-invalid @endif"
                {!! $input->attributesString() !!}
        >
        <div class="invalid-feedback">
            {{ $errors->first($input->getAttribute('name')) }}
            {{ $input->getErrorMessage() }}
        </div>
    </div>

    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>
