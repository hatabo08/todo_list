@extends('layout')

@section('content')
    <h1>ToDoリスト</h1>
    <a href="{{ route('todos.create') }}">新しいタスクを追加</a>
    <ul>
        @foreach ($todos as $todo)
            <li>
                <strong>{{ $todo->title }}</strong> - {{ $todo->status }}
                <a href="{{route('todos.show',$todos) }}">詳細</a>
                <a href="{{ route('todos.edit', $todos) }}">編集</a>
                <form action="{{ route('todos.destroy', $todos) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
        @endforeach 
    </ul>              
@endsection
