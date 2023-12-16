<div class="p-6">
    <div class="flex justify-between items-center text-lg mb-6 font-medium text-neutral-900 dark:text-neutral-100">
        <h2>
            {{ __('Unduh sirkulasi barang') }}
        </h2>
        <x-text-button type="button" x-on:click="$dispatch('close')"><i class="fa fa-times"></i></x-text-button>
    </div>
    <form wire:submit.prevent="download">
        <div class="mb-6">
            <x-input-label for="inv-date-start" :value="__('Dari')" />
            <x-text-input wire:model.live="start_date" id="inv-date-start" type="date"></x-text-input>
        </div>
        <div class="mb-6">
            <x-input-label for="inv-date-end" :value="__('Sampai')" />
            <x-text-input wire:model.live="end_date" id="inv-date-end" type="date"></x-text-input>
        </div>
        <x-primary-button type="submit"><i class="fa fa-download mr-2"></i>{{ __('Unduh') }}</x-primary-button>
    </form>
    <x-spinner-bg wire:loading.class.remove="hidden" wire:target="download"></x-spinner-bg>
    <x-spinner wire:loading.class.remove="hidden"  wire:target="download" class="hidden"></x-spinner>
</div>
