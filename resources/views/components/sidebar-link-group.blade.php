@props(['label'])

<li x-data="{ open: true }" class="mt-2">
    <a href="#" x-on:click.prevent="open = !open"
        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
        <span class="flex-1 text-gray-800 text-sm ml-3 text-left whitespace-nowrap">{{ $label }}</span>
        <svg x-show="!open" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                clip-rule="evenodd"></path>
        </svg>
    </a>
    <div x-show="open" x-transition>
        <ul class="py-2 space-y-2">
            {{ $slot }}
        </ul>
    </div>
</li>
