<div class="mb-3">
    <label for="el-{{$input->getAttribute('name')}}" class="form-label">{{ $input->getAttribute('label') }}</label>

    @foreach($options as $key=>$op)
        <div class="form-check">
            <input
                    {{ $disabled ? 'disabled' : '' }}
                    class="form-check-input {{ $classes }}"
                    type="radio" name="{{ $input->getAttribute('name') }}"
                    id="op-{{ $key }}"
                    {{ $input->selectedBy($key) ? "checked" : '' }}
            >
            <label class="form-check-label" for="op-{{ $key }}">
                {{ $op }}
            </label>

            @if($loop->last)
                <div class="invalid-feedback">
                    {{ $input->getErrorMessage() }}
                </div>
            @endif
        </div>
    @endforeach


    <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
</div>