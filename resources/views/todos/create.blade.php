@extends('layout')

@section('content')
<h1>追加</h1>

<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <label>タイトル</label>
    <input type="text" name="title">
    <label>説明</label>
    <input type="text" name="description">

    <label>ステータス</label>
    <select name="status">
        <option value="未着手">未着手</option>
        <option value="進行中">進行中</option>
        <option value="完了">完了</option>
    </select>

    <label>タグ</label>
    <select name="tags[]" multiple size="6">
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>

    <button type="submit">追加</button>

</form>

<a href="{{ route('todos.index') }}"><button>todo一覧へ</button></a>
<a href="{{ route('tags.index') }}"><button>タグ一覧へ</button></a>
@endsection