<li class="flex pb-4" x-data="{ open: false }">
    <span class="h-1/2 mb-1 mr-5 px-2 rounded {{$issue->severity()->first()->getCss()}}">N</span>
    <div class="flex-1 gap-4 grid">

        <div class="flex-1 grid grid-rows-2">

            <div class="grid grid-cols-3">
                <div class="col-span-2 flex flex-row gap-4">
                    <span>{{$issue->ticket_id}}</span>
                    <span>{{$issue->title}}</span>
                </div>
                <div class="flex gap-4 ml-auto mr-0">
                <span>
                    <svg fill="white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><g><path
                                class="icon-comment"
                                d="M13.23,2H2.77A1.77,1.77,0,0,0,1,3.77v7.44A1.77,1.77,0,0,0,2.77,13H3v3l4.16-3h6.06A1.77,1.77,0,0,0,15,11.21V3.77A1.77,1.77,0,0,0,13.23,2Zm.37,9.21a.38.38,0,0,1-.37.37H2.77a.38.38,0,0,1-.37-.37V3.77a.38.38,0,0,1,.37-.37H13.23a.38.38,0,0,1,.37.37Z"></path></g></svg>
                </span>
                    <span>
                    <svg fill="white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16"><path
                            d="M1 15h1.8V6H1zm12.6-9.38H10L10.64 4a3.31 3.31 0 0 0 .21-1.76 2.72 2.72 0 0 0-.64-1.37 2.77 2.77 0 0 0-.67-.56A1.17 1.17 0 0 0 8.65 0 1 1 0 0 0 8 .66c-.11.29-.22.59-.34.88l-.57 1.4L4 6v9h7.11a1.82 1.82 0 0 0 1.61-1l1.94-3.68A3 3 0 0 0 15 8.94V7.07a1.42 1.42 0 0 0-1.39-1.45zm0 3.32a1.58 1.58 0 0 1-.18.73l-1.93 3.68a.46.46 0 0 1-.38.25H5.4v-7l2.67-2.67a1.37 1.37 0 0 0 .3-.45c.13-.29.44-1 .72-1.76a1.46 1.46 0 0 1 .26 1.7L8 7l5.6.05z"></path></svg>
                </span>
                    <span @click="open=true">
                    <svg x-show="open==false" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor"
                         class="bi bi-chevron-bar-expand" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M3.646 10.146a.5.5 0 0 1 .708 0L8 13.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-4.292a.5.5 0 0 0 .708 0L8 2.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zM1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8z"/>
                    </svg>
                    <svg x-show="open==true" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" class="bi bi-chevron-bar-contract" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M3.646 14.854a.5.5 0 0 0 .708 0L8 11.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708zm0-13.708a.5.5 0 0 1 .708 0L8 4.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zM1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8z"/>
                    </svg>
</span>
                </div>
            </div>
            <div class="divide-fields flex flex-row gap-6 leading-snug text-sm">
            <span class="">
                {{$issue->severity()->first()->name}}
            </span>
                <span class="">[type]</span>
                <span class="">Stat:-1</span>
                <span class="">{{$issue->assignee()->first()->name}}</span>
                <span class="">[subsys]</span>
                <span class="">{{$issue->getTimeHuman($issue->due_at,'Y. m. d.')}}</span>
                <span class="">estimation</span>
                <span class="">spent-time</span>
                <div class="ml-auto mr-0">
                    <span class="pl-5">{{$issue->author()->first()->name}}</span>
                    <span class="pl-5">{{$issue->getTimeHuman($issue->updated_at)}}</span>
                </div>

            </div>
        </div>
        <div class="border border-gray-800 content max-h-96 overflow-auto p-5"
             x-show="open" style="display: none;" @click.away="open = false">{!! $issue->getContent() !!}</div>
    </div>
</li>
