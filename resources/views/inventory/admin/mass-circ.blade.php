<div id="content" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">

        <div class="flex">
            <div class="w-full sm:w-44 md:w-56 px-3 sm:px-0 mb-10 mx-auto">
                <x-select name="area" id="inv-area" class="mb-3">
                    <option value="">{{ __('Area')}}</option>
                    <option value="">{{ __('TT MM') }}</option>
                    <option value="">{{ __('TT Maintenance') }}</option>
                </x-select>
                <x-secondary-button class="w-full mb-3"><i class="fa fa-upload mr-2"></i>{{ __('Unggah') }}</x-secondary-button>
                <div class="text-sm mx-auto text-center">
                    <x-link href="#">{{ __('Unduh berkas contoh') }}</x-link>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="flex">
                <div class="mr-auto">
                    <div class="text-2xl mb-3">TT MM</div>
                    <div class="text-sm">12 baris sah, 2 baris dibuang</div>
                </div>
                <div class="w-56">
                    <x-primary-button class="w-full mb-3">{{ __('Buat :count sirkulasi')}}</x-primary-button>
                    <x-secondary-button class="w-full mb-3">{{ __('Ulangi dari awal') }}</x-secondary-button>
                </div>
            </div>
            <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-hidden">
                <div class="py-12 text-center">{{ __('Unggah berkas terlebih dahulu') }}</div>
            </div>
        </div>
</div>
    
