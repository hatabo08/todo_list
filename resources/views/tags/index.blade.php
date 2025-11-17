@extends('layout')

@section('content')
<h1>タグ一覧</h1>

@if (session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif

<ul>
  @foreach($tag as $tag)
  <li>{{ $tag->name }}

    <a href="{{ route('tags.edit', $tag) }}">
      <button>編集</button>
    </a>
    <form action="{{ route('tags.destroy', $tag) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit" onclick="return confirm('削除しますか？');">削除</button>
  </li>
  @endforeach
</ul>
</form>
<a href="{{ route('tags.create') }}"><button>＋ 新しいタグを追加</button></a>

<a href="{{ route('todos.index') }}"><button>todo一覧</button></a>

@endsection