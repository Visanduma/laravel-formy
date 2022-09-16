<button class="{{ $input->classString() }}" {!! $input->attributesString() !!} >
    @if($input->getAttribute('hasSpinner'))
    <span v-show="form.processing" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    @endif
    {{ $input->getAttribute('label') }}
</button>

