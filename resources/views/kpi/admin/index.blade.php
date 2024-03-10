<div class="py-12">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8 text-neutral-600 dark:text-neutral-400">
        <div class="grid grid-cols-1 gap-1 my-8">
            <x-card-link href="{{ route('kpi', ['nav' => 'manage-items'])}}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-list"></i></div>
                        </div>
                    </div>
                    <div class="grow text-left truncate py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola KPI')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola butir KPI tahunan')}}
                        </div>
                    </div>
                </div>
            </x-card-button>
            <x-card-link href="{{ route('kpi', ['nav' => 'manage-auth']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-user-lock"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola wewenang')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola wewenang pengguna laporan KPI')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
            <x-card-link href="{{ route('kpi', ['nav' => 'manage-areas']) }}">
                <div class="flex">
                    <div>
                        <div class="flex w-16 h-full text-neutral-600 dark:text-neutral-400">
                            <div class="m-auto"><i class="fa fa-building"></i></div>
                        </div>
                    </div>
                    <div class="grow truncate py-4">
                        <div class="truncate text-lg font-medium text-neutral-900 dark:text-neutral-100">
                            {{__('Kelola area')}}
                        </div>                        
                        <div class="truncate text-sm text-neutral-600 dark:text-neutral-400">
                            {{__('Kelola area laporan KPI')}}
                        </div>
                    </div>
                </div>
            </x-card-link>
        </div>
        
    </div>
</div>
    
