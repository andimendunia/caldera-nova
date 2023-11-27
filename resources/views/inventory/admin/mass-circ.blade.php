<div id="content" class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
    <livewire:inv-mass-circ />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                ( component.name == 'inv-mass-circ' ) ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    ( component.name == 'inv-mass-circ' ) ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
</div>
    
