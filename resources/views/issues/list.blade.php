<x-app-layout>
    @push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/date-1.1.1/r-2.2.9/rr-1.2.8/sb-1.2.2/datatables.min.css" />

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/date-1.1.1/r-2.2.9/rr-1.2.8/sb-1.2.2/datatables.min.js"></script>
    @endpush
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="container grid grid-cols-1 mx-auto">
        <div class="mx-auto w-9/12">

        <table id="a">
            <thead>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
            </thead>
        </table>
        </div>
    </div>
    @push('endscripts')
    <script>
        $(document).ready(_ => {
            var dt = $('#a').DataTable({
                "ajax": {
                    "processing": true,
                    "serverSide": true,
                    "url": '/api/issue/list',
                    //  "dataSrc": "result",
                    "dataType": "json",
                    "type": "GET",
                    "crossDomain": true,
                    "dataSrc": "",
                    "beforeSend": function(xhr) {
                        xhr.setRequestHeader("Authorization", "Bearer {{$token}}")
                    }
                },
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'author'
                    },
                    {
                        data: 'severity'
                    },
                    {
                        data: 'author'
                    },
                    {
                        data: 'assignee'
                    },
                    {
                        data: 'status'
                    }
                ]
            });
        })
    </script>
    @endpush
</x-app-layout>
