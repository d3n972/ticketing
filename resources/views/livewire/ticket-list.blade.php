@push('scripts')
    <link rel="stylesheet" href="/css/markdown.css">
@endpush
<x-slot name="header">
    <h2 class="font-semibold text-xl text-white leading-tight">
        {{ __('Dashboard') }}
    </h2>
</x-slot>


<div class="container grid grid-col mx-auto mt-2">
    <ul>
        @foreach($issues as $issue)
            @include('livewire.ticket-list-item',['issue'=>$issue])

        @endforeach
        <div>
            {{$issues->links()}}
        </div>
        @if(sizeof($issues)==0)
            <div class="flex font-black justify-center text-xl">
                <h2>There are no tickets...</h2>
            </div>
        @endif
    </ul>
</div>
