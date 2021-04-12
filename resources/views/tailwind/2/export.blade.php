<button
    class="mb-1 bg-indigo-400 text-white focus:bg-indigo-200 focus:outline-none text-sm py-2.5 px-5 rounded-lg items-center inline-flex"
    wire:click="exportToExcel()"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"></path>
    </svg>
    <span style="padding-left: 6px">
    {!! (count($checkbox_values)) ? trans('livewire-powergrid::datatable.buttons.export_selected') :
         trans('livewire-powergrid::datatable.buttons.export') !!}
    </span>
</button>
