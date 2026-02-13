@extends('layout')

@section('content')

<style>
    .hero-section {
        height: 600px;
        background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1587202372775-e229f172b9d7?q=80&w=2574&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }
    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        width: 100%;
    }
    .hero-title {
        font-size: 3.5em;
        font-weight: 800;
        margin-bottom: 10px;
        text-transform: uppercase;
        line-height: 1.1;
    }
    .hero-subtitle {
        font-size: 1.2em;
        margin-bottom: 30px;
        max-width: 600px;
        color: #ccc;
    }
</style>

<div class="hero-section">
    <div class="hero-content">
        <div style="color: #e74c3c; font-weight: bold; letter-spacing: 2px; margin-bottom: 10px;">МАГАЗИН КОМП'ЮТЕРНОЇ ТЕХНІКИ</div>
        <div class="hero-title">TECHNO CORE</div>
        <p class="hero-subtitle">
            Твій надійний партнер у світі комп'ютерних комплектуючих. Найкращі ціни на відеокарти та процесори в Україні.
        </p>
        <a href="{{ route('catalog') }}" class="btn btn-red">Всі товари</a>
    </div>
</div>

<div class="popular-section" style="max-width: 1200px; margin: 60px auto; padding: 0 20px;">
    
    <h2 style="text-align: center; text-transform: uppercase; margin-bottom: 40px; font-size: 2em;">
        Хіти <span style="color: #e74c3c;">Продажів</span>
    </h2>

    <style>
        .home-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 30px; }
        .product-card { background: white; border: 1px solid #eee; padding: 20px; border-radius: 8px; text-align: center; transition: 0.3s; position: relative; overflow: hidden; }
        .product-card:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.1); transform: translateY(-5px); }
        .product-card img { max-width: 100%; height: 180px; object-fit: contain; margin-bottom: 15px; }
        .product-title { font-weight: bold; font-size: 1.1em; margin-bottom: 10px; display: block; color: #333; }
        .product-price { color: #e74c3c; font-weight: bold; font-size: 1.3em; margin-bottom: 15px; }
        
        .badge-top { position: absolute; top: 10px; left: 10px; background: #e74c3c; color: white; padding: 5px 10px; font-size: 0.8em; font-weight: bold; border-radius: 4px; text-transform: uppercase; }
    </style>

    <div class="home-grid">
        @foreach($popularProducts as $product)
            <div class="product-card">
                <div class="badge-top">TOP</div>
                
                <img src="{{ asset($product->Image_path) }}" alt="{{ $product->Name }}" 
                     onerror="this.onerror=null;this.src='https://placehold.co/200?text=No+Image';">
                
                <a href="{{ route('product.show', $product->Item_id) }}" class="product-title">
                    {{ $product->Name }}
                </a>
                
                <div class="product-price">{{ $product->Price }} грн</div>
                
                <a href="{{ route('add.to.cart', $product->Item_id) }}" class="btn btn-red">
                    Купити
                </a>
            </div>
        @endforeach
    </div>

</div>

@endsection