<div>
    <div class="flex justify-between px-6 sm:px-0">
        <div>
            {{ $currs->count() . ' ' . __('mata uang terdaftar') }}
        </div>
        <x-secondary-button type="button" class="my-auto" x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'create-curr')">{{ __('Buat') }}</x-secondary-button>

    </div>
    <div class="w-full mt-5">
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg">
            <table wire:key="currs-table" class="table">
                <tr class="uppercase text-xs">
                    <th>
                        {{ __('Nama') }}
                    </th>
                    <th>
                        {{ __('Nilai tukar') }}
                    </th>
                </tr>
                @foreach ($currs as $curr)
                    <tr wire:key="curr-tr-{{ $curr->id.$loop->index }}" tabindex="0" x-on:click="$dispatch('open-modal', 'edit-curr-{{ $curr->id }}')">
                        <td>
                            {{ $curr->name }}
                            @if ($curr->id == 1)
                                <span><i class="fa fa-star text-sm ml-2"></i></span>
                            @endif
                        </td>
                        <td>
                            @if ($curr->id == 1)
                                <span>1</span>
                            @else
                                {{ $curr->rate }}
                            @endif
                        </td>
                    </tr>
                    <x-modal :name="'edit-curr-' . $curr->id">
                        <livewire:inv-currs-edit wire:key="curr-lw-{{ $curr->id.$loop->index }}" :curr="$curr" lazy />
                    </x-modal>
                @endforeach
            </table>
        </div>
    </div>
</div>
