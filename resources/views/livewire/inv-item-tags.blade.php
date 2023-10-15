<div>
    <form wire:submit="save()" class="p-6">
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Tag') }}
        </h2>
        @foreach($tags as $i => $tag)
        <div class="flex mt-3">
            <div class="w-full">
                <x-text-input-icon wire:model="tags.{{ $i }}" type="text" icon="fa fa-fw fa-tag" id="loc{{ $i }}"></x-text-input-icon>
            </div>
            <x-text-button wire:click="removeTag({{ $i }})" type="button" class="ms-3"><i class="fa fa-times"></i></x-text-button>
        </div>
        @endforeach
        <div wire:key="addTag">
            @if(count($tags) < 5)
                <x-text-button type="button" class="mt-3" wire:click="addTag"><i class="fa fa-plus mr-2"></i>{{ __('Tambah tag') }}</x-text-button>
            @endif
        </div>
        <div class="flex mt-6">
            <div class="ml-auto">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Tutup') }}
                </x-secondary-button>
                <x-primary-button type="submit" class="ml-3">
                    {{ __('Simpan') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</div>