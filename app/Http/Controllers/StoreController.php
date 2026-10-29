<?php

namespace App\Http\Controllers;

use App\Models\{Product, Order, Setting};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class StoreController extends Controller
{
    public function home()
    {
        return view('store', ['products' => Product::where('active', true)->latest()->get(), 'featured' => Product::where('active', true)->where('featured', true)->take(4)->get(), 'wa' => Setting::val('wa_number'), 'shop' => Setting::val('shop_name', 'SFStore')]);
    }
    public function checkout(Request $request)
    {
        $v = $request->validate(['customer_name' => 'required|string|max:100', 'customer_phone' => 'required|regex:/^[0-9+ ]{8,20}$/', 'notes' => 'nullable|string|max:500', 'cart' => 'required|json']);
        $cart = json_decode($v['cart'], true);
        if (!is_array($cart) || count($cart) < 1 || count($cart) > 30) throw ValidationException::withMessages(['cart' => 'Keranjang tidak valid.']);
        $qty = [];
        foreach ($cart as $row) {
            if (!is_array($row) || !isset($row['id'], $row['qty']) || !filter_var($row['id'], FILTER_VALIDATE_INT) || !filter_var($row['qty'], FILTER_VALIDATE_INT) || $row['qty'] < 1 || $row['qty'] > 20) throw ValidationException::withMessages(['cart' => 'Isi keranjang tidak valid.']);
            $id = (int)$row['id'];
            $qty[$id] = ($qty[$id] ?? 0) + (int)$row['qty'];
            if ($qty[$id] > 20) throw ValidationException::withMessages(['cart' => 'Jumlah produk terlalu banyak.']);
        }
        $products = Product::whereIn('id', array_keys($qty))->where('active', true)->get()->keyBy('id');
        if ($products->count() !== count($qty)) throw ValidationException::withMessages(['cart' => 'Ada produk yang sudah tidak tersedia.']);
        $order = DB::transaction(function () use ($v, $products, $qty) {
            $total = 0;
            $cost = 0;
            $items = [];
            foreach ($qty as $id => $n) {
                $pr = $products[$id];
                $total += $pr->price * $n;
                $cost += $pr->cost * $n;
                $items[] = ['product_id' => $id, 'product_name' => $pr->name, 'quantity' => $n, 'unit_price' => $pr->price, 'unit_cost' => $pr->cost, 'subtotal' => $pr->price * $n];
            }
            $order = Order::create(['code' => 'SF-' . strtoupper(Str::random(8)), 'token' => (string)Str::uuid(), 'customer_name' => $v['customer_name'], 'customer_phone' => $v['customer_phone'], 'notes' => $v['notes'] ?? null, 'total' => $total, 'cost_total' => $cost, 'status' => 'new', 'payment_status' => 'unpaid']);
            $order->items()->createMany($items);
            return $order;
        });
        return redirect()->route('order.show', $order->token);
    }
    public function order(Order $order)
    {
        $order->load('items');
        $phone = preg_replace('/\D/', '', Setting::val('wa_number'));
        $message = "Halo Admin SFStore, saya ingin memesan:\nKode: {$order->code}\nNama: {$order->customer_name}\n";
        foreach ($order->items as $item) {
            $message .= "- {$item->product_name} x{$item->quantity}: Rp" . number_format($item->subtotal, 0, ',', '.') . "\n";
        }
        $message .= "Total: Rp" . number_format($order->total, 0, ',', '.') . "\nMohon informasi pembayaran. Terima kasih.";
        $waUrl = $phone ? 'https://wa.me/' . $phone . '?text=' . rawurlencode($message) : null;
        return view('order', ['order' => $order, 'waUrl' => $waUrl]);
    }
}
