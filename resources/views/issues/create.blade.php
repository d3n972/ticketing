<x-app-layout>
    @push("scripts")
    <link rel="stylesheet" href="//cdn.jsdelivr.net/editor/0.1.0/editor.css">
    <script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
    <script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(_ => {
            const editor = new Editor();
            editor.render();
            // $('select').select2(
            //     {
            //         theme:'classic'
            //     }
            // );

        })
    </script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create issue') }}
        </h2>
    </x-slot>


    <div class="mx-auto w-8/12 mt-4">
        <form action="#" method="get">
            <div class="max-w-full mt-8">
                <div class="grid grid-cols-1 gap-6">
                    <div class="gap-5 grid grid-cols-2">
                        <label class="block">
                            <span class="text-gray-700">{{__('Title')}}</span>
                            <input name="title" type="text" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="{{__('Title')}}">
                        </label>
                        <label class="block">
                            <span class="text-gray-700">{{__('Severity')}}</span>
                            <select id="sev" name="sev" class=" block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="0">{{__('No impact / Informational')}}</option>
                                <option value="1">{{__('Low impact')}}</option>
                                <option value="2"'>{{__('Minor impact')}}</option>
                                <option value="3">{{__('Major impact')}}</option>
                                <option value="4">{{__('Severe')}}</option>
                                <option value="5">{{__('Critical / Immediate')}}</option>
                            </select>
                        </label>

                    </div>
                    <label class="block">
                        <span class="text-gray-700">{{__('Description')}}</span>
                        <textarea name="g" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                  " rows="3"></textarea>
                    </label>
                  <input type="submit" role="button" class="bg-blue-500 duration-300 hover:bg-blue-600 mx-auto px-4 py-2 rounded-lg text-blue-100 w-3/12" value="{{__('send')}}">
                </div>
            </div>
        </form>
    </div>
</x-app-layout>