<div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
    <a href="/products/{{ $product->id }}">
        <img src="@if (count($product->images) > 0) {{ $product->images[0]->path }}
        @else
        {{ asset('assets/img/placeholder.jpg') }} @endif                    
        "
            alt="{{$product->name}}" class="h-80 w-72 object-cover rounded-t-xl" />
        <div class="px-4 py-3 w-72">
            <p class="text-lg font-bold text-black truncate block capitalize">{{ $product->name }}</p>
            <div class="flex items-center">
                <p class="text-lg font-semibold text-black cursor-auto my-3">{{ $product->price }} руб.</p>
                @if ($product->discount)
                    <del>
                        <p class="text-sm text-gray-600 cursor-auto ml-2">{{ $product->discount }} руб.</p>
                    </del>
                @endif
            </div>
        </div>
    </a>
</div>