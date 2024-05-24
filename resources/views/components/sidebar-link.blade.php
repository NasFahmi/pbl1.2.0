@props(['active', 'route', 'icon', 'label'])

<li class="relative px-6 py-3 group">
    @if ($active)
        <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
    @endif
    <a class="inline-flex items-center w-full text-sm font-semibold {{ $active ? 'text-gray-800' : 'text-gray-500' }} transition-colors duration-150 group-hover:text-gray-800" href="{{ route($route) }}">
        <img class="w-5 h-5 {{ $active ? 'opacity-100' : 'opacity-60' }} group-hover:opacity-100" src="{{ asset($icon) }}" alt="" srcset="">
        <span class="ml-4">{{ $label }}</span>
    </a>
</li>