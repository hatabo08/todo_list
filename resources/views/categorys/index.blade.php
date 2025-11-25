@extends('layout')

@section('content')
<h1>カテゴリー一覧</h1>

@if (session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif

<ul>
  @foreach($categorys as $category)
  <li>{{ $category->name }}

    <a href="{{ route('categorys.edit', $category) }}">
      <button type="button">編集</button>
    </a>
    <form action="{{ route('categorys.destroy', $category) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" onclick="return confirm('削除しますか？');">削除</button>
      </form>
  </li>
  @endforeach
</ul>

<a href="{{ route('categorys.create') }}"><button type="button">＋ 新しいカテゴリーを追加</button></a>

<a href="{{ route('todos.index') }}"><button type="button">todo一覧</button></a>

@endsection