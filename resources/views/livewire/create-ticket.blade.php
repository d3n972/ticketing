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
    <form wire:submit.prevent="submit" method="POST">
        <div>
            @if (session()->has('message'))
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ session('message') }}</p>
            </div>
            @endif
        </div>
        <div class="max-w-full mt-8">
            <div class="grid grid-cols-1 gap-6">
                <div class="gap-5 grid grid-cols-1">
                    <label class="block">
                        <span class="text-gray-700">{{__('Title')}}</span>
                        <input wire:model="title" name="title" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="{{__('Title')}}">
                    </label>
                </div>
                <div class="gap-5 grid grid-cols-2">
                    <label class="block">
                        <span class="text-gray-700">{{__('Severity')}}</span>
                        <select wire:model="severity" id="sev" name="sev" class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option selected value="-99" disabled>{{__('Please select')}}</option>
                            @foreach($severities as $sev)
                            <option value="{{$sev->id}}">{{__($sev->name)}}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block">
                        <span class="text-gray-700">{{__('Project')}}</span>
                        <select wire:model="project" id="project" name="project" class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option selected value="-99" disabled>{{__('Please select')}}</option>
                            @foreach($teams as $t)
                            <option value="{{$t->id}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <label class="block" wire:ignore>
                    <span class="text-gray-700">{{__('Description')}}</span>
                    <textarea wire:model="description" name="g" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  " rows="3"></textarea>
                </label>
                <button type="submit" class="bg-blue-500 duration-300 hover:bg-blue-600 mx-auto px-4 py-2 rounded-lg text-blue-100 w-3/12"> {{__('send')}} </button>
            </div>
        </div>
    </form>
</div>
