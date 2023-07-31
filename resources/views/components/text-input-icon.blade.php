@props(['disabled' => false, 'id', 'icon'])

<div class="relative">
    <label for="{{ $id }}" class="absolute top-3 left-3 opacity-30 leading-none"><i class="{{ $icon }}"></i></label>
    <input id="{{ $id }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full pl-10 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>
</div>