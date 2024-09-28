<nav class="text-sm breadcrumbs">
    <ul class="flex space-x-2">
        @foreach($items as $item)
            <li>
                @if ($loop->last)
                    <span class="text-gray-500">{{ $item['label'] }}</span>
                @else
                    <a href="{{ $item['url'] }}" class="text-primary hover:underline">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ul>
</nav>

