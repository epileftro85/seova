@props(['items' => []])
@if(!empty($items) && count($items) > 1)
<nav class="bg-gray-100 text-sm" aria-label="Breadcrumb">
    <ol class="max-w-7xl mx-auto px-6 py-3 flex flex-wrap gap-1 items-center">
        @foreach($items as $i => $item)
            <li class="flex items-center">
                @if($i < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="text-gray-600 hover:text-seova-orange underline underline-offset-2 focus:outline-none focus:ring-2 focus:ring-seova-orange focus:ring-offset-2" @if(isset($item['ariaLabel'])) aria-label="{{ $item['ariaLabel'] }}" @endif>{{ $item['label'] }}</a>
                    <span class="mx-2 text-gray-400" aria-hidden="true">/</span>
                @else
                    <span class="text-gray-900 font-semibold" aria-current="page">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
@endif
