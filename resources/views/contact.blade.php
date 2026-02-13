@extends('layout')

@section('content')

<style>
    .contact-hero {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2670&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    .contact-hero h1 { font-size: 2.5em; text-transform: uppercase; letter-spacing: 2px; }

    .contact-container {
        max-width: 1100px;
        margin: -50px auto 50px;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 8px;
        display: flex;
        flex-wrap: wrap;
        overflow: hidden;
        position: relative;
    }

    .form-section { flex: 1; padding: 40px; min-width: 300px; }
    .form-title { font-size: 1.8em; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; }
    
    .form-group { margin-bottom: 20px; }
    .form-row { display: flex; gap: 20px; }
    .form-control { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; background: #f9f9f9; box-sizing: border-box; }
    .form-control:focus { border-color: #e74c3c; outline: none; background: white; }
    
    .btn-send { background: #e74c3c; color: white; border: none; padding: 12px 30px; font-weight: bold; text-transform: uppercase; cursor: pointer; border-radius: 4px; transition: 0.3s; }
    .btn-send:hover { background: #c0392b; }

    .info-section { flex: 0.8; background: #f4f4f4; padding: 40px; min-width: 300px; }
    .info-title { font-size: 1.5em; margin-bottom: 20px; font-weight: bold; text-transform: uppercase; }
    
    .info-item { margin-bottom: 20px; }
    .info-label { font-weight: bold; color: #888; font-size: 0.9em; margin-bottom: 5px; display: block; }
    .info-value { font-size: 1.1em; color: #333; }

</style>

<div class="contact-hero">
    <h1>Контактна Інформація</h1>
</div>

<div class="contact-container">
    
    <div class="form-section">
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <h2 class="form-title">Залишились питання?</h2>
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group" style="flex:1;">
                    <input type="text" name="name" class="form-control" placeholder="Ваше Ім'я" required>
                </div>
                <div class="form-group" style="flex:1;">
                    <input type="text" name="phone" class="form-control" placeholder="Телефон">
                </div>
            </div>
            
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email адреса" required>
            </div>
            
            <div class="form-group">
                <textarea name="message" rows="5" class="form-control" placeholder="Ваше повідомлення..." required></textarea>
            </div>

            <button type="submit" class="btn-send">Надіслати повідомлення</button>
        </form>
    </div>

    <div class="info-section">
        <h2 class="info-title">Контакти</h2>
        
        <div class="info-item">
            <span class="info-label">ГРАФІК РОБОТИ</span>
            <div class="info-value">Пн – Пт: 09:00 – 20:00</div>
            <div class="info-value">Сб – Нд: 10:00 – 18:00</div>
            <div style="font-size: 0.9em; color: #666; margin-top: 5px;">(Прийом замовлень на сайті — цілодобово)</div>
        </div>

        <div class="info-item">
            <span class="info-label">АДРЕСА</span>
            <div class="info-value">Україна, м. Київ, вул. Хрещатик 10</div>
        </div>

        <div class="info-item">
            <span class="info-label">ТЕЛЕФОН</span>
            <div class="info-value">+38 095 739 87 13</div>
        </div>

        <div class="info-item">
            <span class="info-label">EMAIL</span>
            <div class="info-value">technocore@company.com</div>
        </div>
    </div>

</div>

@endsection