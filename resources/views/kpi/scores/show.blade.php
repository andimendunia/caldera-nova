<x-layout-kpi title="{{ $title }}" header="" prev="{!! $prev !!}" nav="submission"
    navs="{{ $navs }}">
    <div class="max-w-xl lg:max-w-6xl mx-auto px-4">
        <div class="text-neutral-500 dark:text-neutral-200 pb-20">
            <div>
                {{ $item->name }}
            </div>
            <div>
                {{ $item->unit }}
            </div>
        </div>
        <div class="max-w-lg mx-auto mt-12 px-4 sm:px-0 text-neutral-800 dark:text-neutral-200">
            <livewire:comments :mod="$inv_item" />
            @if (session('status'))
                <div x-data x-init="$nextTick(() => { notyf.success('{{ session('status') }}') })"></div>
            @endif
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Livewire.hook('commit', ({
                    component,
                    respond
                }) => {
                    const pgbar = document.getElementById('pgbar');
                    ( component.name == 'comments'  ) ? pgbar.classList.remove('hidden'): false;
                    respond(() => {
                        (component.name == 'inv-item-show' || component.name == 'inv-item-circ' ||
                            component.name == 'inv-item-circs' || component.name == 'comments' ||
                            component.name == 'com-item-write') ? pgbar.classList.add('hidden'): false;
                    });
                });
            });
        </script>
    </div>
</x-layout-kpi>
