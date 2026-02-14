<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techno Core</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; color: #333; display: flex; flex-direction: column; min-height: 100vh; }
        a { text-decoration: none; color: inherit; transition: 0.3s; }
        ul { list-style: none; padding: 0; margin: 0; }
        
        header { background-color: #1a1a1a; color: white; padding: 15px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.3); }
        .header-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        .logo { font-size: 1.5em; font-weight: bold; display: flex; align-items: center; gap: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .logo span { color: #e74c3c; }
        
        .nav-menu { display: flex; gap: 30px; }
        .nav-menu a { font-weight: 500; font-size: 0.9em; text-transform: uppercase; color: #ccc; }
        .nav-menu a:hover { color: #e74c3c; }

        .header-cart { display: flex; align-items: center; gap: 10px; font-size: 0.9em; }
        .cart-icon { position: relative; }
        .cart-count { background: #e74c3c; color: white; border-radius: 50%; padding: 2px 6px; font-size: 10px; position: absolute; top: -8px; right: -8px; }

        main { flex: 1; }

        footer { background-color: #111; color: #888; padding: 50px 0 20px; margin-top: auto; }
        .footer-container { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; padding: 0 20px; }
        .footer-col h3 { color: white; margin-bottom: 20px; text-transform: uppercase; font-size: 1em; letter-spacing: 1px; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul li a:hover { color: #e74c3c; padding-left: 5px; }
        .copyright { text-align: center; margin-top: 40px; border-top: 1px solid #222; padding-top: 20px; font-size: 0.8em; }

        .btn { display: inline-block; padding: 10px 25px; border-radius: 4px; font-weight: bold; text-transform: uppercase; cursor: pointer; border: none; }
        .btn-red { background-color: #e74c3c; color: white; }
        .btn-red:hover { background-color: #c0392b; }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <a href="/" class="logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                Techno <span>Core</span>
            </a>

            <nav class="nav-menu">
                <a href="{{ route('home') }}">Головна</a>
                <a href="{{ route('catalog') }}">Товари</a>
                <a href="{{ route('about') }}">Про нас</a>   
                <a href="{{ route('contact') }}">Контакти</a> </nav>

            <div class="header-cart">
                <a href="{{ route('cart.index') }}" style="display: flex; align-items: center; gap: 5px;">
                    <div class="cart-icon">
                        🛒
                        <span class="cart-count">{{ count((array) session('cart')) }}</span>
                    </div>
                    <span>Кошик</span>
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-col">
                <h3>Корисні посилання</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Головна сторінка</a></li>
                    <li><a href="{{ route('catalog') }}">Товари</a></li>
                    <li><a href="{{ route('about') }}">Про нас</a></li> <li><a href="{{ route('contact') }}">Зв'язатись з нами</a></li> </ul>
            </div>
            <div class="footer-col">
                <h3>Наші товари</h3>
                <ul>
                    <li>
                        <a href="{{ route('catalog', ['categories' => [1]]) }}">Процесори</a>
                    </li>
                    <li>
                        <a href="{{ route('catalog', ['categories' => [2]]) }}">Відеокарти</a>
                    </li>
                    <li>
                        <a href="{{ route('catalog', ['categories' => [3]]) }}">Материнські плати</a>
                    </li>
                    <li>
                        <a href="{{ route('catalog', ['categories' => [4]]) }}">Оперативна пам'ять</a>
                    </li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Акаунт</h3>
                <ul>
                    @auth
                        <li>Привіт, {{ Auth::user()->FullName }}!</li>
                        
                        @if(Auth::user()->is_admin == 1)
                            <li>
                                <a href="{{ route('admin.dashboard') }}" style="color: #e74c3c; font-weight: bold;">
                                    ⚙️ Адмін-панель
                                </a>
                            </li>
                        @endif

                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none; border:none; color:#888; cursor:pointer; padding:0; font:inherit;">Вийти</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Вхід / Реєстрація</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="copyright">
            &copy; 2026 Techno Core. Всі права захищено.
        </div>
    </footer>

</body>
</html>