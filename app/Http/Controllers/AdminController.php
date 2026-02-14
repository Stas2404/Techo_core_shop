<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
{
    $ordersCount = \App\Models\Order::count();
    $productsCount = \App\Models\Product::count();
    $customersCount = \App\Models\Customer::count();
    $reviewsCount = \App\Models\Review::count();

    return view('admin.dashboard', compact('ordersCount', 'productsCount', 'customersCount', 'reviewsCount'));
}

    public function products()
    {
        $products = \App\Models\Product::orderBy('Item_id', 'desc')->paginate(10);
        
        return view('admin.products.index', compact('products'));
    }

    public function deleteProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();

        return back()->with('success', 'Товар успішно видалено!');
    }

    public function createProduct()
    {
        $brands = \App\Models\Brand::all();
        $categories = \App\Models\Category::all();

        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'Name' => 'required',
            'Price' => 'required|numeric',
            'Category_id' => 'required',
            'Brand_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['Image_path'] = 'images/' . $imageName;
        }

        \App\Models\Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Товар успішно додано!');
    }

    public function editProduct($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $brands = \App\Models\Brand::all();
        $categories = \App\Models\Category::all();

        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $request->validate([
            'Name' => 'required',
            'Price' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['Image_path'] = 'images/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Товар оновлено!');
    }

    public function customers()
    {
        $customers = \App\Models\Customer::orderBy('Customer_id', 'desc')->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function deleteCustomer($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Ви не можете видалити самі себе!');
        }

        $customer = \App\Models\Customer::findOrFail($id);

        try {
            $customer->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return back()->with('error', 'Неможливо видалити цього клієнта, оскільки у нього є оформлені замовлення. Спочатку видаліть історію його замовлень.');
            }
        }

        return back()->with('success', 'Клієнта видалено.');
    }

    public function toggleAdmin($id)
    {
        if ($id == auth()->id()) {
            return back()->with('error', 'Ви не можете забрати права у себе!');
        }

        $customer = \App\Models\Customer::findOrFail($id);
        
        $customer->is_admin = !$customer->is_admin;
        $customer->save();

        $status = $customer->is_admin ? 'Тепер це адміністратор!' : 'Права адміністратора забрано.';
        
        return back()->with('success', $status);
    }

    public function orders()
    {
        $orders = \App\Models\Order::with(['customer', 'status'])->orderBy('OrderDate', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = \App\Models\Order::with(['customer', 'items.product', 'status'])->findOrFail($id);
        $statuses = \App\Models\Status::all();

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->Status_id = $request->Status_id;
        $order->save();

        return back()->with('success', 'Статус замовлення успішно оновлено!');
    }

    public function deleteOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        $order->items()->delete();
        $product->specifications()->delete();

        $order->delete();

        return back()->with('success', 'Замовлення успішно видалено!');
    }

    public function productSpecifications($id)
    {
        $product = \App\Models\Product::with('specifications')->findOrFail($id);
        return view('admin.products.specifications', compact('product'));
    }

    public function addSpecification(Request $request, $id)
    {
        $request->validate([
            'Name' => 'required',
            'Value' => 'required',
        ]);

        \App\Models\Specification::create([
            'Item_id' => $id,
            'Name' => $request->Name,
            'Value' => $request->Value,
        ]);

        return back()->with('success', 'Характеристику успішно додано!');
    }

    public function deleteSpecification($spec_id)
    {
        $spec = \App\Models\Specification::findOrFail($spec_id);
        $spec->delete();

        return back()->with('success', 'Характеристику видалено.');
    }

    public function reviews()
    {
        $reviews = \App\Models\Review::with(['product', 'customer'])
                                     ->orderBy('Date', 'desc')
                                     ->paginate(10);
                                     
        return view('admin.reviews.index', compact('reviews'));
    }

    public function deleteReview($id)
    {
        \App\Models\Review::destroy($id);
        return back()->with('success', 'Відгук успішно видалено!');
    }
}