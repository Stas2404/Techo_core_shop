@extends('layout')

@section('content')

<style>
    .auth-container { max-width: 1000px; margin: 50px auto; display: flex; gap: 40px; padding: 0 20px; }
    .auth-box { flex: 1; background: white; padding: 30px; border-radius: 8px; border: 1px solid #ddd; }
    .auth-title { font-size: 1.5em; font-weight: bold; margin-bottom: 20px; text-transform: uppercase; border-bottom: 2px solid #eee; padding-bottom: 10px; }
    
    .form-group { margin-bottom: 15px; }
    .form-label { display: block; margin-bottom: 5px; font-weight: 500; font-size: 0.9em; }
    .form-input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
    
    .btn-auth { width: 100%; padding: 12px; border: none; border-radius: 4px; color: white; font-weight: bold; cursor: pointer; text-transform: uppercase; margin-top: 10px; }
    .btn-login { background-color: #333; }
    .btn-register { background-color: #e74c3c; }
    .btn-register:hover { background-color: #c0392b; }

    .error-msg { color: red; font-size: 0.85em; margin-top: 5px; }
    
    @media (max-width: 768px) {
        .auth-container { flex-direction: column; }
    }
</style>

<div class="auth-container">
    
    <div class="auth-box">
        <h2 class="auth-title">Вхід</h2>
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email адреса *</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                @error('email') <div class="error-msg">{{ $message }}</div> @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Пароль *</label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <button type="submit" class="btn-auth btn-login">Увійти</button>

            <div style="margin-top: 20px; text-align: center;">
    
                <div style="position: relative; margin-bottom: 20px;">
                    <hr style="border: 0; border-top: 1px solid #ddd;">
                    <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: #fff; padding: 0 10px; color: #777; font-size: 0.9em;">
                        або
                    </span>
                </div>

                <a href="{{ route('google.login') }}" style="
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    background-color: #fff;
                    color: #757575;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    padding: 10px 0;
                    text-decoration: none;
                    font-family: Roboto, sans-serif;
                    font-weight: 500;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                    transition: background-color 0.2s, box-shadow 0.2s;
                " onmouseover="this.style.backgroundColor='#f8f9fa'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.2)'" onmouseout="this.style.backgroundColor='#fff'; this.style.boxShadow='0 1px 2px rgba(0,0,0,0.1)'">
                    
                    <svg width="18" height="18" viewBox="0 0 48 48" style="margin-right: 12px;">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                    </svg>
                    Увійти через Google
                </a>
            </div>
        </form>
    </div>

    <div class="auth-box">
        <h2 class="auth-title">Реєстрація</h2>
        <p style="font-size: 0.9em; color: #666; margin-bottom: 20px;">
            Створіть акаунт, щоб відслідковувати замовлення.
        </p>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">ПІБ (Повне ім'я) *</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name') }}" placeholder="Петренко Іван">
                @error('name') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Телефон *</label>
                <input type="text" name="phone" class="form-input" required value="{{ old('phone') }}" placeholder="+380...">
                @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email адреса *</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                @error('email') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Адреса доставки</label>
                <input type="text" name="address" class="form-input" value="{{ old('address') }}" placeholder="Місто, вулиця...">
            </div>
            
            <div class="form-group">
                <label class="form-label">Пароль *</label>
                <input type="password" name="password" class="form-input" required>
                @error('password') <div class="error-msg">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn-auth btn-register">Зареєструватися</button>
        </form>
    </div>

</div>

@endsection