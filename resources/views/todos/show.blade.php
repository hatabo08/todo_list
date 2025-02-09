@extends('layout')

@section('content')
    <h1>タスクの詳細</h1>

    <p><strong>タイトル:</strong> {{ $todo->title }}</p>
    <p><strong>詳細:</strong> {{ $todo->description ?? 'なし' }}</p>
    <p><strong>ステータス:</strong> {{ $todo->status }}</p>

    <a href="{{ route('todos.index') }}">← 一覧に戻る</a>
    <a href="{{ route('todos.edit', $todo) }}">編集</a>

    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
@endsection
