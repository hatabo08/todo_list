@extends('layout')

@section('content')
<h1>Todo</h1>

<p><strong>タイトル</strong> {{ $todo->title }}</p>
<p><strong>詳細</strong> {{ $todo->description ?? 'なし' }}</p>
<p><strong>ステータス</strong> {{ $todo->status }}</p>

<p><strong>タグ</strong>
    @if($todo->tags->isNotEmpty())
    @foreach($todo->tags as $tag)
    <span>
        {{ $tag->name }}
    </span>
    @endforeach
    @else
    <span>なし</span>
    @endif
</p>

<p><strong>カテゴリー</strong>
    @if ($todo->category)
        {{ $todo->category->name }}
    @else
        なし
    @endif
</p>


<a href="{{ route('todos.index') }}"><button type="button">todo一覧へ</button></a>
<a href="{{ route('tags.index') }}"><button type="button">タグ一覧へ</button></a>
<a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧</button></a>
<a href="{{ route('todos.edit', $todo) }}"> <button type="button">編集</button> </a>

<form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">削除</button>
</form>
@endsection