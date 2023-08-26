@props(['disabled' => false, 'id'])

<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" type="checkbox" class="w-4 h-4 text-purple-600 bg-neutral-100 border-neutral-300 rounded focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-neutral-800 dark:bg-neutral-700 dark:border-neutral-600">
    <label for="{{ $id }}" class="p-2 text-sm">{{ $slot }}</label>
</div>