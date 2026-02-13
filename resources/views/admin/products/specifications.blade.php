@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 1000px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Характеристики: {{ $product->Name }}</h1>
        <a href="{{ route('admin.products') }}" style="color: #666; text-decoration: none; border: 1px solid #ccc; padding: 5px 10px; border-radius: 5px;">&larr; Назад до товарів</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;">✅ {{ session('success') }}</div>
    @endif

    <div style="display: flex; gap: 30px; align-items: flex-start;">
        
        <div style="flex: 1; background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd; position: sticky; top: 20px;">
            <h3 style="margin-top: 0;">Додати нову</h3>
            
            <form action="{{ route('admin.product.add_specification', $product->Item_id) }}" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; font-size: 0.9em; color: #555;">Назва (напр. "Сокет", "Об'єм") *</label>
                    <input type="text" name="Name" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label style="font-weight: bold; font-size: 0.9em; color: #555;">Значення (напр. "LGA1700", "1 ТБ") *</label>
                    <input type="text" name="Value" required style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                
                <button type="submit" style="width: 100%; padding: 12px; background: #28a745; color: white; border: none; cursor: pointer; border-radius: 4px; font-weight: bold;">+ Зберегти характеристику</button>
            </form>
        </div>

        <div style="flex: 2; background: white; padding: 25px; border-radius: 8px; border: 1px solid #ddd;">
            <h3 style="margin-top: 0;">Існуючі характеристики</h3>
            
            @if($product->specifications->count() > 0)
                <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                    <thead>
                        <tr style="border-bottom: 2px solid #ddd; text-align: left; color: #666;">
                            <th style="padding-bottom: 10px;">Назва параметра</th>
                            <th style="padding-bottom: 10px;">Значення</th>
                            <th style="padding-bottom: 10px; text-align: center;">Видалити</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product->specifications as $spec)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 15px 0; font-weight: bold; color: #333;">{{ $spec->Name }}</td>
                            <td style="padding: 15px 0; color: #555;">{{ $spec->Value }}</td>
                            <td style="padding: 15px 0; text-align: center;">
                                <a href="{{ route('admin.specification.delete', $spec->Spec_id) }}" 
                                   onclick="return confirm('Видалити цей параметр?')"
                                   style="color: red; text-decoration: none; font-size: 1.2em; font-weight: bold;">✕</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p style="color: #888; margin-top: 20px;">У цього товару ще немає технічних характеристик. Додайте першу зліва!</p>
            @endif
        </div>

    </div>
</div>
@endsection