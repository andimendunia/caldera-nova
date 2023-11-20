<x-layout-inventory title="{{ $title }}" prev="{{ $prev }}" header="" nav="" navs="true">
    <div class="sm:my-12 pt-0 max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
        <livewire:inv-item-show :$inv_item @updated="$refresh" />
        <hr class="border-neutral-200 dark:border-neutral-800" />
    </div>
    <div class="max-w-lg mx-auto mt-12 px-4 sm:px-0 text-neutral-800 dark:text-neutral-200">
        <livewire:comments :mod="$inv_item" />
        @if(session('status'))
        <div x-data x-init="$nextTick(() => {notyf.success('{{ session('status') }}')})"></div>
        @endif
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                ( component.name == 'inv-item-show' || component.name == 'inv-item-circ' || component.name == 'inv-item-circs' || component.name == 'comments' || component.name == 'com-item-write' ) ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    ( component.name == 'inv-item-show' || component.name == 'inv-item-circ' || component.name == 'inv-item-circs' || component.name == 'comments' || component.name == 'com-item-write' ) ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
</x-inventory>