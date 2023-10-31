<x-layout-inventory title="{{ $title }}" prev="{{ $prev }}" header="{{ $header }}" nav="" navs="">
    <div class="sm:py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
        <livewire:inv-form :$inv_item />   
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'inv-form' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'inv-form' ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
</x-layout-inventory>