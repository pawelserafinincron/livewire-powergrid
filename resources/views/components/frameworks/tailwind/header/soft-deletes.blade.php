@if(data_get($setUp, 'header.softDeletes'))

    <div x-data="{open: false}"
         class="mr-0 sm:mr-2 mt-2 sm:mt-0"
         @click.outside="open = false">
        <button @click.prevent="open = ! open"
                class="block bg-pg-primary-50 text-pg-primary-700 border border-pg-primary-300 rounded py-1.5 px-3 leading-tight
                       focus:outline-none focus:bg-white focus:border-pg-primary-600 dark:border-pg-primary-500 dark:bg-pg-primary-700
                       2xl:dark:placeholder-pg-primary-300 dark:text-pg-primary-200 dark:text-pg-primary-300">
            <div class="flex">
                <x-livewire-powergrid::icons.trash class="text-pg-primary-500 dark:text-pg-primary-300"/>
            </div>
        </button>

        <div x-show="open"
             x-cloak
             x-transition:enter="transform duration-200"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transform duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             class="mt-2 py-2 w-48 bg-white shadow-xl absolute z-10 dark:bg-pg-primary-600">

            <div x-on:click="$wire.emit('pg:softDeletes-{{ $tableName }}', ''); open = false"
                 class="cursor-pointer flex justify-start block px-4 py-2 text-pg-primary-800 hover:bg-pg-primary-50 hover:text-black-200 dark:text-pg-primary-200 dark:hover:bg-gray-900 dark:hover:bg-pg-primary-700">
                @lang('livewire-powergrid::datatable.soft_deletes.without_trashed')
            </div>
            <div x-on:click="$wire.emit('pg:softDeletes-{{ $tableName }}', 'withTrashed'); open = false"
                 class="cursor-pointer flex justify-start block px-4 py-2 text-pg-primary-800 hover:bg-pg-primary-50 hover:text-black-200 dark:text-pg-primary-200 dark:hover:bg-gray-900 dark:hover:bg-pg-primary-700">
                @lang('livewire-powergrid::datatable.soft_deletes.with_trashed')
            </div>
            <div x-on:click="$wire.emit('pg:softDeletes-{{ $tableName }}', 'onlyTrashed'); open = false"
                 class="cursor-pointer flex justify-start block px-4 py-2 text-pg-primary-800 hover:bg-pg-primary-50 hover:text-black-200 dark:text-pg-primary-200 dark:hover:bg-gray-900 dark:hover:bg-pg-primary-700">
                @lang('livewire-powergrid::datatable.soft_deletes.only_trashed')
            </div>

        </div>
    </div>
@endif
