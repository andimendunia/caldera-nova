<div  class="p-6">        
    <h2 class="text-lg mb-4 font-medium text-neutral-900 dark:text-neutral-100">
        {{ __('Sirkulasi') }}
    </h2>
    <div class="flex items-center mb-4 gap-x-4">
        54
        <div>
            EA
        </div>
    </div>   
    <div class="text-sm">
        <span>Ambil</span><span class="mx-2">•</span><span>3.564,00 USD</span><span class="mx-2">•</span><span>10 → 8</span>
    </div>
    <hr class="border-neutral-300 dark:border-neutral-700 my-4">
    <div class="flex text-sm gap-x-2">
        <div class="grow truncate">
            <div class="flex truncate gap-x-2">
                <div class="truncate font-medium text-neutral-900 dark:text-neutral-100">
                    I COULD HAVE MY GUCCI ON
                </div>
                <div>•</div>
                <div class="truncate">
                    I COULD WEAR MY LOUIS VOUITTON
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <x-link href="/inventory/items/1" target="_blank"><i class="fa fa-external-link-alt"></i></x-link>
        </div>  
    </div>   
    <hr class="border-neutral-300 dark:border-neutral-700 my-4">
    <div class="mb-6">
        <div class="mb-4">
            <div class="flex items-center">
                <div class="w-4 h-4 mr-2 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="block fill-current text-neutral-800 dark:text-neutral-200 opacity-25" viewBox="0 0 1000 1000" xmlns:v="https://vecta.io/nano"><path d="M621.4 609.1c71.3-41.8 119.5-119.2 119.5-207.6-.1-132.9-108.1-240.9-240.9-240.9s-240.8 108-240.8 240.8c0 88.5 48.2 165.8 119.5 207.6-147.2 50.1-253.3 188-253.3 350.4v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c0-174.9 144.1-317.3 321.1-317.3S821 784.4 821 959.3v3.8a26.63 26.63 0 0 0 26.7 26.7c14.8 0 26.7-12 26.7-26.7v-3.8c.2-162.3-105.9-300.2-253-350.2zM312.7 401.4c0-103.3 84-187.3 187.3-187.3s187.3 84 187.3 187.3-84 187.3-187.3 187.3-187.3-84.1-187.3-187.3z"/></svg>
                </div>
                <div>Andi Permana</div>
            </div>
            <div class="text-sm mt-2">Diwakili oleh Bella Puspita</div>
        </div>
        <x-text-input id="inv-remarks" class="mb-2" name="remarks" type="text" placeholder="{{ __('Keterangan') }}" autocomplete="inv-remarks" />
        <x-select id="inv-qty-type">
            <option value="">{{ __('Qty utama') }}</option>
            <option value="">{{ __('Qty bekas') }}</option>
            <option value="">{{ __('Qty diperbaiki') }}</option>
        </x-select>
    </div>
    <div class="truncate text-sm">
        <div class="truncate mb-2"><i class="fa fa-fw fa-check-circle mr-2"></i>Disetujui oleh Bella Puspita</div>
        <div class="text-xs truncate text-neutral-400 dark:text-neutral-600">Diperbarui pada 2023-08-06 13:28</div>
    </div>
    <div class="mt-6 flex justify-end gap-x-2">
        <x-secondary-button x-on:click="$dispatch('close')">{{__('Batal')}}</x-secondary-button> 
        <x-primary-button>{{__('Simpan')}}</x-primary-button> 
    </div>
</div>