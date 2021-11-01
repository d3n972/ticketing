<div class="bg-gray-800 text-white p-5">
    <form action="#" wire:submit.prevent="submit" class="grid gap-5">
        <input type="hidden" id="ticket_id" wire:model="issue.id">
        <label class="block">
            <span class="text-gray-200">{{ __('Title') }}:</span>
            <input
                type="text"
                name="title"
                id="title"
                wire:model="issue.title"
                wire:bind="issue.title"
                class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
        </label>
        <label class="block">
            <span class="text-gray-200">{{ __('Description') }}:</span>
            <textarea
                type=""
                name="content"
                id="content"
                wire:model="issue.content"
                wire:bind="issue.content"
                rows="10"
                class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            ></textarea>
        </label>
        <div x-data='{open:false}'>
            <label class="block">
                <input
                    type="checkbox"
                    name="chb_paidsrv"
                    id="chb_paidsrv"
                    @click="open=true"
                    {{--wire:model="issue.title"
                     wire:bind="issue.title"--}}
                    class="bg-gray-800 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 rounded-md shadow-sm"
                >
                <span class="text-gray-200">{{ __('Paid service') }}</span>

            </label>
            <div
                class="border border-gray-800 content max-h-96 overflow-auto p-5"
                x-show="open"
                style="display: none;"

            >
                <label class="block flex gap-2">
                    <span class="text-gray-200">{{ __('Price in HUF') }}:</span>
                    <input
                        type="number"
                        name="price"
                        id="price"
                         wire:model="price"
                        wire:bind="price"
                        class="block  bg-gray-800 w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    >

                </label>
            </div>
        </div>
        <div class="pt-3">
            <button type="submit" class="button bg-green-500 rounded p-3 w-full">[save]</button>
        </div>
    </form>
</div>
