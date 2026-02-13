<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect('/')->with('error', 'Ваш кошик порожній');
        }

        return view('checkout', ['cart' => $cart]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'FullName' => 'required',
            'Phone' => ['required', 'regex:/^\+38 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'Address' => 'required',
            'Email' => 'required_if:register_me,on',
            'Password' => 'required_if:register_me,on|min:6',
        ]);

        DB::beginTransaction();

        try {
            $customerId = null;

            if (Auth::check()) {
                $customerId = Auth::id();
            } 

            elseif ($request->has('register_me')) {
                if (Customer::where('Email', $request->Email)->exists()) {
                    return back()->with('error', 'Цей Email вже зайнятий. Увійдіть в акаунт.');
                }

                $newCustomer = Customer::create([
                    'FullName' => $request->FullName,
                    'Email' => $request->Email,
                    'Phone' => $request->Phone,
                    'Address' => $request->Address,
                    'Password' => Hash::make($request->Password),
                    'RegDate' => now(),
                    'is_admin' => 0
                ]);

                $customerId = $newCustomer->Customer_id;
                Auth::login($newCustomer);
            }

            $totalSum = 0;
            $cart = session()->get('cart');
            foreach($cart as $id => $details) {
                $totalSum += $details['price'] * $details['quantity'];
            }

            $order = Order::create([
                'Customer_id' => $customerId,
                'Status_id' => 1,
                'Total_sum' => $totalSum,
                'OrderDate' => now(),
                'DeliveryAddr' => $request->Address
            ]);

            foreach($cart as $id => $details) {
                OrderItem::create([
                    'Order_id' => $order->Order_id,
                    'Item_id' => $id,
                    'Quantity' => $details['quantity'],
                    'Price' => $details['price']
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect('/')->with('success', 'Замовлення №' . $order->Order_id . ' успішно створено!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Помилка: ' . $e->getMessage());
        }
    }
}