<div class="{{ $input->getWrapperClass() }}">
    <label for="el-{{$input->getAttribute('name')}}" class="{{ $input->getLabelClass() }}">{{ $input->getAttribute('label') }}</label>
    <div class="{{ $input->getParentClass() }}">
        <textarea
            class="form-control {{ $input->classString() }} @if($errors->has($input->getAttribute('name'))) is-invalid @endif"
           {!! $input->attributesString() !!}
    >{{ old($input->getAttribute('name'),$input->getAttribute('value')) }}</textarea>
        <div class="invalid-feedback">
            {{ $errors->first($input->getAttribute('name')) }}
            {{ $input->getErrorMessage() }}
        </div>
        <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
    </div>


</div>
