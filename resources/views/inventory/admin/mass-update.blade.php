<div id="content" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-200">
    <div class="flex flex-col gap-x-4 md:gap-x-8 sm:flex-row">
        <div>
            <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0 mb-10">
            <x-secondary-button class="mb-3"><i class="fa fa-upload mr-2"></i>{{ __('Unggah') }}</x-secondary-button>
            <div class="text-sm"><x-link href="#">{{ __('Unduh berkas contoh') }}</x-link></div>
            
            <x-select name="area" id="inv-area" class="mb-3">
                <option value="">{{ __('Area')}}</option>
                <option value="">{{ __('TT MM') }}</option>
                <option value="">{{ __('TT Maintenance') }}</option>
            </x-select>
            <x-secondary-button class="w-full mb-3">{{ __('Ulangi dari awal') }}</x-secondary-button>
            <x-primary-button class="w-full mb-3">Perbarui 2 barang</x-primary-button>

            </div>
        </div>
        <div class="w-full">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                <div class="py-12 text-center">{{ __('Unggah berkas terlebih dahulu') }}</div>
            </div>
        </div>
    </div>
</div>
    
