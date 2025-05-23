@props(['href'])

@php
    $tab = collect(explode('/', $href))->last();
    $requestTab = data_get(request()->route()->parameters(), 'tab', 'opportunities');
@endphp

<a {{ $attributes->class([
    'inline-flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200',
    'border-b-2 border-transparent text-gray-500 hover:text-gray-100 hover:border-primary',
    'border-transparent' => $tab !== $requestTab,
    'text-white bg-primary' => $tab === $requestTab
]) }} href="{{ $href }}" wire:navigate>
    {{ $slot }}
</a>
