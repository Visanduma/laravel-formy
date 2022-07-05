<div class="mb-3">
    <label class="form-label">{{ $input->getAttribute('label') }}</label>

    @foreach($options as $key=>$op)
        <div class="form-check">
            <input
                    {{ $input->getAttribute('disabled') !== "" ? 'disabled' : '' }}
                    class="form-check-input {{ $input->classString() }}"
                    type="radio" name="{{ $input->getAttribute('name') }}"
                    id="formy-{{ $key }}"
                    {{ $input->selectedBy($key) ? "checked" : '' }}
            >
            <label class="form-check-label" for="formy-{{ $key }}">
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
