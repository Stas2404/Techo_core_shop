<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Кошик</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 1000px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .img-cart { width: 50px; height: 50px; object-fit: cover; }
        .total-section { text-align: right; margin-top: 20px; font-size: 1.5em; font-weight: bold;}
        .btn { text-decoration: none; padding: 10px 15px; border-radius: 5px; color: white;}
        .btn-continue { background-color: #555; }
        .btn-checkout { background-color: green; }
        .btn-danger { background-color: red; font-size: 0.8em; }
    </style>
</head>
<body>

    <h1>Ваш Кошик</h1>

    @if(session('cart'))
        <table>
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Назва</th>
                    <th>Ціна</th>
                    <th>Кількість</th>
                    <th>Сума</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr>
                        <td>
                            <img src="{{ asset($details['image']) }}" class="img-cart" alt="...">
                        </td>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['price'] }} грн</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ $details['price'] * $details['quantity'] }} грн</td>
                        <td>
                            <a href="{{ route('remove.from.cart', $id) }}" class="btn btn-danger" style="background: red; color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">
                                ✕
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            Разом до сплати: {{ $total }} грн
        </div>

        <div style="margin-top: 20px; text-align: right;">
            <a href="/" class="btn btn-continue">← Продовжити покупки</a>
            <a href="{{ route('checkout.index') }}" class="btn btn-checkout">Оформити замовлення</a>
        </div>

    @else
        <p>Ваш кошик порожній</p>
        <a href="/" class="btn btn-continue">Повернутися в магазин</a>
    @endif
</body>
</html>