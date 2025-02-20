@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p><strong>Категория:</strong> {{ $product->category->name }}</p>
        <p><strong>Описание:</strong> {{ $product->description }}</p>
        <p><strong>Цена:</strong> {{ number_format($product->price / 100, 2) }} ₽</p>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Назад</a>
    </div>
@endsection
