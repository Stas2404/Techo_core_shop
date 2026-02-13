@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
    <h1 style="border-bottom: 2px solid #e74c3c; padding-bottom: 10px;">Адмін-панель</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 30px;">
        <div style="background: #f4f4f4; padding: 20px; border-radius: 8px; text-align: center;">
            <h3>Замовлення</h3>
            <p style="font-size: 2em; font-weight: bold; margin: 10px 0;">{{ \App\Models\Order::count() }}</p>
            <a href="{{ route('admin.orders') }}" style="color: #e74c3c;">Керувати</a>
        </div>

        <div style="background: #f4f4f4; padding: 20px; border-radius: 8px; text-align: center;">
            <h3>Товари</h3>
            <p style="font-size: 2em; font-weight: bold; margin: 10px 0;">{{ \App\Models\Product::count() }}</p>
            <a href="{{ route('admin.products') }}" style="color: #e74c3c;">Керувати</a>
        </div>

        <div style="background: #f4f4f4; padding: 20px; border-radius: 8px; text-align: center;">
            <h3>Клієнти</h3>
            <p style="font-size: 2em; font-weight: bold; margin: 10px 0;">{{ \App\Models\Customer::count() }}</p>
            <a href="{{ route('admin.customers') }}" style="color: #e74c3c;">Переглянути</a>
        </div>
    </div>
</div>
@endsection