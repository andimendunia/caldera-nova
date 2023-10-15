<div>
    <x-text-input-icon wire:model.live="loc" icon="fa fa-fw fa-map-marker-alt" id="loc" list="qlocs"
    type="text" placeholder="{{ __('Lokasi') }}" />
    <datalist id="qlocs">
        @if(count($qlocs))
            @foreach($qlocs as $qloc)
                <option wire:key="{{ 'qloc'.$loop->index }}" value="{{ $qloc }}">
            @endforeach
        @endif
    </datalist>
</div>
