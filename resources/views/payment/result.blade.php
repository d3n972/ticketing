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

            <div class="grid justify-items-center p-5">
                @if($pd->status=="Succeeded")
                    <div class="m-5 text-green-600 w-56">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path
                                d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                    </div>
                    <div class="text-2xl">{{__('Payment succeded!')}}</div>
                @else
                    <div class="m-5 text-red-600 w-56">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </div>
                    <div class="text-2xl">{{__('Payment failed!')}}</div>
                @endif


                <div>
                    <div class="grid grid-rows-2 justify-items-center">
                        <div class="flex gap-2">

                            <div>{{__('Order number')}}:</div>
                            <div>{{$pd->order_number}}</div>
                        </div>
                        <div class="flex gap-2">
                            <div>{{__('Completed at')}}:</div>
                            <div>{{$pd->completed_at}}</div>
                        </div>
                    </div>
                </div>
            </div>
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
