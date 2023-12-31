<div x-data="{
    ids: @entangle('ids')," class="p-6">
    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
        {{ __('Cetak sirkulasi') }}
    </h2>
    <div class="text-sm text-neutral-600 dark:text-neutral-400">
        <p class="mt-3">
            {{ __('Mengarahkanmu ke halaman cetak...') }}
        </p>
        <p class="mt-3">
        <div x-text="ids"></div>
        </p>
    </div>
    <div class="mt-6 flex justify-end">
        <x-secondary-button type="button" x-on:click="$dispatch('close')">
            {{ __('Tutup') }}
        </x-secondary-button>
    </div>
</div>
