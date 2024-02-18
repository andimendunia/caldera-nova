<div class="flex flex-col gap-x-2 md:gap-x-4 sm:flex-row">
    <div>
        <div class="w-full sm:w-44 md:w-64 px-3 sm:px-0 mb-5">
            <x-select wire:model.live="sec_id">
                <option value="1">CE</option>
            </x-select>
            <x-select wire:model.live="year" class="mt-4">
                <option value="2024">2024</option>
            </x-select>
            <x-select wire:model.live="year" class="mt-4">
                <option value="1">January</option>
            </x-select>
            <div class="m-3">
                <div class="py-4">
                        <x-text-button type="button" wire:click="download" class="text-sm"><i
                                class="fa fa-fw mr-2 fa-download"></i>{{ __('Unduh CSV') }}</x-text-button>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        Show KPI items here
    </div>
</div>
