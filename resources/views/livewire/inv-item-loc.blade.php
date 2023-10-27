<div @if(!$isForm) class="p-6" @endif>
    @if(!$isForm)
    <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100 mb-3">
        {{ __('Edit lokasi') }}
    </h2>
    @endif
    <x-text-input-icon x-ref="input" wire:model.live="loc" icon="fa fa-fw fa-map-marker-alt" id="loc" list="qlocs"
    type="text" placeholder="{{ __('Lokasi') }}" />
    <datalist id="qlocs">
        @if(count($qlocs))
            @foreach($qlocs as $qloc)
                <option wire:key="{{ 'qloc'.$loop->index }}" value="{{ $qloc }}">
            @endforeach
        @endif
    </datalist>
    @error('loc')
        <x-input-error messages="{{ $message }}" class="mt-2" />
    @enderror
    @if(!$isForm)
    <div class="flex">
        <x-primary-button type="button" wire:click="apply" class="ml-auto mt-4">{{__('Perbarui')}}</x-primary-button>
    </div>
    @endif
    <div wire:loading.class.remove="hidden" wire:target="apply"
    class="w-full h-full absolute top-0 left-0 bg-white/70 dark:bg-neutral-800/70 hidden"></div>
    <x-spinner wire:loading.class.remove="hidden" wire:target="apply" class="hidden"></x-spinner>
</div>
