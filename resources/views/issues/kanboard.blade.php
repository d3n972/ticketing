<x-app-layout>
    @push('scripts')

    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kanboard') }}
        </h2>
    </x-slot>


    <div class="container grid grid-cols-1 mx-auto">
        <div class="mx-auto ">
            @include('components.sess_flash')

            <livewire:ticket-status-board
                :sortable="true"
                :sortable-between-statuses="true"
            />
        </div>
    </div>

</x-app-layout>
