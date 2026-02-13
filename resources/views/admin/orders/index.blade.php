@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
    <h1>Керування замовленнями</h1>

    <table style="width: 100%; border-collapse: collapse; background: white; margin-top: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #333; color: white; text-align: left;">
                <th style="padding: 15px;">№</th>
                <th style="padding: 15px;">Дата</th>
                <th style="padding: 15px;">Клієнт</th>
                <th style="padding: 15px;">Сума</th>
                <th style="padding: 15px;">Статус</th>
                <th style="padding: 15px;">Дія</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 15px; font-weight: bold;">#{{ $order->Order_id }}</td>
                <td style="padding: 15px;">{{ \Carbon\Carbon::parse($order->OrderDate)->format('d.m.Y H:i') }}</td>
                <td style="padding: 15px;">
                    @if($order->customer)
                        {{ $order->customer->FullName }}
                    @else
                        <span style="color: #888;">Гість</span>
                    @endif
                </td>
                <td style="padding: 15px; font-weight: bold;">{{ $order->Total_sum }} грн</td>
                <td style="padding: 15px;">
                    <span style="background: #eee; padding: 5px 10px; border-radius: 15px; font-size: 0.9em; font-weight: bold;">
                        {{ $order->status ? $order->status->Name : 'Невідомо' }}
                    </span>
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('admin.order.show', $order->Order_id) }}" class="btn btn-red" style="padding: 8px 15px; text-decoration: none;">Деталі</a>

                    <a href="{{ route('admin.order.delete', $order->Order_id) }}" 
                    onclick="return confirm('Ви точно хочете видалити це замовлення?')" 
                    style="color: red; font-weight: bold; text-decoration: none; margin-left: 15px; font-size: 1.2em;">
                    ✕
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection