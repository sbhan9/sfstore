<?php

namespace App\Http\Controllers;

use App\Models\{Product, Order, Expense, Setting};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Storage};

class AdminController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(Request $r)
    {
        $v = $r->validate(['email' => 'required|email', 'password' => 'required|string']);
        if (Auth::attempt($v)) {
            $r->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }
        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }
    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('home');
    }
    public function dashboard()
    {
        $paid = Order::where('payment_status', 'paid');
        $revenue = (clone $paid)->sum('total');
        $cost = (clone $paid)->sum('cost_total');
        $expense = Expense::sum('amount');
        return view('admin.dashboard', compact('revenue', 'cost', 'expense') + ['productCount' => Product::count(), 'orderCount' => Order::count(), 'recent' => Order::orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")->latest('created_at')->latest('id')->take(8)->get()]);
    }
    public function products()
    {
        return view('admin.products', ['products' => Product::latest()->paginate(15)]);
    }
    public function productForm(?Product $product = null)
    {
        return view('admin.product-form', ['product' => $product && $product->exists ? $product : null]);
    }
    public function saveProduct(Request $r, ?Product $product = null)
    {
        $v = $r->validate(['name' => 'required|string|max:150', 'category' => 'required|string|max:80', 'description' => 'nullable|string|max:2000', 'price' => 'required|integer|min:0', 'compare_price' => 'nullable|integer|min:0', 'cost' => 'required|integer|min:0', 'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048']);
        $v['active'] = $r->boolean('active');
        $v['featured'] = $r->boolean('featured');
        if ($r->hasFile('image')) {
            $v['image'] = $r->file('image')->store('products', 'public');
            if ($product?->image) Storage::disk('public')->delete($product->image);
        }
        if ($product?->exists) $product->update($v);
        else Product::create($v);
        return redirect()->route('admin.products')->with('success', 'Produk berhasil disimpan.');
    }
    public function deleteProduct(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();
        return back()->with('success', 'Produk dihapus.');
    }
    public function orders()
    {
        return view('admin.orders', ['orders' => Order::with('items')->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")->latest('created_at')->latest('id')->paginate(20)]);
    }
    public function updateOrder(Request $r, Order $order)
    {
        $v = $r->validate(['payment_status' => 'required|in:unpaid,paid,refunded', 'status' => 'required|in:new,processing,completed,cancelled']);
        $order->update($v);
        return back()->with('success', 'Status pesanan diperbarui.');
    }
    public function finance()
    {
        $orders = Order::where('payment_status', 'paid')->latest()->get();
        $revenue = $orders->sum('total');
        $cost = $orders->sum('cost_total');
        $expenses = Expense::latest('spent_at')->paginate(15);
        $expenseTotal = Expense::sum('amount');
        return view('admin.finance', compact('orders', 'revenue', 'cost', 'expenses', 'expenseTotal'));
    }
    public function expense(Request $r)
    {
        $v = $r->validate(['description' => 'required|string|max:200', 'amount' => 'required|integer|min:1', 'spent_at' => 'required|date']);
        Expense::create($v);
        return back()->with('success', 'Pengeluaran dicatat.');
    }
    public function deleteExpense(Expense $expense)
    {
        $expense->delete();
        return back()->with('success', 'Pengeluaran dihapus.');
    }
    public function settings()
    {
        return view('admin.settings', ['shop' => Setting::val('shop_name', 'SStore'), 'wa' => Setting::val('wa_number')]);
    }
    public function updateSettings(Request $r)
    {
        $v = $r->validate(['shop_name' => 'required|string|max:80', 'wa_number' => 'required|regex:/^[0-9]{10,16}$/']);
        foreach ($v as $k => $value) Setting::updateOrCreate(['key' => $k], ['value' => $value]);
        return back()->with('success', 'Pengaturan diperbarui.');
    }
}
