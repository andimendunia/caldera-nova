<div id="content" class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
    <div class="flex mb-5 gap-x-2">
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
            <x-modal :name="'edit-kpi-item-'">
                <div>
                    <div wire:submit="update()" class="p-6">
                        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">Year-over-Year Sales Growth and Market Expansion Rate</h2>
                        <div class="mt-6">
                            <div class="font-medium text-sm text-neutral-700 dark:text-neutral-300" >
                                {{ __('Masa') }}
                            </div>
                            <div>January 2024</div>
                        </div>
                        <div class="mt-6">
                            <div class="font-medium text-sm text-neutral-700 dark:text-neutral-300" >
                                {{ __('Target') }}
                            </div>
                            <div>1000 point</div>
                        </div>
                        <div class="mt-6">
                            <label class="block font-medium text-sm mb-1 text-neutral-700 dark:text-neutral-300" for="inv-area-name" >
                                {{ __('Aktual') }}
                            </label>
                            <x-text-input id="inv-area-name" wire:model="name" type="text"
                                placeholder="{{ __('Skor') }}" />
                            @error('name')
                                <x-input-error messages="{{ $message }}" class="mt-2" />
                            @enderror
                        </div>
                        <div class="mt-6">
                            <x-toggle><span>Publish</span></x-toggle>
                        </div>
                        
                    </div>
                    <div class="p-6">
                        <div>
                            <h1>Comments (0)</h1>
                        </div>
                        <div class="relative mt-8">
                            <div class="relative" wire:target="save" wire:loading.class="opacity-30">
                                <div class="absolute bottom-1 left-0 w-full flex justify-center">
                                </div>
                            </div>
                            <div wire:submit.prevent="save" class="flex gap-x-4" wire:target="save"
                                wire:loading.class="opacity-30">
                                <div>
                                    <div
                                        class="w-8 h-8 bg-neutral-200 dark:bg-neutral-700 rounded-full overflow-hidden">
                                        <img class="w-full h-full object-cover dark:brightness-75"
                                            src="/storage/users/2_20231124185416_muxsK.jpg">
                                    </div>
                                </div>
                                <div class="w-full">
                                    <textarea rows="1" name="comment" placeholder="Write a comment..." style="min-height:66px;"
                                        class="block w-full border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 focus:border-caldy-500 dark:focus:border-caldy-600 focus:ring-caldy-500 dark:focus:ring-caldy-600 rounded-md shadow-sm"></textarea>
                                    <div wire:key="files" class="flex justify-between items-start mt-3">
                                        <div class="text-sm">
                                            <button
                                                class="rounded focus:outline-none focus:ring-2 focus:ring-caldy-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition ease-in-out duration-150"
                                                type="button" x-on:click="$refs.upload.click()">
                                                <i class="fa fa-paperclip mr-2"></i>Attach
                                            </button> <input x-ref="upload" type="file" wire:model="files"
                                                hidden="" multiple="">
                                        </div>
                                        <div>
                                            <span class="mr-2 text-xs font-mono">999</span>
                                            <button type="submit"
                                                class="text-xs px-4 py-2 bg-neutral-800 dark:bg-neutral-200 border border-transparent rounded-md font-semibold text-white dark:text-neutral-800 uppercase tracking-widest hover:bg-neutral-700 dark:hover:bg-white focus:bg-neutral-700 dark:focus:bg-white active:bg-neutral-900 dark:active:bg-neutral-300 focus:outline-none focus:ring-2 focus:ring-caldy-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition ease-in-out duration-150">
                                                Post
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div wire:loading.class.remove="hidden" wire:target="save"
                                class="w-full h-full absolute top-0 left-0 hidden"></div>
                            <div class="spinner z-20 hidden" wire:target="save" wire:loading.class.remove="hidden"
                                data-layer="4">
                                <div class="spinner-container">
                                    <div class="spinner-rotator">
                                        <div class="spinner-left">
                                            <div class="spinner-circle hidden" wire:target="save"
                                                wire:loading.class.remove="hidden"></div>
                                        </div>
                                        <div class="spinner-right">
                                            <div class="spinner-circle hidden" wire:target="save"
                                                wire:loading.class.remove="hidden"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-spinner-bg wire:loading.class.remove="hidden"></x-spinner-bg>
                    <x-spinner wire:loading.class.remove="hidden" class="hidden"></x-spinner>
                </div>
            </x-modal>
            <tr>
                <td>
                    2
                </td>
                <td>
                    Quarterly Customer Retention and Loyalty Engagement Index
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
                    <div class="flex text-xs items-center"><i class="fa fa-paperclip mr-1"></i><span>2</span></div>
                </td>
                <td>
                    <div class="uppercase text-xs text-green-500 items-center">{{ __('Diterbitkan') }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    3
                </td>
                <td>
                    Annual Employee Satisfaction and Workforce Morale Level
                </td>
                <td>
                    %
                </td>
                <td>
                    1000
                </td>
                <td>
                    1000
                </td>
                <td>

                </td>
                <td>
                    <div class="uppercase text-xs items-center">{{ __('Draf') }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    4
                </td>
                <td>
                    Monthly New Leads Acquisition and Conversion Effectiveness Ratio
                </td>
                <td>
                    %
                </td>
                <td>
                    1000
                </td>
                <td>
                    1000
                </td>
                <td>

                </td>
                <td>
                    <div class="uppercase text-xs items-center">{{ __('Draf') }}</div>
                </td>
            </tr>


        </table>
    </div>

</div>
