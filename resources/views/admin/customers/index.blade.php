@extends('layout')

@section('content')
<div style="padding: 40px; max-width: 1200px; margin: 0 auto;">
    
    <h1 style="margin-bottom: 30px;">Керування клієнтами</h1>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px;">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px;">❌ {{ session('error') }}</div>
    @endif

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #333; color: white; text-align: left;">
                <th style="padding: 15px;">ID</th>
                <th style="padding: 15px;">Ім'я</th>
                <th style="padding: 15px;">Email / Телефон</th>
                <th style="padding: 15px;">Роль</th>
                <th style="padding: 15px;">Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $user)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 15px;">{{ $user->Customer_id }}</td>
                
                <td style="padding: 15px; font-weight: bold;">
                    {{ $user->FullName }}
                    <br>
                    <span style="font-size: 0.8em; color: #888; font-weight: normal;">Реєстрація: {{ $user->RegDate }}</span>
                </td>
                
                <td style="padding: 15px;">
                    <div>📧 {{ $user->Email }}</div>
                    <div style="margin-top: 5px;">📞 {{ $user->Phone }}</div>
                    @if($user->Address)
                        <div style="font-size: 0.85em; color: #666; margin-top: 5px;">📍 {{ $user->Address }}</div>
                    @endif
                </td>

                <td style="padding: 15px;">
                    @if($user->is_admin)
                        <span style="background: #e74c3c; color: white; padding: 5px 10px; border-radius: 15px; font-size: 0.8em; font-weight: bold;">Адмін</span>
                    @else
                        <span style="background: #28a745; color: white; padding: 5px 10px; border-radius: 15px; font-size: 0.8em; font-weight: bold;">Клієнт</span>
                    @endif
                </td>

                <td style="padding: 15px;">
                    <a href="{{ route('admin.customer.toggle', $user->Customer_id) }}" 
                       style="color: #007bff; text-decoration: none; margin-right: 15px; font-weight: bold;">
                       {{ $user->is_admin ? 'Забрати права' : 'Зробити адміном' }}
                    </a>
                    
                    <a href="{{ route('admin.customer.delete', $user->Customer_id) }}" 
                       onclick="return confirm('Ви впевнені? Це незворотна дія.')"
                       style="color: red; text-decoration: none;">✕ Видалити</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $customers->links() }}
    </div>

</div>
@endsection