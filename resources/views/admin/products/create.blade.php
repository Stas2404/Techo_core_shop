@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 800px; margin: 0 auto;">
    <h1>Додати новий товар</h1>

    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" style="background: white; padding: 30px; border-radius: 8px; border: 1px solid #ddd;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Назва товару *</label>
            <input type="text" name="Name" required style="width: 100%; padding: 10px;">
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label>Ціна (грн) *</label>
                <input type="number" step="0.01" name="Price" required style="width: 100%; padding: 10px;">
            </div>
            <div style="flex: 1;">
                <label>Стара ціна (для знижки)</label>
                <input type="number" step="0.01" name="OldPrice" value="0" style="width: 100%; padding: 10px;">
            </div>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label>Категорія *</label>
                <select name="Category_id" required style="width: 100%; padding: 10px;">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->Category_id }}">{{ $cat->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex: 1;">
                <label>Бренд *</label>
                <select name="Brand_id" required style="width: 100%; padding: 10px;">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->Brand_id }}">{{ $brand->Name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Фото товару</label>
            <input type="file" name="image" style="width: 100%; padding: 10px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Опис</label>
            <textarea name="Description" rows="5" style="width: 100%; padding: 10px;"></textarea>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Кількість на складі</label>
            <input type="number" name="Stock_quantity" value="10" style="width: 100%; padding: 10px;">
        </div>

        <button type="submit" class="btn btn-red" style="width: 100%; margin-top: 10px;">Зберегти товар</button>
    </form>
</div>
@endsection