<!DOCTYPE html>
<html>
<head>
    <title>Нове питання</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>У вас нове повідомлення зі сторінки "Контакти"</h2>
    <p><strong>Від кого:</strong> {{ $data['name'] }}</p>
    <p><strong>Email для відповіді:</strong> {{ $data['email'] }}</p>
    @if(isset($data['phone']))
        <p><strong>Телефон:</strong> {{ $data['phone'] }}</p>
    @endif
    <hr>
    <p><strong>Текст повідомлення:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>