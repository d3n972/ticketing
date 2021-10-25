<x-app-layout>
    @push('scripts')

    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="container grid grid-cols-1 mx-auto">
        <div class="mx-auto ">
            @include('components.sess_flash')

            <livewire:issues-table />
        </div>
    </div>
    @push('endscripts')
        <style>
            .red {
                background-color: red !important;
                color: white;
            }

            .gray {
                background-color: gray !important;
                color: white;
            }

        </style>
   @endpush
</x-app-layout>
