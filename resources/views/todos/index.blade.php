@extends('layout')

@section('content')
    <h1>ToDoリスト</h1>
    <a href="{{ route('todos.create') }}"><button>新しいタスクを追加</button></a>
    <ul>{{-- $todoが$todosからデータを一つずつ取り出す。--}}
        @foreach ($todos as $todo) 
            <li>
                <p>{{ $todo->title }}-{{ $todo->status }}</p>
                {{--$todosから取り出したデータが$todoに入る。--}}
                <a href="{{route('todos.show',$todo) }}"><button>詳細</button></a>
                <a href="{{ route('todos.edit', $todo) }}"><button>編集</button></a>
                <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </li>
        @endforeach 
    </ul>              
@endsection
