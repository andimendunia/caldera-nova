<div id="content" class="py-12 max-w-xl mx-auto px-3 text-neutral-800 dark:text-neutral-200">
   <div class="w-full">
       <div class="flex">
           <div class="mr-auto">
               <div class="text-sm">{{ '0'.' '. __('mata uang terdaftar')}}</div>
           </div>
           <x-secondary-button type="button" class="mb-3"
           x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-curr')">{{ __('Tambah') }}</x-secondary-button>
       </div>
       <x-modal name="create-curr" focusable>
        <form method="post" action="#" class="p-6">
            @csrf        
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Tambah mata uang') }}
            </h2>             
            <div class="mt-6">
                <x-text-input id="inv-curr-name" class="mb-4" name="inv-curr-name" type="text" placeholder="{{ __('Mata uang') }}" />
                <x-text-input id="inv-curr-rate" class="mb-4" name="inv-curr-rate" type="number" placeholder="{{ __('Nilai tukar') }}" />
                <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Mata uang yang pertama ditambahkan akan dianggap sebagai mata uang utama. Maka dari itu, mata uang ini akan dijadikan acuan nilai tukar mata uang lain (bila ada) dan akan digunakan pada sirkulasi.') }}
                </p>
                <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                    {{ __('Mata uang utama juga tidak dapat diubah di kemudian.')}}
                </p> 
                <x-checkbox id="inv-confirm">{{ __('Aku paham dengan pernyataan di atas') }}</x-checkbox>
            </div>        
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('Tambah') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
       <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-hidden">
           <div class="py-12 fle items-center"><div class="w-80 mx-auto text-center">{{ __('Tidak ada mata uang') }}</div></div>
       </div>
   </div>
</div>
   
