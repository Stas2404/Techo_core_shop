@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
    
    <h1 style="margin-bottom: 30px; border-bottom: 2px solid #e74c3c; padding-bottom: 10px;">Адмін-панель</h1>

    <div style="display: flex; justify-content: space-between; flex-wrap: wrap; text-align: center; gap: 20px;">
        
        <div style="flex: 1; min-width: 200px; padding: 20px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 8px;">
            <h3 style="color: #333;">Замовлення</h3>
            <h1 style="font-size: 3em; margin: 10px 0; color: #2c3e50;">{{ $ordersCount }}</h1>
            <a href="{{ route('admin.orders') }}" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Керувати →</a>
        </div>

        <div style="flex: 1; min-width: 200px; padding: 20px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 8px;">
            <h3 style="color: #333;">Товари</h3>
            <h1 style="font-size: 3em; margin: 10px 0; color: #2c3e50;">{{ $productsCount }}</h1>
            <a href="{{ route('admin.products') }}" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Керувати →</a>
        </div>

        <div style="flex: 1; min-width: 200px; padding: 20px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 8px;">
            <h3 style="color: #333;">Клієнти</h3>
            <h1 style="font-size: 3em; margin: 10px 0; color: #2c3e50;">{{ $customersCount }}</h1>
            <a href="{{ route('admin.customers') }}" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Переглянути →</a>
        </div>

        <div style="flex: 1; min-width: 200px; padding: 20px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-radius: 8px;">
            <h3 style="color: #333;">Відгуки</h3>
            <h1 style="font-size: 3em; margin: 10px 0; color: #2c3e50;">{{ $reviewsCount }}</h1>
            <a href="{{ route('admin.reviews.index') }}" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Модерувати →</a>
        </div>

    </div>
</div>
@endsection