<x-layout-insight title="{{ $title }}" header="{{ $header }}" prev="{!! $prev !!}"
    nav="{{ $nav }}" navs="{{ $navs }}">
    @switch($nav)
        @case('acm-metrics')
            @include('insight.acm.metrics')
        @break
        @case('acm-devices')
            @include('insight.acm.devices')
        @break

        @default
            <div id="content" class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8 text-neutral-800 dark:text-neutral-200">
                <div class="bg-white dark:bg-neutral-800 shadow sm:rounded-lg mb-8">
                    <div class="p-6">
                        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-1">
                            {{ __('Assembly conveyor monitoring') }}
                        </h2>
                        <p class="text-sm">{{ __('Sistem monitoring konveyor untuk mencatat kecepatan konveyor yang terletak di proses assembly.') }}</p>
                    </div>
                    <x-link href="{{ route('insight', ['nav' => 'acm-metrics']) }}" class="block px-6 py-4"><i class="fa fa-fw fa-arrow-right mr-3"></i>{{ __('Lihat metrik') }}</x-link>
                    <x-link href="{{ route('insight') }}" class="block px-6 py-4"><i class="fa fa-fw fa-arrow-right mr-3"></i>{{ __('Pendaftaran perangkat') }}</x-link>
                </div>
            </div>
    @endswitch
</x-layout-insight>
