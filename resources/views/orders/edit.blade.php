@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Order</h1>

        <form action="{{ route('orders.update', $order) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="customer_name">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control"
                    value="{{ $order->customer_name }}" required>
            </div>

            <div class="form-group">
                <label for="created_at">Order Date</label>
                <input type="datetime-local" name="created_at" id="created_at" class="form-control"
                    value="{{ $order->created_at->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="form-group">
                <label for="status">Order Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>New</option>
                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Completed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="product_id">Product</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }} - {{ $product->price }} RUB
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $order->quantity }}"
                    required min="1">
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" class="form-control">{{ $order->comment }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>
@endsection
