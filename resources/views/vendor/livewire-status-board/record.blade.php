
{{-- Injected variables $record, $styles --}}
<div
    id="{{ $record['id'] }}"
    @if($recordClickEnabled)
        wire:click="onRecordClick('{{ $record['id'] }}')"
    @endif
    class="{{ $styles['record'] }} {{$record['severity']->css_classes}}">

    @include($recordContentView, [
        'record' => $record,
        'styles' => $styles,
    ])

</div>
