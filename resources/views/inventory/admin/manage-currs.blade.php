<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    <x-modal name="create-curr">
        <livewire:inv-currs-create lazy />
    </x-modal>
    <livewire:inv-currs />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Livewire.hook('commit', ({respond}) => {
            // document.getElementById('pgbar').classList.remove('hidden');
            // respond(() => {
            //     document.getElementById('pgbar').classList.add('hidden');
            // })
            Livewire.on('curr-created', () => {
                notyf.success("{{ __('Mata uang dibuat') }}");
                const escapeKeyEvent = new KeyboardEvent('keydown', {
                    key: 'Escape',
                    keyCode: 27,
                    which: 27,
                    code: 'Escape',
                });
                window.dispatchEvent(escapeKeyEvent);
            });
            Livewire.on('curr-updated', () => {
                notyf.success("{{ __('Mata uang diperbarui') }}");
                const escapeKeyEvent = new KeyboardEvent('keydown', {
                    key: 'Escape',
                    keyCode: 27,
                    which: 27,
                    code: 'Escape',
                });
                window.dispatchEvent(escapeKeyEvent);
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
