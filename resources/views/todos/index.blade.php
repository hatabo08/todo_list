@extends('layout')

@section('content')
    <h1>ToDoリスト</h1>
    <a href="{{ route('todos.create') }}"><button>新しいタスクを追加</button></a>
    <ul>
        @foreach ($todos as $todo)
            <li>
                <p>{{ $todo->title }}-{{ $todo->status }}</p>
                <a href="{{route('todos.show',$todos) }}"><button>詳細</button></a>
                <a href="{{ route('todos.edit', $todos) }}"><button>編集</button></a>
                <form action="{{ route('todos.destroy', $todos) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
        @endforeach 
    </ul>              
@endsection
