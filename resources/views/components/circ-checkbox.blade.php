@props(['disabled' => false, 'id', 'model'])

<input {{ $disabled ? 'disabled' : '' }} id="{{ 'circ-'.$id }}" value="{{ $id }}" type="checkbox" x-model={{ $model }} class="hidden">
<label for="{{ 'circ-'.$id }}" {{ $attributes->merge(['class' => 'custom-checkbox cursor-pointer h-full flex items-center text-sm text-left text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden transition ease-in-out duration-150']) }}>
    {{ $slot }}
</label>
