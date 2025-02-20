@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>

        <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Create New Order</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $order->status_text }}</td>
                        <td>{{ $order->total_price }} RUB</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-info">View</a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @if ($order->status == 0)
                                <form action="{{ route('orders.markAsCompleted', $order) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Mark as Completed</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    </div>
@endsection
