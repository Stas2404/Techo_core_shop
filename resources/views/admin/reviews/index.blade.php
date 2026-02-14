@extends('layout') 

@section('content')
<style>
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

<div class="container mt-4">
    <h2>Управління відгуками</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive mt-3">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Товар</th>
                    <th>Клієнт</th>
                    <th>Оцінка</th>
                    <th>Коментар</th>
                    <th>Дата</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->Review_id }}</td>
                    <td>
                        {{-- Виводимо назву товару через зв'язок product --}}
                        <a href="{{ url('/product/'.$review->Item_id) }}" target="_blank">
                            {{ $review->product->Name ?? 'Товар видалено (ID: '.$review->Item_id.')' }}
                        </a>
                    </td>
                    <td>
                        {{-- Виводимо ім'я клієнта через зв'язок customer --}}
                        {{ $review->customer->FullName ?? 'Клієнт видалений' }}
                        <br>
                        <small class="text-muted">{{ $review->customer->Email ?? '' }}</small>
                    </td>
                    <td>
                        <span class="badge bg-{{ $review->Rating >= 4 ? 'success' : ($review->Rating == 3 ? 'warning' : 'danger') }}">
                            {{ $review->Rating }} ★
                        </span>
                    </td>
                    <td>{{ Str::limit($review->Comment, 80) }}</td>
                    <td>{{ $review->Date }}</td>
                    <td>
                        <form action="{{ route('admin.reviews.destroy', $review->Review_id) }}" method="POST" onsubmit="return confirm('Видалити цей відгук?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ПАГІНАЦІЯ: Тут застосовуємо "жорсткий" метод фіксу стрілок --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $reviews->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection