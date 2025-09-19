@extends('layout')

@section('content')
 @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    
    @endauth
    <h1>ToDoリスト</h1>
    <a href="{{ route('todos.create') }}"><button>新しいタスクを追加</button></a>
    <p>ソート
    <a href="{{ route('todos.index', ['todos' => 'title']) }}">タイトル順</a> 
    <a href="{{ route('todos.index', ['todos' => 'created_at']) }}">作成日順</a> 
    <a href="{{ route('todos.index', ['todos' => 'status']) }}">ステータス順</a>
</p>
   <p>フィルター
    <a href="{{ route('todos.index', ['status' => '進行中']) }}">進行中</a>
    <a href="{{ route('todos.index', ['status' => '完了']) }}">完了</a>
    <a href="{{ route('todos.index', ['status' => '未着手']) }}">未着手</a>
   </p>
 
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
        {{ $todos->links() }}

    </ul>     
    

    
   
     
@endsection
