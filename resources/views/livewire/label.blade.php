@if ($removable)
    @push('scripts')
        <script>
            $(document).ready(_ => {
                Livewire.on('removeLabel_{{ $label_id }}', r => {
                    let id = "#" + r.id;

                    let labels_cont = document.querySelector('.labels-container');
                    let products = document.querySelectorAll(id);
                    $(id)[0].classList.add('label-anim-remove');

                    $(id)[0].addEventListener('animationend', function() {
                        [...products].forEach((p) => p.parentNode.removeChild(p))
                    });
                })
            })
        </script>
    @endpush
@endif

<div
    id='{{ $label_id }}'
    class="inline-flex items-center justify-center {{$removable?'pl-2':'px-2'}} py-1 mr-2 text-xs font-bold leading-none rounded {{ $css }}"
>
    {{ $content }}
    @if ($removable)
        <svg
            wire:click="remove('{{ $label_id }}')"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            class="inline-block w-4 h-4 mr-2 stroke-current"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
            ></path>
        </svg>
    @endif
</div>
