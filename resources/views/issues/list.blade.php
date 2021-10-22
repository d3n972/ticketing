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
            @if (session()->has('message'))
                <div
                    class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3"
                    role="alert"
                >
                    <svg
                        class="fill-current w-4 h-4 mr-2"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"
                        />
                    </svg>
                    <p>{{ session('message') }}</p>
                </div>
            @endif

            <livewire:issues-table />
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
      {{--  <script>
            window.icons = {
                'pen': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16"><path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/></svg>`,
                'lock': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16"><path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/></svg>`,
                'person_add': `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16"><path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/><path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/></svg>`
            }

            function apiCall(url, bodyobj) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': document.head.querySelector("[name~=csrf-token][content]").content
                        },
                        body: JSON.stringify(bodyobj)
                    }).then(r => r.json())
                    .then(r => {
                        if (!r.error) {
                            Swal.fire(r.message);
                            window.dt.ajax.url('/api/issue/list').load();
                        }

                    });
            }
            $(document).ready(_ => {
                window.dt = $('#a').DataTable({
                    dom: 'lfrtipBQ',
                    buttons: [
                        'copy', 'excel', 'pdf'
                    ],
                    colReorder: true,
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
                            xhr.setRequestHeader("Authorization", "Bearer {{ $token }}")
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
                                <a href="javascript:apiCall('{{ route('issue.modify') }}',{id:${full.id}})">${window.icons.pen}</a>
                                <a href="javascript:apiCall('{{ route('issue.assign') }}',{id:${full.id}})">${window.icons.person_add}</a>
                                <a href="javascript:apiCall('{{ route('issue.lock') }}',{id:${full.id}})">${window.icons.lock}</a>
                            </div>
                            `;
                            }
                        }
                    ]
                });
            })
        </script>
        --}}
    @endpush
</x-app-layout>
