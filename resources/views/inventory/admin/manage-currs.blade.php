<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    <x-modal name="create-curr">
        <livewire:inv-currs-create lazy />
    </x-modal>
    <livewire:inv-currs />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({component, respond}) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'inv-currs' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'inv-currs' ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
</div>
