@extends('layout')

@section('content')
    <h1>ToDoリスト</h1>
    <a href="{{ route('todos.create') }}">新しいタスクを追加</a>
    <ul>
        @foreach ($todos as $todo)
            <li>
                <strong>{{ $todo->title }}</strong> - {{ $todo->status }}
                <a href="{{route('todos.show',$todo) }}">詳細</a>
                <a href="{{ route('todos.edit', $todo) }}">編集</a>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
        @endforeach
    </ul>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.description-input').forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        let TodoId = this.dataset.id;
                        let newDescription = this.value;

                        
                        fetch(`/todos/${todoId}/update-description`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ description: newDescription })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('説明を更新しました！');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>
                        
                
@endsection
