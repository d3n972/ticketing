{{--<div x-data="{ open: false }">
    <span @click="open = true">{{$trigger}}</span>

    <div x-show="open" @click.away="open = false"  style="display: none;">
        {{ $slot }}
    </div>
</div>

--}}
<div class="relative inline-block text-left " x-data="{ open: false }">
    <div>
        <span @click="open=true">{{$trigger}}</span>
    </div>
    <div x-show="open" style="display: none;" @click.away="open = false"
         class="absolute bg-gray-600 focus:outline-none mt-2 origin-top-right ring-1 ring-black ring-opacity-5 rounded-md shadow-lg"
         role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div
            class="bg-gray-600 focus:outline-none max-w-2xl mt-2 origin-top-right ring-1 ring-black ring-opacity-5 rounded-md shadow-lg">
            {{ $slot }}
        </div>
    </div>
</div>

