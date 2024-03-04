<div id="content" class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
    <livewire:kpi-overview />
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('commit', ({ component, respond }) => {
                const pgbar = document.getElementById('pgbar');
                component.name == 'kpi-overview' ? pgbar.classList.remove('hidden') : false;
                respond(() => {
                    component.name == 'kpi-overview' ? pgbar.classList.add('hidden') : false;
                });
            });
        });
    </script>
    {{-- <div class="flex mb-5 gap-x-2">
        <x-select>
            <option value="2024">2024</option>
        </x-select>
        <x-select>
            <option value="1">{{ Carbon\Carbon::createFromFormat('m', '1')->format('F') }}</option>
            <option value="2">{{ Carbon\Carbon::createFromFormat('m', '2')->format('F') }}</option>
            <option value="3">{{ Carbon\Carbon::createFromFormat('m', '3')->format('F') }}</option>
        </x-select>
    </div>
    <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-x-auto p-1">
        <table x-data class="table table-sm table-kpi">
            <tr class="uppercase text-xs">
                <th>
                    {{ __('No') }}
                </th>
                <th>
                    {{ __('Nama') }}
                </th>
                <th>
                    {{ __('Satuan') }}
                </th>
                <th>
                    {{ __('Target') }}
                </th>
                <th>
                    {{ __('Aktual') }}
                </th>
                <th></th>
                <th>{{ __('Status') }}</th>
            </tr>
            <tr tabindex="0" x-on:click="$dispatch('open-modal', 'edit-kpi-item-')">
                <td>
                    1
                </td>
                <td>
                    Year-over-Year Sales Growth and Market Expansion Rate
                </td>
                <td>
                    point
                </td>
                <td>
                    1000
                </td>
                <td>
                    1000
                </td>
                <td>
                    <div class="flex text-xs items-center"><i class="fa fa-paperclip mr-1"></i><span>1</span></div>
                </td>
                <td>
                    <div class="uppercase text-xs items-center">{{ __('Draf') }}</div>
                </td>
            </tr>
        </table>
    </div> --}}

</div>
