@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 1000px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Замовлення #{{ $order->Order_id }}</h1>
        <a href="{{ route('admin.orders') }}" style="color: #666; text-decoration: none;">&larr; Назад до списку</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">✅ {{ session('success') }}</div>
    @endif

    <div style="display: flex; gap: 30px; align-items: flex-start;">
        
        <div style="flex: 2; background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
            <h3>Склад замовлення</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                    <tr style="border-bottom: 2px solid #ddd; text-align: left;">
                        <th style="padding-bottom: 10px;">Товар</th>
                        <th style="padding-bottom: 10px;">Ціна</th>
                        <th style="padding-bottom: 10px;">К-ть</th>
                        <th style="padding-bottom: 10px;">Сума</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px 0;">
                            {{ $item->product ? $item->product->Name : 'Видалений товар (ID: '.$item->Item_id.')' }}
                        </td>
                        <td style="padding: 15px 0;">{{ $item->Price }} грн</td>
                        <td style="padding: 15px 0;">x{{ $item->Quantity }}</td>
                        <td style="padding: 15px 0; font-weight: bold;">{{ $item->Price * $item->Quantity }} грн</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="text-align: right; margin-top: 20px; font-size: 1.5em; font-weight: bold; color: #e74c3c;">
                Разом: {{ $order->Total_sum }} грн
            </div>
        </div>

        <div style="flex: 1; display: flex; flex-direction: column; gap: 20px;">
            
            <div style="background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
                <h3 style="margin-top: 0;">Статус замовлення</h3>
                <form action="{{ route('admin.order.updateStatus', $order->Order_id) }}" method="POST">
                    @csrf
                    <select name="Status_id" style="width: 100%; padding: 10px; margin-bottom: 15px; font-size: 16px;">
                        @foreach($statuses as $st)
                            <option value="{{ $st->Status_id }}" {{ $order->Status_id == $st->Status_id ? 'selected' : '' }}>
                                {{ $st->Name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-red" style="width: 100%; padding: 10px;">Зберегти статус</button>
                </form>
            </div>

            <div style="background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
                <h3 style="margin-top: 0;">Дані клієнта</h3>
                <p><strong>Дата:</strong> {{ \Carbon\Carbon::parse($order->OrderDate)->format('d.m.Y H:i') }}</p>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">
                
                @if($order->customer)
                    <p><strong>Ім'я:</strong> {{ $order->customer->FullName }}</p>
                    <p><strong>Телефон:</strong> {{ $order->customer->Phone }}</p>
                    <p><strong>Email:</strong> {{ $order->customer->Email }}</p>
                @else
                    <p style="color: #e74c3c; font-weight: bold;">Гість (без акаунта)</p>
                @endif
                
                <hr style="border: 0; border-top: 1px solid #eee; margin: 15px 0;">
                <p><strong>Адреса доставки:</strong><br> {{ $order->DeliveryAddr }}</p>
            </div>

        </div>

    </div>
</div>
@endsection