<!DOCTYPE html>
<html>
<head>
    <title>Дякуємо за замовлення!</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2 style="color: #e63946;">Вітаємо! Ваше замовлення успішно оформлено.</h2>
    <p>Деталі вашого замовлення:</p>
    <ul style="background-color: #f8f9fa; padding: 15px 30px; border-radius: 5px; list-style-type: none;">
        <li style="margin-bottom: 10px;"><strong>Номер замовлення:</strong> #{{ $order->Order_id ?? 'Нове' }}</li>
        <li style="margin-bottom: 10px;"><strong>Сума до сплати:</strong> {{ $order->Total_sum ?? 'Не вказано' }} грн</li>
        <li><strong>Адреса доставки:</strong> {{ $order->DeliveryAddr ?? 'Не вказано' }}</li>
    </ul>
    <p>Наш менеджер зв'яжеться з вами найближчим часом для підтвердження деталей відправки.</p>
    <br>
    <hr style="border: 0; border-top: 1px solid #ddd;">
    <p style="color: #666; font-size: 14px;">З повагою,<br>Команда магазину <strong>Techno Core</strong></p>
</body>
</html>