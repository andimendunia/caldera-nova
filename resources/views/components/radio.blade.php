@props(['disabled' => false, 'id', 'name'])

<div class="flex items-center">
    <input {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" name="{{ $name }}" type="radio" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
    <label for="{{ $id }}" class="p-2 text-sm">{{ $slot }}</label>
</div>