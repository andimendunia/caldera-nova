<div x-data x-init="$nextTick(() => { $refs.input.focus() })" wire:click.outside="apply" @if(!$isForm) class="p-6" @endif>
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
</div>
