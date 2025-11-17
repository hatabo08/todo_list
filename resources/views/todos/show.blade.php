@extends('layout')

@section('content')
<h1>Todo</h1>

<p><strong>タイトル</strong> {{ $todo->title }}</p>
<p><strong>詳細</strong> {{ $todo->description ?? 'なし' }}</p>
<p><strong>ステータス</strong> {{ $todo->status }}</p>

<p><strong>タグ</strong>
    @if($todo->tags->isNotEmpty())
    @foreach($todo->tags as $tag)
    <span style="border:1px solid #ccc; padding:2px 6px; border-radius:4px; margin-right:4px;">
        {{ $tag->name }}
    </span>
    @endforeach
    @else
    <span>なし</span>
    @endif
</p>

<a href="{{ route('todos.index') }}"><button>todo一覧へ</button></a>
<a href="{{ route('tags.index') }}"><button>タグ一覧へ</button></a>
<a href="{{ route('todos.edit', $todo) }}"> <button>編集</button> </a>

<form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit">削除</button>
</form>
@endsection