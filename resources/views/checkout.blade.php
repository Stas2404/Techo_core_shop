@extends('layout')

@section('content')
@if ($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 20px; margin-bottom: 20px; border: 1px solid #f5c6cb; border-radius: 5px;">
            <h4 style="margin-top: 0;">Упс! Є помилки:</h4>
            <ul style="margin-bottom: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div style="padding: 40px; max-width: 1000px; margin: 0 auto;">
    <h1>Оформлення замовлення</h1>

    <form action="{{ route('checkout.store') }}" method="POST" style="display: flex; gap: 30px; margin-top: 30px; flex-wrap: wrap;">
        @csrf

        <div style="flex: 1; min-width: 300px; background: white; padding: 25px; border: 1px solid #ddd; border-radius: 8px;">
            <h3>Ваші дані</h3>
            
            <div style="margin-bottom: 15px;">
                <label>ПІБ *</label>
                <input type="text" name="FullName" required style="width: 100%; padding: 10px;"
                       value="{{ Auth::check() ? Auth::user()->FullName : old('FullName') }}">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Телефон *</label>
                <input type="text" name="Phone" id="phone_mask" required style="width: 100%; padding: 10px;"
                       value="{{ Auth::check() ? Auth::user()->Phone : old('Phone') }}">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Адреса доставки *</label>
                <input type="text" name="Address" required style="width: 100%; padding: 10px;"
                       value="{{ Auth::check() ? Auth::user()->Address : old('Address') }}">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label>Email (для чеку) *</label>
                <input type="email" name="Email" required style="width: 100%; padding: 10px;"
                       value="{{ Auth::check() ? Auth::user()->Email : old('Email') }}">
            </div>

            @guest
                <div style="background: #f9f9f9; padding: 15px; margin-top: 20px; border-radius: 5px; border: 1px dashed #ccc;">
                    <div style="margin-bottom: 10px;">
                        <input type="checkbox" id="register_me" name="register_me">
                        <label for="register_me" style="font-weight: bold; cursor: pointer;">Створити акаунт?</label>
                    </div>

                    <div id="password_block" style="display: none;">
                        <label>Придумайте пароль *</label>
                        <input type="password" name="Password" style="width: 100%; padding: 10px;">
                    </div>
                </div>

                <script>
                    document.getElementById('register_me').addEventListener('change', function() {
                        document.getElementById('password_block').style.display = this.checked ? 'block' : 'none';
                    });
                </script>
            @endguest
        </div>

        <div style="width: 300px; background: white; padding: 25px; border: 1px solid #ddd; border-radius: 8px; height: fit-content;">
            <h3>Ваш кошик</h3>
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                    <span>{{ $item['price'] * $item['quantity'] }} грн</span>
                </div>
            @endforeach
            
            <div style="font-size: 1.5em; font-weight: bold; margin-top: 20px; color: #e74c3c;">
                Всього: {{ $total }} грн
            </div>

            <button type="submit" class="btn btn-red" style="width: 100%; margin-top: 20px; padding: 15px; background: #e74c3c; color: white; border: none; font-weight: bold; cursor: pointer;">
                ПІДТВЕРДИТИ ЗАМОВЛЕННЯ
            </button>
        </div>
    </form>
</div>

<script src="https://unpkg.com/imask"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var phoneInput = document.getElementById('phone_mask');

        var maskOptions = {
            mask: '+{38} (000) 000-00-00',
            lazy: false,  
            placeholderChar: '_'
        };

        var mask = IMask(phoneInput, maskOptions);
    });
</script>

@endsection