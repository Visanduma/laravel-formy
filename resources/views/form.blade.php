@prepend('formy-css')
<link href="{{ asset('vendor/formy/css/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/formy/css/filepond.css') }}" rel="stylesheet" />
@endprepend

@prepend('formy-js')
<script src="{{ asset('vendor/formy/js/quill.js') }}"></script>
<script src="{{ asset('vendor/formy/js/filepond.js') }}"></script>
@endprepend

<form {{ $form->attributesString() }} class="form {{ $form->classString() }}">
    @csrf
    {!! $html !!}
    <button type="submit" class="{{ $form->getConfig('submit-btn.class') }}">{{ $form->getConfig('submit-btn.text') }}</button>
    @if(!$form->getConfig('reset-btn.disabled'))
        <button type="reset" class="{{ $form->getConfig('reset-btn.class') }}">{{ $form->getConfig('reset-btn.text') }}</button>
    @endif
</form>
