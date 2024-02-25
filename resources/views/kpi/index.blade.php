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
    @case('manage-auth')
        @include('kpi.admin.manage-auth')
        @break
    @case('manage-areas')
        @include('kpi.admin.manage-areas')
        @break
    @default
    <div class="max-w-xl lg:max-w-6xl mx-auto px-4">
        <div class="text-center">Selamat datang</div>
    </div>
    @endswitch
</x-layout-kpi>