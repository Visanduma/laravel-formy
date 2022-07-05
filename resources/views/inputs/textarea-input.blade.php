<div class="mb-3">
    <label for="el-{{$input->getAttribute('name')}}" class="form-label">{{ $input->getAttribute('label') }}</label>
    <textarea
            class="form-control {{ $classes }}"
           {!! $input->attributesString() !!}
    >
 {{ old($input->getAttribute('name'),$input->getAttribute('value')) }}
    </textarea>

    <div class="invalid-feedback">
        {{ $input->getErrorMessage() }}
    </div>
    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>
