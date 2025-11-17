@extends('layout')

@section('content')
<h1>編集</h1>

<form action="{{ route('todos.update', ['todo' => $todo->id])
 }}" method="POST">
    @csrf
    @method('PUT')

    <label>タイトル</label>
    <input type="text" name="title" value="{{ $todo->title }}" required>

    <label>詳細</label>
    <textarea name="description" rows="4" cols="50">{{ $todo->description }}</textarea>

    <label>ステータス</label>
    <select name="status">
        <option value="未着手" {{ $todo->status == '未着手' ? 'selected' : '' }}>未着手</option>
        <option value="進行中" {{ $todo->status == '進行中' ? 'selected' : '' }}>進行中</option>
        <option value="完了" {{ $todo->status == '完了' ? 'selected' : '' }}>完了</option>
    </select>
</form>

<h3>現在のタグ</h3>
@forelse($todo->tags as $tag)
<form action="{{ route('todos.tags.detach', [$todo->id, $tag->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <span style="border:1px solid #ccc; padding:2px 6px; border-radius:4px; margin-right:4px;">
        {{ $tag->name }}
    </span>
    <button type="submit">外す</button>
</form>
@empty
<p>タグはまだついていません。</p>
@endforelse

<h3>タグを追加</h3>
<form action="{{ route('todos.tags.attach', $todo->id) }}" method="POST">
    @csrf
    <select name="tag_id">
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
        @endforeach
    </select>
    <button type="submit">追加</button>
</form>

<a href="{{ route('todos.index') }}"><button type="submit">更新</button>
    <a href="{{ route('todos.index') }}"><button>todo一覧へ</button></a>
    <a href="{{ route('tags.index') }}"><button>タグ一覧へ</button></a>

    @endsection