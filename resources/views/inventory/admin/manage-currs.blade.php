<div id="content" class="py-12 max-w-xl mx-auto px-3 text-neutral-800 dark:text-neutral-200">
    <div class="flex justify-between">
        <div>
            <div class="text-xl">
                {{ __('Mata uang utama') }}
            </div>
            <div class="text-sm mt-1">{{ 'USD' }}</div>
        </div>
        <x-secondary-button type="button" class="my-auto">{{ __('Ganti') }}</x-secondary-button>
    </div>
    <div x-data="{ more: false}">
        <div x-show="!more" class="text-sm mt-2 text-neutral-500 dark:text-neutral-400"><x-link href="#" x-on:click.prevent="more = !more">{{ __('Selengkapnya...') }}</x-link></div>
        <div x-show="more" x-cloak class="text-sm mt-2">
            <ul>
                <li>- Mata uang utama akan digunakan untuk perhitungan sirkulasi</li>
                <li>- Mata uang utama dijadikan sebagai acuan untuk nilai tukar mata uang sekunder</li>
            </ul>
        </div>
    </div>
    <hr class="my-5 border-neutral-300 dark:border-neutral-700">
    <div class="flex justify-between">
        <div>
            <div class="text-xl">
                {{ __('Mata uang sekunder') }}
            </div>
            <div class="text-sm mt-1">{{ '0' . ' ' . __('mata uang terdaftar') }}</div>
        </div>
        <x-secondary-button type="button" class="my-auto" x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'create-curr')">{{ __('Tambah') }}</x-secondary-button>
        <x-modal name="create-curr" focusable>
            <form method="post" action="#" class="p-6">
                @csrf
                <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                    {{ __('Tambah mata uang') }}
                </h2>
                <div class="mt-6">
                    <x-text-input id="inv-curr-name" class="mb-4" name="inv-curr-name" type="text"
                        placeholder="{{ __('Mata uang') }}" />
                    <x-text-input id="inv-curr-rate" class="mb-4" name="inv-curr-rate" type="number"
                        placeholder="{{ __('Nilai tukar') }}" />
                    <div class="text-sm">{{ __('Nilai tukar terhadap mata uang utama.') }}</div>
                    {{-- <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                        {{ __('Mata uang yang pertama ditambahkan akan dianggap sebagai mata uang utama. Maka dari itu, mata uang ini akan dijadikan acuan nilai tukar mata uang lain (bila ada) dan akan digunakan pada sirkulasi.') }}
                    </p>
                    <p class="mt-3 text-sm text-neutral-600 dark:text-neutral-400">
                        {{ __('Mata uang utama juga tidak dapat diubah di kemudian.') }}
                    </p> --}}
                    {{-- <x-checkbox id="inv-confirm">{{ __('Paham') }}</x-checkbox> --}}
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
        <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg overflow-hidden">
            <div class="py-12 fle items-center">
                <div class="w-80 mx-auto text-center">{{ __('Tidak ada mata uang') }}</div>
                    <div class="flex justify-center" x-data>
                        <x-secondary-button type="button" x-on:click="notyf.success('Sirkulasi berhasil dibuat');">Success</x-secondary-button>
                        <x-secondary-button type="button" x-on:click="notyf.error('Tidak memiliki wewenang');">Fail</x-secondary-button>
                    </div>
            </div>
        </div>
    </div>
</div>
