<div class="mx-5 my-7 pb-5">
    <form
        action="#"
        class="grid gap-5"
    >
        <label class="block">
            <span class="text-gray-200">{{ __('Due date') }}</span>
            <input
                type="text"
                name="due_at"
                id="due_at"
                {{-- wire:model="due_at"
                wire:bind="due_at" --}}
                class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
        </label>
        <label class="block">
            <span class="text-gray-200">{{ __('Due date') }}</span>
            <input
                type="text"
                name="due_at"
                id="due_at"
                {{-- wire:model="due_at"
                wire:bind="due_at" --}}
                class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
        </label><label class="block">
            <span class="text-gray-200">{{ __('Due date') }}</span>
            <input
                type="text"
                name="due_at"
                id="due_at"
                {{-- wire:model="due_at"
                wire:bind="due_at" --}}
                class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
        </label>
        <label class="block">
            <span class="text-gray-200">{{ __('Due date') }}</span>
            <input
                type="text"
                name="due_at"
                id="due_at"
                {{-- wire:model="due_at"
                wire:bind="due_at" --}}
                class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
        </label>
        <label
            class="block"
            x-data='{open:false}'
        >
            <span class="text-gray-200">{{ __('Due date') }}</span>
            <div>
                <span
                    @click="open=true"
                    class="flex"
                >
                    <span>Color</span>
                    <span class="align-middle flex mb-0 ml-3 pb-0 py-1">
                        <svg
                            x-show="open==false"
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-chevron-bar-expand"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3.646 10.146a.5.5 0 0 1 .708 0L8 13.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-4.292a.5.5 0 0 0 .708 0L8 2.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zM1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8z"
                            />
                        </svg>
                        <svg
                            x-show="open==true"
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-chevron-bar-contract"
                            viewBox="0 0 16 16"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3.646 14.854a.5.5 0 0 0 .708 0L8 11.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zm0-13.708a.5.5 0 0 1 .708 0L8 4.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zM1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8z"
                            />
                        </svg>
                    </span>
                </span>
                <div
                    class="border border-gray-800 content max-h-96 overflow-auto p-5"
                    x-show="open"
                    style="display: none;"

                >
                    <select
                        :class="clsText+ ' '+selected"
                        x-model="selected"
                        x-data="{clsText: 'block bg-gray-900 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50',selected:''}"
                        name="color"
                        id="color"
                        class=" "
                    >
                        @foreach ($colors as $color)
                            <option
                                class="{{ $color->bg }} {{$color->forcefg?$color->fg:''}}"
                            >{{$color->bg}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </label>
    </form>
</div>
