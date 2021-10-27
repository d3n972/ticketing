<div>
    @include('components.sess_flash')
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
    <div class=" relative my-5 mx-5">
        <form wire:submit.prevent="submit" method="POST" class="grid">
            <div>
                <h3>{{__('Work on')}}:{{$issue->id}}</h3>

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
            <div class="gap-5 p-5">
                @if(!$issue->isWorkInProgress())
                    <button type="submit" class="bg-red-400 py-3 rounded w-full">{{__('Stop work')}}</button>
                @else
                    <button type="submit" class="bg-green-400 py-3 rounded w-full">{{__('Start work')}}</button>
                @endif

            </div>
        </form>
    </div>
</div>
