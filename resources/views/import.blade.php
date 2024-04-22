@extends('layouts.base')

@section('title')
    Импорт товаров
@endsection

@section('content')
    <form method="POST" action="{{ route('import.products') }}" enctype="multipart/form-data"
        class="mx-auto h-screen w-max flex justify-center flex-col">
        @csrf
        <h1 class="text-4xl mb-8 font-bold text-slate-950">Импортируйте товары</h1>
        <input type="file" required
            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
            name="table">
        <button class="py-3 mt-2 text-white bg-slate-950 hover:bg-slate-800 rounded-md">Сохранить</button>
        @if(session()->has('success'))
            <span class="text-sm font-semibold ms-auto mt-2 text-green-500">{{ session('success') }}</span>
        @endif
    </form>
@endsection
