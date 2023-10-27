<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    <x-modal name="create-uom">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Penambahan UOM') }}
            </h2>
            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                {{__('Setiap UOM baru saat barang ditambahkan atau diedit, akan otomatis tersimpan di sini.')}}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Tutup') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
    <livewire:inv-uoms />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'inv-uoms' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'inv-uoms' ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
</div>
