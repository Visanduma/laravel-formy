<div class="{{ $input->getWrapperClass() }}">
    <label for="{{$input->getAttribute('id')}}" class="{{ $input->getLabelClass() }}">{{ $input->getAttribute('label') }}</label>
    <div class="{{ $input->getParentClass() }}">
        <input
            class="{{ $input->classString() }} "
            {!! $input->attributesString() !!}
        >
        <div class="text-danger form-text">{{ $errors->first($input->getAttribute('name')) }}</div>
        <p class="form-text">{{ $input->getAttribute('helpText')  }}</p>
    </div>
</div>

<div>
    @if($input->getFilesList())
    <ul class="list-group">
        @foreach($input->getFilesList() as $file)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $file['name'] }}
                <div>
                    <a href="{{ $file['url'] }}"><i class="bi bi-eye"></i></a>
                    <a class="del-btn" data-id="{{ $file['id'] }}" href="#"><i class="bi bi-trash"></i></a>
                </div>
            </li>
        @endforeach
    </ul>
    @endif
</div>

@push('formy-js')
<script>
    FilePond.create(
        document.getElementById('{{ $input->getAttribute('id')  }}'),
        @json($input->options())
    )

    document.querySelectorAll('.del-btn').forEach(item => {

        item.addEventListener('click', event => {
            if(confirm('Delete it ?')){
                axios.post('{{ route('formy.delete-file') }}', {
                    file: item.dataset.id
                })
                .then(res =>{
                    item.closest('li').remove()
                })
            }

            event.preventDefault()
        })
    })


</script>
@endpush
