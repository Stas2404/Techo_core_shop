@extends('layout')

@section('content')

<style>
    .about-section { max-width: 900px; margin: 60px auto; padding: 0 20px; }
    .section-title { text-align: center; text-transform: uppercase; font-size: 2em; margin-bottom: 40px; letter-spacing: 1px; }
    
    .text-block { margin-bottom: 40px; }
    .text-block h3 { font-size: 1.5em; text-transform: uppercase; margin-bottom: 15px; color: #333; border-left: 4px solid #e74c3c; padding-left: 15px; }
    .text-block p { color: #555; line-height: 1.6; font-size: 1.1em; }

    .steps-wrapper { background-color: #f9f9f9; padding: 60px 0; margin-top: 60px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; }
    .steps-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; }
    
    .step-card h4 { color: #e74c3c; font-size: 1.2em; margin-bottom: 10px; font-weight: 800; }
    .step-card h3 { font-size: 1.3em; text-transform: uppercase; margin-bottom: 15px; font-weight: bold; }
    .step-card p { font-size: 0.9em; color: #666; line-height: 1.5; }
</style>

<div class="about-section">
    <h1 class="section-title">Історія Techno Core</h1>

    <div class="text-block">
        <h3>Наш Старт</h3>
        <p>Історія TECHNO CORE почалася з простої ідеї: комп'ютерне залізо має бути доступним, а сервіс — зрозумілим. Ми стартували не як велика корпорація, а як команда ентузіастів, які самі обожнюють ігри та технології.</p>
    </div>

    <div class="text-block">
        <h3>Еволюція</h3>
        <p>Спочатку це була лише допомога друзям зі збіркою ігрових ПК та пошук рідкісних комплектуючих. Але ми швидко зрозуміли, що українському ринку не вистачає магазину, де вам не просто "продадуть товар", а допоможуть вирішити задачу. Так з'явився TECHNO CORE.</p>
    </div>

    <div class="text-block">
        <h3>Наша Філософія</h3>
        <p>Ми пройшли шлях від локальних замовлень до повноцінного інтернет-магазину. Сьогодні ми пропонуємо все: від бюджетних офісних рішень до топових станцій на базі RTX 4090. Але наш головний принцип залишився незмінним: ми радимо клієнтам лише те, що купили б собі самі.</p>
    </div>
</div>

<div class="steps-wrapper">
    <h2 class="section-title">Як ми працюємо</h2>
    <div class="steps-container">
        
        <div class="step-card">
            <h4>01.</h4>
            <h3>Консультація</h3>
            <p>Ми уважно слухаємо ваші побажання. Для ігор, роботи чи навчання? Підбираємо оптимальну конфігурацію під ваш бюджет та задачі.</p>
        </div>

        <div class="step-card">
            <h4>02.</h4>
            <h3>Підбір компонентів</h3>
            <p>Перевіряємо кожну деталь на сумісність. Жодних "вузьких місць". Тільки збалансовані збірки на базі Intel, AMD та NVIDIA.</p>
        </div>

        <div class="step-card">
            <h4>03.</h4>
            <h3>Професійна збірка</h3>
            <p>Акуратний кабель-менеджмент та правильне налаштування охолодження. Проводимо стрес-тести (FurMark, AIDA64), щоб гарантувати стабільність.</p>
        </div>

        <div class="step-card">
            <h4>04.</h4>
            <h3>Гарантія та підтримка</h3>
            <p>Ви отримуєте готовий до роботи ПК з гарантією. Ми завжди на зв'язку, якщо вам знадобиться допомога або апгрейд у майбутньому.</p>
        </div>

    </div>
</div>
</div> </div> <div style="max-width: 1200px; margin: 60px auto; padding: 0 20px; text-align: center;">
    <h2 class="section-title" style="margin-bottom: 30px;"></h2>
    <img src="https://images.unsplash.com/photo-1593640495253-23196b27a87f?q=80&w=2664&auto=format&fit=crop"
         alt="Techno Core Gaming Setup"
         style="width: 100%; height: 500px; object-fit: cover; border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);">
</div>

@endsection