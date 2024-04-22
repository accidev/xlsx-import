@extends('layouts.base')

@section('title')
    Каталог товаров
@endsection

@section('content')
    <div class="text-center p-10 pb-1">
        <h1 class="font-bold text-4xl mb-5">Каталог товаров</h1>

        <a href="{{route('import.products')}}" class="px-6 py-2 mx-auto block w-max rounded-full text-sm text-white bg-slate-950 hover:bg-slate-800 mb-10">
            Импортировать
        </a>
    </div>

    <section id="products"
        class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">

        @foreach ($products as $product)
            <x-product-card :product=$product></x-product-card>
        @endforeach
    </section>
@endsection
