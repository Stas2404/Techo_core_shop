@extends('layout')

@section('content')
<style>
    .pagination { display: flex; list-style: none; padding: 0; gap: 5px; }
    .page-item .page-link {
        padding: 8px 12px;
        border: 1px solid #ddd;
        color: #333;
        text-decoration: none;
        border-radius: 4px;
        background: white;
    }
    .page-item.active .page-link {
        background-color: #e74c3c;
        color: white;
        border-color: #e74c3c;
    }
    .page-item.disabled .page-link { color: #ccc; pointer-events: none; }
    svg { width: 20px; height: 20px; } 
    .text-sm { font-size: 0.9em; color: #666; margin-bottom: 10px; display: block;}
</style>

<div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="margin: 0;">Керування товарами</h1>
        <a href="{{ route('admin.product.create') }}" class="btn btn-red" style="background: green;">+ Додати товар</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #333; color: white; text-align: left;">
                <th style="padding: 15px;">ID</th>
                <th style="padding: 15px;">Фото</th>
                <th style="padding: 15px;">Назва</th>
                <th style="padding: 15px;">Ціна</th>
                <th style="padding: 15px;">Категорія</th>
                <th style="padding: 15px;">Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 15px;">{{ $product->Item_id }}</td>
                <td style="padding: 15px;">
                    <img src="{{ asset($product->Image_path) }}" width="50" height="50" style="object-fit: contain;">
                </td>
                <td style="padding: 15px; font-weight: bold;">{{ $product->Name }}</td>
                <td style="padding: 15px;">{{ $product->Price }} грн</td>
                <td style="padding: 15px;">
                    {{ $product->category ? $product->category->Name : $product->Category_id }}
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('admin.product.specifications', $product->Item_id) }}" style="color: #28a745; margin-right: 15px; font-weight: bold; text-decoration: none;">⚙️ Характеристики</a>
                    
                    <a href="{{ route('admin.product.edit', $product->Item_id) }}" style="color: blue; margin-right: 15px; text-decoration: none;">Ред.</a>
                    
                    <a href="{{ route('admin.product.delete', $product->Item_id) }}" onclick="return confirm('Ви точно хочете видалити цей товар?')" style="color: red; text-decoration: none;">Видалити</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection