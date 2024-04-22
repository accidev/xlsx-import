@extends('layouts.base')


@section('title')
    {{ $title }}
@endsection

@section('head')
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta name="description" content="{{ $description }}">
@endsection

@section('content')
    <div class="pt-8 pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <a href="/"
                class="px-6 py-2 block w-max rounded-full text-lg text-white bg-slate-950 hover:bg-slate-800 mb-10">
                В каталог
            </a>
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4 flex flex-col">
                    <div class="h-[460px] rounded-lg overflow-hidden mb-2">
                        <img class="w-full h-full object-cover" id="main-image"
                            src="@if (count($product->images) > 0) {{ $product->images[0]->path }}
                    @else
                    {{ asset('assets/img/placeholder.jpg') }} @endif"
                            alt="{{ $product->name }}">
                    </div>
                    @if (count($product->images) > 0)
                        <div class="flex gap-2 h-[80px] mb-4">
                            @foreach ($product->images as $image)
                                <img src="{{ $image->path }}"
                                    class="@if ($loop->first) ring-2 @endif hover:ring-2 rounded-md ring-black product-image">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">{{ $product->name }}</h2>
                    <div class="flex flex-col gap-1">
                        @foreach ($product->fields as $field)
                            @if (!str_contains($field->key, 'Ссылк') && !str_contains($field->key, 'seo'))
                                <div class="text-md flex gap-2">
                                    <div class="font-semibold">
                                        {{ $field->key }}:
                                    </div>
                                    <div>
                                        {{ $field->value }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div>
                <span class="font-bold text-lg text-slate-950">Описание товара:</span>
                <p class="text-slate-800 text-md mt-2">
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </div>

    <script>
        let images = document.querySelectorAll('.product-image');
        for (const image of images) {
            image.onclick = () => {
                for (const img of images) {
                    img.classList.remove('active');
                    img.classList.remove('ring-2');
                }
                image.classList.add('active');
                image.classList.add('ring-2');
                document.getElementById('main-image').src = image.src;
            }
        }
    </script>
@endsection
