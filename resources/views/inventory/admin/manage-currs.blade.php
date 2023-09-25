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
        <x-modal name="create-curr" :show="$errors->currCreation->isNotEmpty()" focusable>
            <form method="post" action="{{ route('inventory.currs.create') }}"  class="p-6">
                @csrf
                <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                    {{ __('Tambah mata uang') }}
                </h2>
                <div class="mt-6">
                    <x-text-input id="inv-curr-name" name="name" type="text"
                        placeholder="{{ __('Mata uang') }}" />
                    <x-input-error :messages="$errors->currCreation->get('name')" class="mt-2" />
                    <x-text-input id="inv-curr-rate" class="mt-4" name="rate" type="number"
                        placeholder="{{ __('Nilai tukar') }}" />
                    <div class="text-sm mt-2">{{ __('Nilai tukar terhadap mata uang utama.') }}</div>
                    <x-input-error :messages="$errors->currCreation->get('rate')" class="mt-2" />
                </div>
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        {{ __('Tambah') }}
                    </x-primary-button>
                </div>
            </form>
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
    @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            notyf.success("{{ session('success') }}");
        });
    </script>
    @endif
</div>
