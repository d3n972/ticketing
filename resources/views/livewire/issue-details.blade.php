<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    @push("scripts")
        <link rel="stylesheet" href="//cdn.jsdelivr.net/editor/0.1.0/editor.css">
        <script src="//cdn.jsdelivr.net/editor/0.1.0/editor.js"></script>
        <script src="//cdn.jsdelivr.net/editor/0.1.0/marked.js"></script>

    @endpush
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Ticket')}} {{ $issue->ticket_id }}
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            {{-- Personal details and application. --}}
        </p>
    </div>
    <div class="border-t border-gray-200 divide-y divide-y-reverse divide-gray-200">
        <div class="grid grid-flow-col">
            <div class="grid-span-2">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Title') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $issue->title }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Author') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ \App\Models\User::where('id','=',$issue->author)->first()->name }}
                            ({{ \App\Models\User::where('id','=',$issue->author)->first()->email }})
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Assignee') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ \App\Models\User::where('id','=',$issue->assignee)->first()->name }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Due date') }}
                        </dt>
                        <dd class="mt-1 text-sm {{$dateColor}} sm:mt-0 sm:col-span-2">
                            {{ $issue->due_at }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Descripiton') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! Str::markdown($issue->content) !!}
                        </dd>
                    </div>

                    <div
                            class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                            style=""
                    >
                        <dt class="text-sm font-medium text-gray-500">
                            Attachments
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul
                                    role="list"
                                    class="border border-gray-200 rounded-md divide-y gap-5 divide-gray-200"
                            >
                                @foreach($issue->attachments() as $file)
                                    @livewire('attachment-view',['attachment'=>$file])
                                @endforeach

                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="grid grid-flow-col gap-3 p-3">
            @if(!$issue->isWorkInProgress())
                <button wire:click="$emit('openModal', 'work-on-task-form',{{json_encode(['issue'=>$issue])}})"
                        class="bg-green-400 rounded py-2">{{__('Start work')}}</button>
            @else
                <button wire:click="$emit('openModal', 'change-priority',{{json_encode(['issue'=>$issue])}})"
                        class="bg-red-400 rounded py-2">{{__('Stop work')}}</button>
            @endif
            <button wire:click="$emit('openModal', 'assign-task',{{json_encode(['issue'=>$issue])}})"
                    class="bg-blue-200 rounded py-2">{{__('Assign task')}}</button>
            <button wire:click="$emit('openModal', 'change-priority',{{json_encode(['issue'=>$issue])}})"
                    class="bg-blue-200 rounded py-2">{{__('Set priority')}}</button>
            <button class="bg-red-700 text-white rounded py-2">{{__('Close task')}}</button>
        </div>
    </div>
</div>
