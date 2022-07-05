<div class="mb-3">
    <label for="el-{{$input->getAttribute('name')}}" class="form-label">{{ $input->getAttribute('label') }}</label>
    <select
        {!! $input->attributesString() !!}
            class="form-select {{ $input->classString() }}"
    >
        @foreach($options as $key=>$op)
            <option {{ $input->selectedBy($key) ? "selected" : '' }} value="{{ $key }}">{{ $op }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        {{ $input->getErrorMessage() }}
    </div>
    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>
