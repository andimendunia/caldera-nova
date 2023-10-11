<div id="content" class="pt-12 max-w-2xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    {{-- <x-modal name="create-loc">
        <div class="p-6">
            <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                {{ __('Tambah lokasi') }}
            </h2>
            <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                {{__('Lokasi baru akan otomatis tersimpan saat membuat barang. Tidak perlu menambahkan secara manual.')}}
            </p>
            <div class="mt-6 flex justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Paham') }}
                </x-secondary-button>
            </div>
        </div>
    </x-modal> --}}
    <livewire:inv-locs />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'inv-locs' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'inv-locs' ? pgbar.classList.add('hidden') : false;
                });
            });
            Livewire.hook('element.init', ({ component }) => {
                const n = component.name;
                if (n == 'inv-locs-edit') {
                    const i = component.el.getElementsByTagName('input');
                    i.length > 0 ? i[0].focus() : false;
                }
            });
        });
    </script>
</div>
