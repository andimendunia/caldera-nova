@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block border-x-0 border-neutral-300 dark:border-neutral-500 dark:bg-neutral-900 dark:text-neutral-300 focus:border-purple-500 dark:focus:border-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600 shadow-sm']) !!}>
