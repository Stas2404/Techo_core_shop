<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->Name }}</title>
    <style>
        body { font-family: sans-serif; padding: 40px; max-width: 1000px; margin: 0 auto; background-color: #f9f9f9; }
        .product-container { display: flex; gap: 40px; background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #ddd; }
        .product-img { width: 400px; height: 400px; object-fit: contain; border: 1px solid #eee; padding: 10px; border-radius: 8px; }
        .product-info { flex: 1; }
        .price { color: #28a745; font-size: 2.5em; font-weight: bold; margin: 20px 0; }
        .btn { background: #e74c3c; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 1.1em; display: inline-block; }
        .btn:hover { background: #c0392b; }
    </style>
</head>
<body>
    <div style="margin-bottom: 20px;">
        <a href="/" style="text-decoration: none; color: #555;">&larr; Назад до каталогу</a>
    </div>
    
    <div class="product-container">
        <img src="/{{ $product->Image_path }}" class="product-img" alt="{{ $product->Name }}">
        
        <div class="product-info">
            <h1 style="margin-top: 0;">{{ $product->Name }}</h1>
            <p style="color: #888;">Артикул: {{ $product->Item_id }}</p>
            
            <div class="price">{{ $product->Price }} грн</div>
            
            <p><strong>Опис:</strong></p>
            <p style="line-height: 1.6;">{{ $product->Description }}</p>
            
            <p style="color: {{ $product->Stock_quantity > 0 ? 'green' : 'red' }};">
                В наявності: {{ $product->Stock_quantity }} шт.
            </p>
            
            <br>
            <a href="#" class="btn">🛒 Купити</a>
        </div>
    </div> @if($product->specifications->count() > 0)
        <div style="margin-top: 40px; background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #ddd;">
            <h3 style="border-bottom: 2px solid #e74c3c; padding-bottom: 10px; margin-top: 0;">Технічні характеристики</h3>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <tbody>
                    @foreach($product->specifications as $spec)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px 0; color: #666; width: 30%;">
                            {{ $spec->Name }}
                        </td>
                        <td style="padding: 15px 0; font-weight: bold; color: #333;">
                            {{ $spec->Value }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div style="margin-top: 40px; background: #fff; padding: 30px; border-radius: 8px; border: 1px solid #ddd;">
        <h3 style="border-bottom: 2px solid #e74c3c; padding-bottom: 10px; margin-top: 0;">Відгуки покупців</h3>

        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @auth
            <form action="{{ route('review.store', $product->Item_id) }}" method="POST" style="margin-bottom: 40px; background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px dashed #ccc;">
                @csrf
                <h4 style="margin-top: 0;">Залишити свій відгук</h4>
                
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold;">Ваша оцінка:</label>
                    <select name="Rating" style="padding: 8px; margin-left: 10px; border-radius: 4px;">
                        <option value="5">⭐⭐⭐⭐⭐ (5) Відмінно</option>
                        <option value="4">⭐⭐⭐⭐ (4) Добре</option>
                        <option value="3">⭐⭐⭐ (3) Нормально</option>
                        <option value="2">⭐⭐ (2) Погано</option>
                        <option value="1">⭐ (1) Жахливо</option>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <textarea name="Comment" rows="4" style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc;" placeholder="Напишіть ваші враження про товар..." required></textarea>
                </div>

                <button type="submit" class="btn" style="background: #28a745; width: 100%; text-align: center;">Відправити відгук</button>
            </form>
        @else
            <div style="margin-bottom: 40px; padding: 15px; background: #fff3cd; color: #856404; border-radius: 5px; border: 1px solid #ffeeba;">
                Щоб залишити відгук, будь ласка, <a href="{{ route('login') }}" style="color: #e74c3c; font-weight: bold;">увійдіть в акаунт</a> або зареєструйтесь.
            </div>
        @endauth

        @if($product->reviews->count() > 0)
            @foreach($product->reviews as $review)
                <div style="border-bottom: 1px solid #eee; padding: 20px 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <strong style="font-size: 1.1em;">
                            👤 {{ $review->customer ? $review->customer->FullName : 'Невідомий покупець' }}
                        </strong>
                        <span style="color: #888; font-size: 0.9em;">
                            {{ \Carbon\Carbon::parse($review->Date)->format('d.m.Y H:i') }}
                        </span>
                    </div>
                    
                    <div style="color: #f39c12; margin-bottom: 10px; font-size: 1.2em;">
                        {{ str_repeat('★', $review->Rating) }}{{ str_repeat('☆', 5 - $review->Rating) }}
                    </div>
                    
                    <p style="margin: 0; color: #444; line-height: 1.5;">{{ $review->Comment }}</p>
                </div>
            @endforeach
        @else
            <p style="color: #888; text-align: center; font-style: italic;">Про цей товар ще немає відгуків. Будьте першим!</p>
        @endif
    </div>

</body>
</html>