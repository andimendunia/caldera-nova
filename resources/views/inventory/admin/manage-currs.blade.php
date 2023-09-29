<div id="content" class="py-12 max-w-xl mx-auto sm:px-3 text-neutral-800 dark:text-neutral-200">
    <div class="flex justify-between px-6 sm:px-0">
        <div>
            <div class="text-xl">
                {{ __('Mata uang') }}
            </div>
            <div class="text-sm mt-1">{{ $inv_currs->count() . ' ' . __('mata uang terdaftar') }}</div>
        </div>
        <x-secondary-button type="button" class="my-auto" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-curr')">{{ __('Tambah') }}</x-secondary-button>
        <x-modal name="create-curr" ref="inv-currs-create">
            <livewire:inv-currs-create lazy />
        </x-modal>
    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
            
            <table class="table">
                <tr class="uppercase text-xs">
                    <th>
                        {{ __('Nama') }}
                    </th>
                    <th>
                        {{ __('Nilai tukar' )}}
                    </th>
                </tr>
                @foreach($inv_currs as $inv_curr)
                <tr tabindex="0">
                    <td>
                        {{ $inv_curr->name }}
                        @if($inv_curr->id == 1)
                        <span><i class="fa fa-star text-sm ml-2"></i></span>
                        @endif
                    </td>
                    <td>
                        @if($inv_curr->id == 1)
                        <span>1</span>
                        @else
                        {{ $inv_curr->rate }}
                        @endif
                    </td>  
                </tr>          
                @endforeach
            </table>
        </div>
    </div>
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
