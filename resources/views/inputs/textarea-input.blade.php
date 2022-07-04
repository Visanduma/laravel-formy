<div class="mb-3">
    <label for="el-{{$input->getAttribute('name')}}" class="form-label">{{ $input->getAttribute('label') }}</label>
    <textarea
            {{ $disabled ? 'disabled' : '' }}
            class="form-control {{ $classes }}"
            name="{{ $input->getAttribute('name') }}"
            id="el-{{ $input->getAttribute('name') }}"
            cols="{{ $input->getAttribute('cols') }}"
            rows="{{ $input->getAttribute('rows') }}"
    >
 {{ old($input->getAttribute('name'),$input->getAttribute('value')) }}
    </textarea>

    <div class="invalid-feedback">
        {{ $input->getErrorMessage() }}
    </div>
    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>