<form {{ $form->attributesString() }} class="form {{ $form->classString() }}">
    @csrf
    {!! $html !!}
    <button class="btn btn-primary">{{ $form->getConfig('btn.text') }}</button>
</form>
