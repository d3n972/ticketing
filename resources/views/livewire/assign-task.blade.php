<div>
    @include('components.sess_flash')
    <div class=" relative my-5 mx-5">
        <form wire:submit.prevent="submit" method="POST"  class="grid grid-cols-2 grid-flow-col">
        <div>
            <h3>{{__('Assign task')}}:{{$issue->id}}</h3>
            <select
            id="assignee"
            name="assignee"
            wire:model="assignee"
                class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
            >
            @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}({{$user->email}})</option>
            @endforeach
            </select>
        </div>
        {{-- <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div> --}}
        <div class="gap-5 p-5">
            <button type="submit" class="bg-green-600 py-3 rounded w-full text-white">{{__('Assign')}}</button>
        </div>
        </form>
    </div>
</div>
