<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    <x-modal name="create-uom">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Tambah UOM') }}
            </h2>
            <div class="mt-6">
                {{__('UOM baru akan otomatis tersimpan saat membuat barang. Tidak perlu menambahkan secara manual.')}}
            </div>
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
            Livewire.hook('element.init', ({ component }) => {
                const n = component.name;
                if (n == 'inv-uoms-edit') {
                    const i = component.el.getElementsByTagName('input');
                    i.length > 0 ? i[0].focus() : false;
                }
            });
        });
    </script>
</div>
