<div class="overflow-hidden shadow text-white">
    @push('scripts')
        <link
            rel="stylesheet"
            href="//cdn.jsdelivr.net/editor/0.1.0/editor.css"
        >
        <script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
        <script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>
        <link
            rel="stylesheet"
            href="/css/markdown.css"
        >
    @endpush
    <div class="py-5">
        <p class="mt-1 max-w-2xl text-sm text-white">
            {{ $issue->ticket_id }} was created by {{ $issue->author()->first()->name }} at
            {{ $issue->getCreatedAt() }}

        </p>
        <div class="flex">
            <button
                wire:click="$emit('openModal', 'work-on-task-form',{{ json_encode(['issue' => $issue]) }})"
                class="text-purple-500 bg-transparent border-l border-t border-b border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded-l outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                type="button"
            >
                <svg
                    version="1.1"
                    id="Layer_1"
                    fill="white"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="16"
                    height="16"
                    x="0px"
                    y="0px"
                    viewBox="0 0 16 16"
                    enable-background="new 0 0 16 16"
                    xml:space="preserve"
                >
                    <path
                        d="M13.648,13.714h-0.319c-0.169-2.163-1.448-4.087-3.376-5.082C9.941,8.611,9.932,8.594,9.917,8.573 c-0.205-0.202-0.205-0.532,0-0.736l0,0c0.01-0.009,0.015-0.021,0.021-0.032c1.937-0.993,3.221-2.919,3.391-5.091h0.318 c0.389,0,0.699-0.312,0.699-0.7c0-0.387-0.312-0.7-0.699-0.7H2.135c-0.387,0-0.7,0.313-0.7,0.7c0,0.388,0.313,0.7,0.7,0.7H2.47 C2.642,4.878,3.918,6.8,5.844,7.797C5.855,7.81,5.859,7.824,5.87,7.837c0.204,0.204,0.204,0.532,0,0.733v0.003 C5.855,8.596,5.84,8.616,5.829,8.639c-1.919,1-3.187,2.92-3.359,5.075H2.135c-0.387,0-0.7,0.312-0.7,0.7 c0,0.388,0.313,0.701,0.7,0.701h11.514c0.388,0,0.699-0.313,0.699-0.701C14.348,14.025,14.035,13.714,13.648,13.714L13.648,13.714z M12.104,2.714c-0.047,0.366-0.131,0.725-0.248,1.075c-0.078-0.038-0.162-0.057-0.25-0.058H3.923C3.818,3.4,3.741,3.06,3.696,2.714 H12.104z M4.471,4.945h6.858C10.634,6.201,9.335,7,7.9,7.054C6.467,7,5.164,6.2,4.471,4.945z M7.235,8.213h0.002H7.235L7.235,8.213z M7.9,9.376c2.125,0,3.895,1.892,4.206,4.338h-8.41C4.005,11.268,5.776,9.376,7.9,9.376z"
                    ></path>
                </svg>
            </button>

            <x-dropform>
                <x-slot name="trigger">
                    <button
                        @click="open = true"
                        class="text-purple-500 bg-transparent border border-solid border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                        type="button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 16 16"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10.5968953,10.8770743 L5.40310466,10.8770743 C2.4867301,10.8770743 0.113169755,13.1043898 0,15.948901 L1.30095143,16 C1.38607912,13.8578496 3.18878317,12.179598 5.40310466,12.179598 L10.5968953,12.179598 C12.8112168,12.179598 14.6139209,13.8578496 14.6990486,16 L16,15.948901 C15.8868302,13.1043898 13.5132699,10.8770743 10.5968953,10.8770743 L10.5968953,10.8770743 Z M5.67551327,2.74231323 C5.73660491,2.67017346 5.81171758,2.61406475 5.87981973,2.54893857 C6.77716575,2.59903563 7.30195293,3.21823533 8.2243365,3.40359446 C8.55082624,3.46872065 8.82824236,3.496775 9.07561342,3.496775 C9.53930896,3.496775 9.89984977,3.39658088 10.2894342,3.24628969 C10.4106159,3.20020039 10.4977466,3.15210721 10.5698548,3.10301209 C10.8602904,3.59496525 10.9744617,4.15905818 10.879319,4.7351744 L10.5688533,6.5927735 C10.3645468,7.81814766 9.28392589,8.70686956 8,8.70686956 C6.71607411,8.70686956 5.63545318,7.81814766 5.43114672,6.5927735 L5.12068102,4.7351744 C5.00050075,4.01477863 5.1977967,3.3074081 5.67551327,2.74231323 L5.67551327,2.74231323 Z M4.14722083,6.80718893 C4.45468202,8.65376667 6.08612919,10.0093932 8,10.0093932 C9.9128693,10.0093932 11.5443165,8.65376667 11.8527792,6.80718893 L12.1632449,4.94958983 C12.3645468,3.74425449 11.9599399,2.60504728 11.1957937,1.77844574 C11.5012519,1.58106331 11.6564847,1.2844887 11.6564847,1.2844887 C11.6564847,1.2844887 11.327992,1.08510239 11.0866299,0.942826727 C10.3495243,0.506982278 8.82623936,0 7.60841262,0 C6.95843766,0 6.40260391,0.148287307 6.0901352,0.52401528 C5.10265398,0.666290939 4.27841763,1.56803807 4.24336505,2.54292692 C3.85778668,3.25129939 3.69153731,4.08491452 3.83675513,4.94958983 L4.14722083,6.80718893 Z"
                            ></path>
                        </svg>
                    </button>
                </x-slot>
                <div
                    class="w-max max-w-2xl py-1 "
                    role="none"
                >
                    @livewire('assign-task',['issue'=>$issue])
                </div>

            </x-dropform>

            @if($issue->hasAnyProposals())
                <button
                    wire:click="$emit('openModal', 'paid-service-form',{{ json_encode(['issue' => $issue]) }})"
                    class="bg-red-700 animate-pulse bg-transparent border border-solid border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                    type="button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-cash" viewBox="0 0 16 16">
                        <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path
                            d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                    </svg>
                </button>
            @endif
            <button
                wire:click="$emit('openModal', 'label-form',{{ json_encode(['issue' => $issue]) }})"
                class="text-purple-500 bg-transparent border border-solid border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                type="button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                >
                    <path
                        d="M8 1H1v7l8 8 7-7zM2.4 7.42v-5h5L14 9l-5 5zM5 4a1.11 1.11 0 1 0 1.14 1.06A1.11 1.11 0 0 0 5 4z"
                    ></path>
                </svg>
            </button>
            <button
                wire:click="$emit('openModal', 'change-priority',{{ json_encode(['issue' => $issue]) }})"
                class="text-purple-500 bg-transparent border border-solid border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                type="button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="white"
                    width="16"
                    height="16"
                    fill="currentColor"
                    class="bi bi-arrow-down-up"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"
                    />
                </svg>
            </button>
            <button
                class="text-purple-500 bg-transparent border-t border-b border-r border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 rounded-r outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                type="button"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="white"
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    class="glyph_f10"
                >
                    <path
                        d="M12 6V3.74A3.75 3.75 0 0 0 8.26 0h-.52A3.75 3.75 0 0 0 4 3.74V6H2v9h12V6zm-3.3 6a.7.7 0 1 1-1.4 0V8h1.4zm1.9-6H5.4V3.74A2.34 2.34 0 0 1 7.74 1.4h.52a2.34 2.34 0 0 1 2.34 2.34z"
                    ></path>
                </svg>
            </button>
        </div>
        <div class="flex gap-3">
            <h1 class="font-medium text-3xl">
                {{ $issue->title }}
            </h1>
            <button
                wire:click="$emit('openModal', 'ticket-editor',{{ json_encode(['issue' => $issue]) }})"
                class="text-purple-500 bg-transparent border border-solid border-gray-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-xs px-4 py-2 outline-none focus:outline-none mb-1 ease-linear transition-all duration-150"
                type="button"
            >[edit]
            </button>
        </div>
    </div>
    <div class="grid grid-cols-3 gap-5">
        <div class="col-span-2">
            <div class="content">
                {!! $issue->getContent() !!}
            </div>
            <div class="mt-5">
                @if ($issue->attachments()->count() > 0)

                    <ul
                        role="list"
                        class="border border-gray-200 rounded-md divide-y gap-5 divide-gray-200"
                    >
                        @foreach ($issue->attachments() as $file)
                            @livewire('attachment-view',['attachment'=>$file])
                        @endforeach

                    </ul>
                @endif
                <h4 class="mt-10 pt-7 text-2xl">Comments:</h4>
                <div class="grid grid-cols-1 border-t2 border-gray-600">
                    <div class="border-gray-500 divide-y-2 gap-10 grid grid-cols-1 mt-5 pt-5">
                        @foreach ($issue->getComments() as $c)
                            <div class="grid grid-flow-row hover:bg-gray-600">
                                <span>{{ $c->author }} {{ __('commented') }} {{ $c->created_at }}</span>
                                <p>{{ $c->content }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="border-gray-500 border-t">
                <div class="grid grid-flow-col">
                    <div class="grid-span-2">
                        <dl class="divide-gray-800 divide-y">
                            <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-white">
                                    {{ __('Title') }}
                                </dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    {{ $issue->title }}
                                </dd>
                            </div>
                            <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-white">
                                    {{ __('Author') }}
                                </dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    {{ \App\Models\User::where('id', '=', $issue->author)->first()->name }}
                                    ({{ \App\Models\User::where('id', '=', $issue->author)->first()->email }})
                                </dd>
                            </div>

                            <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-white">
                                    {{ __('Assignee') }}
                                </dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    {{ \App\Models\User::where('id', '=', $issue->assignee)->first()->name }}
                                </dd>
                            </div>
                            <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-white">
                                    {{ __('Severity') }}
                                </dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    {{ $issue->severity()->first()->name }}
                                </dd>
                            </div>
                            <div class="bg-gray-900 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-white">
                                    {{ __('Due date') }}
                                </dt>
                                <dd class="mt-1 text-sm {{ $dateColor }} sm:mt-0 sm:col-span-2">
                                    {{ $issue->due_at }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>
