<form wire:submit.prevent="go">
    <div class="max-w-sm mx-auto py-16 text-neutral-800 dark:text-neutral-200">
        <x-text-input-icon icon="fa fa-fw fa-search" id="inv-q" wire:model.live="q" type="search" list="qwords" placeholder="{{ __('Aku ingin mencari...') }}" autofocus autocomplete="q" />
    </div>
    <datalist id="qwords">
        @if(count($qwords))
            @foreach($qwords as $qword)
                <option value="{{ $qword }}">
            @endforeach
        @endif
    </datalist>
</form>