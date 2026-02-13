@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 800px; margin: 0 auto;">
    <h1>Редагувати товар: {{ $product->Name }}</h1>

    <form action="{{ route('admin.product.update', $product->Item_id) }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 30px; border-radius: 8px; border: 1px solid #ddd;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Назва товару *</label>
            <input type="text" name="Name" value="{{ $product->Name }}" required style="width: 100%; padding: 10px;">
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label>Ціна (грн) *</label>
                <input type="number" step="0.01" name="Price" value="{{ $product->Price }}" required style="width: 100%; padding: 10px;">
            </div>
            <div style="flex: 1;">
                <label>Стара ціна</label>
                <input type="number" step="0.01" name="OldPrice" value="{{ $product->OldPrice }}" style="width: 100%; padding: 10px;">
            </div>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label>Категорія</label>
                <select name="Category_id" required style="width: 100%; padding: 10px;">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->Category_id }}" {{ $product->Category_id == $cat->Category_id ? 'selected' : '' }}>
                            {{ $cat->Name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex: 1;">
                <label>Бренд</label>
                <select name="Brand_id" required style="width: 100%; padding: 10px;">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->Brand_id }}" {{ $product->Brand_id == $brand->Brand_id ? 'selected' : '' }}>
                            {{ $brand->Name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Поточне фото:</label><br>
            <img src="{{ asset($product->Image_path) }}" width="100"><br><br>
            
            <label>Завантажити нове (якщо треба змінити):</label>
            <input type="file" name="image" style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Опис</label>
            <textarea name="Description" rows="5" style="width: 100%; padding: 10px;">{{ $product->Description }}</textarea>
        </div>
        
         <div style="margin-bottom: 15px;">
            <label>Кількість на складі</label>
            <input type="number" name="Stock_quantity" value="{{ $product->Stock_quantity }}" style="width: 100%; padding: 10px;">
        </div>

        <button type="submit" class="btn btn-red" style="width: 100%; margin-top: 10px;">Оновити товар</button>
    </form>
</div>
@endsection