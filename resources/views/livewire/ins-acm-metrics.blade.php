<div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0">
            <x-select wire:model.live="view">
                <option value="raw">{{ __('Data mentah') }}</option>
                <option value="line-all">{{ __('Line (semua)') }}</option>
                <option value="line-single">{{ __('Line (tunggal)') }}</option>
            </x-select>
        </div>
    </div>
    <div class="w-full">
        Data view
    </div>
</div>