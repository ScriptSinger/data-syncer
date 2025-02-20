@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>

        <ul>
            <li><strong>Order ID:</strong> {{ $order->id }}</li>
            <li><strong>Customer Name:</strong> {{ $order->customer_name }}</li>
            <li><strong>Created At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</li>
            <li><strong>Status:</strong> {{ $order->status_text }}</li>
            <li><strong>Total Price:</strong> {{ $order->total_price }} RUB</li>
            <li><strong>Comment:</strong> {{ $order->comment }}</li>
        </ul>

        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>
@endsection
