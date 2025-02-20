<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('product')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'created_at' => 'required|date',
            'status' => 'required|boolean',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        $product = Product::find($request->product_id);

        $totalPrice = $product->price * $request->quantity * 100;  // Считаем цену в копейках

        Order::create([
            'customer_name' => $request->customer_name,
            'created_at' => $request->created_at,
            'status' => $request->status,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('orders.index')->with('success', 'Заказ успешно создан.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'created_at' => 'required|date',
            'status' => 'required|boolean',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'comment' => 'nullable|string',
        ]);

        $product = Product::find($request->product_id);

        $totalPrice = $product->price * $request->quantity * 100;  // Считаем цену в копейках

        $order->update([
            'customer_name' => $request->customer_name,
            'created_at' => $request->created_at,
            'status' => $request->status,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'comment' => $request->comment,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('orders.index')->with('success', 'Заказ обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удален.');
    }

    /**
     * Изменение статуса заказа на "выполнен".
     */
    public function markAsCompleted(Order $order)
    {
        $order->status = true;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Статус заказа изменен на "Выполнен".');
    }
}
