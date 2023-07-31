<a {{ $attributes->merge(['class' => 'flex items-center text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>