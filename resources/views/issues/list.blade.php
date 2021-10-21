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
                    <td>{{__('id')}}</td>
                    <td>{{__('Severity')}}</td>
                    <td>{{__('Title')}}</td>
                    <td>{{__('Author')}}</td>
                    <td>{{__('Assignee')}}</td>
                    <td>{{__('Status')}}</td>
                    <td>{{__('Actions')}}</td>
                </thead>
            </table>
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
    <script>
        window.icons = {
            'pen': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/></svg>`,
            'lock': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/></svg>`,
            'person_add': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16"><path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/><path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/></svg>`
        }

        function apiCall(url, bodyobj) {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token':document.head.querySelector("[name~=csrf-token][content]").content
                },
                body: JSON.stringify({
                    'client_id': '(API KEY)',
                    'client_secret': '(API SECRET)',
                    'grant_type': 'client_credentials'
                })
            });
        }
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
                "rowCallback": function(row, data, dataIndex) {
                    // console.dirxml(data);
                    switch (parseInt(data.severityNumeric, 10)) {
                        case 1:
                            $(row).addClass('gray');
                            break;
                        case 4:
                        case 5:
                        case 6:
                            $(row).addClass('red');
                        default:
                            break;
                    }


                },
                columns: [{
                        data: "id"
                    },
                    {
                        data: 'severity',
                        render: function(data, type, full, meta) {
                            return data.name;
                        }
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'author',
                        'render': function(data, type, full, meta) {
                            return data.name;
                        }
                    },
                    {
                        data: 'assignee',
                        'render': function(data, type, full, meta) {
                            return data.name;
                        }
                    },
                    {
                        data: 'status',
                        'render': function(data, type, full, meta) {
                            return data == -1 ? 'Open' : 'Closed';
                        }
                    },
                    {
                        render: function(data, type, full, meta) {
                            //  debugger;
                            return `
                            <div class="grid grid-cols-4 row-auto">
                                <a href="javascript:apiCall('{{route('issue.modify')}}',{id:${full.id}})">${window.icons.pen}</a>
                                <a href="javascript:apiCall('{{route('issue.assign')}}',{id:${full.id}})">${window.icons.person_add}</a>
                                <a href="javascript:apiCall('{{route('issue.lock')}}',{id:${full.id}})">${window.icons.lock}</a>
                            </div>
                            `;
                        }
                    }
                ]
            });
        })
    </script>
    @endpush
</x-app-layout>
