<x-app-layout>
    @push("scripts")
    <link rel="stylesheet" href="//cdn.jsdelivr.net/editor/0.1.0/editor.css">
    <script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
    <script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(_ => {

                        // $('select').select2(
                        //     {
                        //         theme:'classic'
                        //     }
                        // );

                        $("#subform").click(e => {
                            e.preventDefault();
                            let form = $("#ticket")[0];
                            console.dirxml(form)
                        })

                    })
    </script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create issue') }}
        </h2>
    </x-slot>


    <div class="mx-auto w-8/12 mt-4">
        <livewire:create-ticket />
    </div>

</x-app-layout>
