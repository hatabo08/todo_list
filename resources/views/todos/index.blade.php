@extends('layout')

@section('content')
<h1>ToDoリスト</h1>
@if (session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
<a href="{{ route('todos.create') }}"><button type="button">新しいTODOを作る</button></a>
<a href="{{ route('tags.index') }}"><button type="button">タグ一覧</button></a>
<a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧</button></a>
<p>ソート
    <a href="{{ route('todos.index', ['sort' => 'title']) }}">タイトル順</a>
    <a href="{{ route('todos.index', ['sort' => 'created_at']) }}">作成日順</a>
    <a href="{{ route('todos.index', ['sort' => 'status']) }}">ステータス順</a>
</p>
<p>フィルター
    <a href="{{ route('todos.index', ['filter' => '進行中']) }}">進行中</a>
    <a href="{{ route('todos.index', ['filter' => '完了']) }}">完了</a>
    <a href="{{ route('todos.index', ['filter' => '未着手']) }}">未着手</a>
</p>

<ul>{{-- $todoが$todosからデータを一つずつ取り出す。--}}
    @foreach ($todos as $todo)
    <li>
        <p>{{ $todo->title }}-{{ $todo->status }}</p>
        {{--$todosから取り出したデータが$todoに入る。--}}
        <a href="{{route('todos.show',$todo) }}"><button type="button">詳細</button></a>
        <a href="{{ route('todos.edit', $todo) }}"><button type="button">編集</button></a>
        <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    </li>
    @endforeach
    {{ $todos->links() }}

</ul>
@auth
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>

@endauth
@endsection