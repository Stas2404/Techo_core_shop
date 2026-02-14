@extends('layout')

@section('content')

<style>
    .container { display: flex; gap: 30px; max-width: 1200px; margin: 40px auto; padding: 0 20px; }
    .sidebar { width: 250px; flex-shrink: 0; background: white; padding: 20px; border-radius: 8px; border: 1px solid #ddd; height: fit-content; }
    .content { flex-grow: 1; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
    .card { background: white; border: 1px solid #ddd; padding: 15px; border-radius: 8px; text-align: center; display: flex; flex-direction: column; justify-content: space-between; transition: 0.3s; }
    .card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.1); transform: translateY(-2px); }
    .card img { max-width: 100%; height: 150px; object-fit: contain; margin-bottom: 10px; }
    .price { color: #e74c3c; font-weight: bold; font-size: 1.2em; margin: 10px 0; }
    .old-price { text-decoration: line-through; color: gray; font-size: 0.9em; }
    .btn-buy { background-color: #e74c3c; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px; border: none; cursor: pointer;}
    .btn-buy:hover { background-color: #c0392b; }
    
    .filter-section { margin-bottom: 20px; }
    .filter-title { font-weight: bold; margin-bottom: 10px; display: block; font-size: 1.1em; text-transform: uppercase;}
    .filter-input { width: 100%; padding: 8px; margin-bottom: 5px; border: 1px solid #ccc; border-radius: 4px; }
    .apply-btn { width: 100%; background: #333; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 4px; text-transform: uppercase; font-weight: bold;}
    .apply-btn:hover { background: #555; }

    details {
        transition: all 0.3s ease;
    }

    summary.filter-summary {
        list-style: none;
        cursor: pointer;
        font-weight: bold;
        padding: 10px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #333;
    }
    
    summary.filter-summary::-webkit-details-marker {
        display: none;
    }

    summary.filter-summary .icon {
        font-weight: normal;
        font-size: 1.2em;
        color: #888;
    }

    details[open] summary.filter-summary .icon {
        transform: rotate(45deg);
    }
    
    .filter-options {
        padding-bottom: 15px;
        padding-left: 5px;
        max-height: 200px;
        overflow-y: auto;
    }
    
    .filter-options::-webkit-scrollbar {
        width: 5px;
    }
    .filter-options::-webkit-scrollbar-thumb {
        background: #ccc; 
        border-radius: 5px;
    }

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

<div class="container">
    
    <form action="{{ route('catalog') }}" method="GET" class="sidebar">
        <div class="filter-section">
            <span class="filter-title">Пошук</span>
            <input type="text" name="search" value="{{ request('search') }}" class="filter-input" placeholder="Пошук...">
        </div>

        <div class="filter-section">
             <span class="filter-title">Бренд</span>
             @foreach($brands as $brand)
                <div>
                    <input type="checkbox" name="brands[]" value="{{ $brand->Brand_id }}" id="brand_{{ $brand->Brand_id }}" 
                           {{ (is_array(request('brands')) && in_array($brand->Brand_id, request('brands'))) ? 'checked' : '' }}>
                    <label for="brand_{{ $brand->Brand_id }}">{{ $brand->Name }}</label>
                </div>
             @endforeach
        </div>

        <div class="filter-section">
             <span class="filter-title">Категорія</span>
             @foreach($categories as $cat)
                <div>
                    <input type="checkbox" name="categories[]" value="{{ $cat->Category_id }}" id="cat_{{ $cat->Category_id }}"
                           {{ (is_array(request('categories')) && in_array($cat->Category_id, request('categories'))) ? 'checked' : '' }}>
                    <label for="cat_{{ $cat->Category_id }}">{{ $cat->Name }}</label>
                </div>
             @endforeach
        </div>

        @if(isset($availableSpecs) && $availableSpecs->count() > 0)
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #eee;">
            <h4 style="margin-bottom: 15px;">Характеристики</h4>
            
            @foreach($availableSpecs as $name => $specs)
                @php
                    $isOpen = request('specs') && isset(request('specs')[$name]);
                @endphp

                <div class="filter-group" style="margin-bottom: 10px; border-bottom: 1px solid #f0f0f0;">
                    <details {{ $isOpen ? 'open' : '' }}>
                        <summary class="filter-summary">
                            {{ $name }}
                            <span class="icon">+</span>
                        </summary>
                        
                        <div class="filter-options">
                            @foreach($specs as $spec)
                                <div style="margin-bottom: 5px;">
                                    <label style="cursor: pointer; display: flex; align-items: center;">
                                        <input type="checkbox" 
                                            name="specs[{{ $name }}][]" 
                                            value="{{ $spec->Value }}"
                                            style="margin-right: 8px;"
                                            @if($isOpen && in_array($spec->Value, request('specs')[$name])) checked @endif
                                        >
                                        <span style="font-size: 0.9em; color: #555;">{{ $spec->Value }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </details>
                </div>
            @endforeach
        @endif

        <button type="submit" class="apply-btn">Застосувати</button>
        <a href="{{ route('catalog') }}" style="display: block; text-align: center; margin-top: 10px; color: #666; font-size: 0.9em;">Скинути</a>
    </form>

    <div class="content">
        <h1 style="margin-top: 0; text-transform: uppercase; letter-spacing: 1px;">Каталог товарів</h1>
        
        <div class="grid">
            @forelse($products as $product)
                <div class="card">
                    <div>
                        <img src="{{ asset($product->Image_path) }}" alt="{{ $product->Name }}" 
                             onerror="this.onerror=null;this.src='https://placehold.co/200?text=No+Image';">
                        
                        <h3><a href="{{ route('product.show', $product->Item_id) }}" style="color: #333; text-decoration: none;">{{ $product->Name }}</a></h3>
                        
                        <div class="price">{{ $product->Price }} грн</div>
                        @if($product->OldPrice > 0)
                            <div class="old-price">{{ $product->OldPrice }} грн</div>
                        @endif
                    </div>
                    <a href="{{ route('add.to.cart', $product->Item_id) }}" class="btn-buy">Купити</a>
                </div>
            @empty
                <p>Нічого не знайдено.</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection