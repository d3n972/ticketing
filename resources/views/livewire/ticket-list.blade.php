<x-app-layout>
    @push('scripts')

    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="container grid grid-col mx-auto mt-2">
    </div>
</x-app-layout>
