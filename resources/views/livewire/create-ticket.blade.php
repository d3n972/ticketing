<div>
    @push('scripts')
        <script>
            $(document).ready(e => {
                window.editor = new Editor();
                window.editor.render();
                window.editor.codemirror.on('change', (e) => {
                    console.dirxml(e)
                    @this.set('description', window.editor.codemirror.getValue());
                });

            })
        </script>
    @endpush
    <form
        wire:submit.prevent="submit"
        method="POST"
    >
        <div>
            @include('components.sess_flash')
        </div>
        <div class="max-w-full mt-8">
            <div class="grid grid-cols-1 gap-6">
                <div class="gap-5 grid grid-cols-1">
                    <label class="block">
                        <span class="text-gray-700">{{ __('Title') }}</span>
                        <input
                            wire:model="title"
                            name="title"
                            type="text"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="{{ __('Title') }}"
                        >
                    </label>
                </div>
                <div class="gap-5 grid grid-cols-3">
                    <label class="block">
                        <span class="text-gray-700">{{ __('Severity') }}</span>
                        <select
                            wire:model="severity"
                            id="sev"
                            name="sev"
                            class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option
                                selected
                                value="-99"
                                disabled
                            >{{ __('Please select') }}</option>
                            @foreach ($severities as $sev)
                                <option value="{{ $sev->id }}">{{ __($sev->name) }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">{{ __('Project') }}</span>
                        <select
                            wire:model="project"
                            id="project"
                            name="project"
                            class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                            <option
                                selected
                                value="-99"
                                disabled
                            >{{ __('Please select') }}</option>
                            @foreach ($teams as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="blokc">
                        <span class="text-gray-700">{{ __('Due date') }}</span>
                        <input
                            type="date"
                            name="due_at"
                            id="due_at"
                            wire:model="due_at"
                            wire:bind="due_at"
                            min="{{$mindate}}"
                            class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                    </label>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="gap-5 grid grid-cols-1">
                        <label class="block">
                            <span class="text-gray-700">{{ __('Attachments') }}</span>

                            <input
                                    wire:model="attachments"
                                    name="attachments"
                                    type="file"
                                    multiple
                                    id="attachments"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="{{ __('Title') }}"
                            >
                        </label>
                    </div>
                <label
                    class="block"
                    wire:ignore
                >
                    <span class="text-gray-700">{{ __('Description') }}</span>
                    <textarea
                        wire:model="description"
                        name="g"
                        class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  "
                        rows="3"
                    ></textarea>
                </label>
                <button
                    type="submit"
                    class="bg-blue-500 duration-300 hover:bg-blue-600 mx-auto px-4 py-2 rounded-lg text-blue-100 w-3/12"
                > {{ __('send') }} </button>
            </div>
        </div>
    </form>
</div>
