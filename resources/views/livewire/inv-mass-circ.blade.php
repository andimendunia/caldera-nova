<div>
    @if (!$is_valid)
        <div class="flex">
            <div class="max-w-sm px-3 sm:px-0 mb-10 mx-auto">
                <div class="flex flex-col gap-6 text-sm mx-auto text-center text-neutral-600 dark:text-neutral-400">
                    <div class="text-center text-neutral-500 pb-8 text-4xl"><i class="fa fa-upload"></i></div>
                    <x-secondary-button x-on:click="$refs.file.click()" class="w-full mb-3">{{ __('Pilih file') }}</x-secondary-button>
                    <input x-ref="file" wire:model="file" type="file" accept=".csv" class="hidden" />
                    <div>
                        <div>{{ __('Format CSV, ukuran maksimum 1 MB') }}</div>
                        <div class="mt-2"><x-link href="#"><i class="fa fa-download mr-2"></i>{{ __('Unduh templat') }}</x-link></div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-between">
            <div class="flex items-center truncate p-1 gap-x-2">
                <i class="far fa-file"></i>
                <div class="truncate text-neutral-600 dark:text-neutral-400">{{ $file->getClientOriginalName() }}</div>
                <div>·</div>
                <x-text-button wire:click="reupload" type="button"
                    class="mr-2 uppercase">{{ __('Buang') }}</x-text-button>
            </div>
            <div>
                <x-secondary-button type="button"><i class="fa fa-pause mr-2"></i>{{ __('Jeda') }}</x-secondary-button>
                <x-primary-button wire:click="parse" type="button"><i class="fa fa-play mr-2"></i>{{ __('Mulai') }}</x-primary-button>
            </div>
        </div>      
        <div x-data="{ catFacts: [] }" x-init="() => {
            const fetchCatFact = async () => {
                try {
                    const response = await fetch('https://catfact.ninja/fact');
                    if (response.ok) {
                        const data = await response.json();
                        // Push the fetched cat fact into the catFacts array
                        catFacts.push(data.fact);
                    } else {
                        console.error('Failed to fetch data');
                    }
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            };
        
            const numberOfFacts = 5; // Change this value to get more or fewer facts
        
            // Fetch multiple cat facts (change the number in the loop)
            for (let i = 0; i < numberOfFacts; i++) {
                fetchCatFact();
            }
        }">
            <div x-show="catFacts.length">
                <h3>Random Cat Facts:</h3>
                <ul>
                    <template x-for="(fact, index) in catFacts" :key="index">
                        <li x-text="fact"></li>
                    </template>
                </ul>
            </div>
        </div>
        
        <div x-data="{ data: @entangle('data') }" class="overflow-x-scroll bg-white dark:bg-neutral-800 shadow sm:rounded-lg mt-6">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Kode') }}</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Deskripsi') }}</th>
                        <th>{{ __('UOM') }}</th>
                        <th>{{ __('Qty') }}</th>
                        <th>{{ __('Jenis') }}</th>
                        <th>{{ __('Keterangan') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="row in data">
                        <tr>
                            <td x-text="row.status"></td>
                            <td x-text="row.code"></td>
                            <td x-text="row.name"></td>
                            <td x-text="row.desc"></td>
                            <td x-text="row.uom"></td>
                            <td x-text="row.qty"></td>
                            <td x-text="row.qtype"></td>
                            <td x-text="row.remarks"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    @endif
</div>
