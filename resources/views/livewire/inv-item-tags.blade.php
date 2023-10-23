<div wire:click.outside="apply">
    <div class="p-6">
        @if($isForm)
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Tag') }}
        </h2>
        @else
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Edit tag') }}
        </h2>
        @endif
        @foreach($tags as $i => $tag)
        <div class="flex mt-3">
            <div class="w-full">
                <x-text-input-icon wire:model.live="tags.{{ $i }}" type="text" icon="fa fa-fw fa-tag" id="tag{{ $i }}" list="qtags{{ $i }}"></x-text-input-icon>
            </div>
            <x-text-button wire:click="removeTag({{ $i }})" type="button" class="ms-3"><i class="fa fa-times"></i></x-text-button>
        </div>
        <datalist id="qtags{{ $i }}">
            @if(isset($qtags[$i]))
                @foreach($qtags[$i] as $qtag)
                    <option wire:key="{{ 'qtag'.$loop->index }}" value="{{ $qtag }}">
                @endforeach
            @endif
        </datalist>
        @error('tags.'.$i)
            <x-input-error messages="{{ $message }}" class="mt-2" />
        @enderror
        @endforeach
        <div wire:key="addTag">
            @if(count($tags) < 5)
                <x-text-button type="button" class="mt-3" wire:click="addTag"><i class="fa fa-plus mr-2"></i>{{ __('Tambah tag') }}</x-text-button>
            @endif
        </div>
    </div>  
</div>