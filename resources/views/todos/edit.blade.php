@extends('layout')

@section('content')
    <h1>タスクを編集 ✏️</h1>

    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>タイトル:</label>
        <input type="text" name="title" value="{{ $todo->title }}" required>

        <label>詳細:</label>
        <textarea name="description" rows="4" cols="50">{{ $todo->description }}</textarea>

        <label>ステータス:</label>
        <select name="status">
            <option value="未着手" {{ $todo->status == '未着手' ? 'selected' : '' }}>未着手</option>
            <option value="進行中" {{ $todo->status == '進行中' ? 'selected' : '' }}>進行中</option>
            <option value="完了" {{ $todo->status == '完了' ? 'selected' : '' }}>完了</option>
        </select>

        <button type="submit">更新</button>
    </form>
@endsection
