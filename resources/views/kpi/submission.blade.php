<div id="content" class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
    <livewire:kpi-submission />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'kpi-submission' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'kpi-submission' ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
</div>
