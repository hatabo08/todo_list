@extends('layout')

@section('content')
    <h1>タスクの詳細</h1>

    <p><strong>タイトル:</strong> {{ $todo->title }}</p>
    <p><strong>詳細:</strong> {{ $todo->description ?? 'なし' }}</p>
    <p><strong>ステータス:</strong> {{ $todo->status }}</p>

    <a href="{{ route('todos.index') }}"><button>一覧に戻る</button></a>
    <a href="{{ route('todos.edit', $todo) }}"> <button>編集</button> </a>

    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endsection
