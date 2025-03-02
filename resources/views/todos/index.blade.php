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
@endsection
