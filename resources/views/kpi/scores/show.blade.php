<x-layout-kpi title="{{ $title }}" header="" prev="{!! $prev !!}" nav="submission"
    navs="{{ $navs }}">
    <div class="max-w-lg mx-auto mt-12 text-neutral-800 dark:text-neutral-200">
        <livewire:kpi-score-show :$item :$score />
        <div class="mt-12 px-6">
            <livewire:comments :mod="$score" />
            @if (session('status'))
                <div x-data x-init="$nextTick(() => { notyf.success('{{ session('status') }}') })"></div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({
                component,
                respond
            }) => {
                const pgbar = document.getElementById('pgbar');
                ( component.name == 'kpi-score-show' || component.name == 'comments' ) ? pgbar.classList.remove('hidden'): false;
                respond(() => {
                    ( component.name == 'kpi-score-show' || component.name == 'comments' ) ? pgbar.classList.add('hidden'): false;
                });
            });
        });
    </script>
</x-layout-kpi>
