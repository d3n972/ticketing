<div class="grid p-5 bg-gray-800">
    @include('components.sess_flash')
    <div >
      <h3 class="font-semibold text-xl text-white leading-tight text-center">Proposal for payment</h3>
      <div class="gap-3 flex flex-row">
          <div>Ticket id:</div>
          <pre>{{$ps->issue()->ticket_id}}</pre>
      </div>
      <div class="gap-3 flex flex-row">
          <div>Amount</div>
          <div>{{$ps->price}} Ft</div>
      </div>
      <div>
          <span>Description:</span>
          <blockquote class="border-l-2 border-gray-400 pl-4 ml-4 my-2">Loremipsum</blockquote>
      </div>
  </div>
  <div class="gap-5 grid grid-cols-2">
    <button wire:click="accept" class="bg-green-500 px-2 py-1.5 rounded"> Accept </button>
    <button wire:click="reject" class="bg-red-500 px-2 py-1.5 rounded"> Reject </button>
  </div>
</div>
