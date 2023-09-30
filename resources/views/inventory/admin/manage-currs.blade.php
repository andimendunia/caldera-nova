<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    <x-modal name="create-curr">
        <livewire:inv-currs-create lazy />
    </x-modal>
    <livewire:inv-currs />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const escKeyEvent = new KeyboardEvent('keydown', {
                key: 'Escape',
                keyCode: 27,
                which: 27,
                code: 'Escape',
            });

            Livewire.hook('commit', ({component, respond}) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'inv-currs' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'inv-currs' ? pgbar.classList.add('hidden') : false;
                });
            });
            Livewire.on('created', () => {
                notyf.success("{{ __('Mata uang dibuat') }}");
                window.dispatchEvent(escKeyEvent);
            });
            Livewire.on('updated', () => {
                notyf.success("{{ __('Mata uang diperbarui') }}");
                window.dispatchEvent(escKeyEvent);
            });
            Livewire.on('deleted', ({ id }) => {
                notyf.success("{{ __('Mata uang dihapus') }}");
                window.dispatchEvent(escKeyEvent);
            });
        });
    </script>
    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            notyf.success("{{ session('success') }}");
        });
    </script>
    @endif
</div>
