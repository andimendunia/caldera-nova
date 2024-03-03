<x-layout-kpi title="{{ $title }}" header="{{ $header }}" prev="{!! $prev !!}" nav="{{ $nav }}" navs="{{ $navs }}">
    @switch($nav)
    @case('overview')
        @include('kpi.overview')  
        @break
    @case('submission')
        @include('kpi.submission')  
        @break
    @case('admin')
        @include('kpi.admin.index')
        @break
    @case('manage-items')
        @include('kpi.admin.manage-items')
        @break
    @case('manage-auth')
        @include('kpi.admin.manage-auth')
        @break
    @case('manage-areas')
        @include('kpi.admin.manage-areas')
        @break
    @default
    <div class="max-w-xl lg:max-w-2xl mx-auto px-4 py-16">        
        <h2 class="text-4xl font-extrabold dark:text-white">{{ __('Selamat datang di Laporan KPI') }}</h2>
        <p class="mt-4 mb-12 text-lg text-gray-500">{{ __('Laporan KPI adalah tempat dimana kamu melapor KPI bulanan.') }}</p>
        <p class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">{{ __('Mulai dengan mengklik menu navigasi di pojok kanan atas.') }}</p>

        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fa fa-table fa-fw me-2"></i>
                <span><span class="font-semibold text-gray-900 dark:text-white">{{ __('Ringkasan') }}</span>{{ ' ' . __('untuk melihat ringkasan KPI dalam satu tahun.') }}</span>
            </li>
            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fa fa-pen-to-square fa-fw me-2"></i>
                <span><span class="font-semibold text-gray-900 dark:text-white">{{ __('Penyerahan') }}</span>{{ ' ' . __('untuk melaporkan pencapaian KPI bulanan beserta data pendukung.') }}</span>
            </li>
            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                <i class="fa fa-ellipsis-h fa-fw me-2"></i>
                <span><span class="font-semibold text-gray-900 dark:text-white">{{ __('Administrasi') }}</span>{{ ' ' . __('untuk membuat item KPI dan lainnya.') }}</span>
            </li>
        </ul>
    </div>
    @endswitch
</x-layout-kpi>