<div class="{{ $input->getWrapperClass() }}">
    <label for="el-{{$input->getAttribute('name')}}" class="{{ $input->getLabelClass() }}">{{ $input->getAttribute('label') }}</label>

    <div class="{{ $input->getParentClass() }}">
        @foreach($options as $key=>$op)
            <div class="form-check">
                <input
                    {{ $input->getAttribute('disabled') !== "" ? 'disabled' : '' }}
                    class="form-check-input {{ $input->classString() }}"
                    type="checkbox"
                    name="{{ $input->getAttribute('name') }}"
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



</div>
