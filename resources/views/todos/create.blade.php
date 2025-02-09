@extends('layout')

@section('content')
    <h1>新しいタスクを追加</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <label>タイトル:</label>
        <input type="text" name="title" required>
        <label>説明:</label>
        <input type="text" name="description">

        <label>ステータス:</label>
        <select name="status">
            <option value="未着手">未着手</option>
            <option value="進行中">進行中</option>
            <option value="完了">完了</option>
        </select>

        <button type="submit">追加</button>
    </form>
@endsection
