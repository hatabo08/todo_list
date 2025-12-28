@extends('layout')

@section('content')

<h1>ToDoリスト</h1>
@if (session('success'))
<p style="color:green;">{{ session('success') }}</p>
@endif
<a href="{{ route('todos.create') }}"><button type="button">新しいTODOを作る</button></a>
<a href="{{ route('tags.index') }}"><button type="button">タグ一覧</button></a>
<a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧</button></a>

<form action="{{ route('todos.index') }}" method="GET">

  <div>
    <strong>ソート</strong>
    <label>
      <input type="radio" name="sort" value="created_at"
        {{ ($sort ?? 'created_at') === 'created_at' ? 'checked' : '' }}>
      作成日
    </label>

    <label>
      <input type="radio" name="sort" value="title"
        {{ ($sort ?? '') === 'title' ? 'checked' : '' }}>
      タイトル
    </label>

    <label>
      <input type="radio" name="sort" value="status"
        {{ ($sort ?? '') === 'status' ? 'checked' : '' }}>
      ステータス
    </label>
  </div>

  <div>
    <strong>ステータス</strong><br>
    <label>
      <input type="checkbox" name="filter[]" value="未着手"
        {{ in_array('未着手', $selectedStatus ?? []) ? 'checked' : '' }}>
      未着手
    </label>

    <label>
      <input type="checkbox" name="filter[]" value="進行中"
        {{ in_array('進行中', $selectedStatus ?? []) ? 'checked' : '' }}>
      進行中
    </label>

    <label>
      <input type="checkbox" name="filter[]" value="完了"
        {{ in_array('完了', $selectedStatus ?? []) ? 'checked' : '' }}>
      完了
    </label>
  </div>

  <div>
    <strong>タグ</strong><br>
    @foreach($tags as $tag)
    <label>
      <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
        {{ in_array($tag->id, $selectedTagIds ?? []) ? 'checked' : '' }}>
      {{ $tag->name }}
    </label>
    @endforeach
  </div>

  <div>
    <strong>カテゴリー</strong><br>
    @foreach($categorys as $category)
    <label>
      <input type="checkbox" name="categorys[]" value="{{ $category->id }}"
        {{ in_array($category->id, $selectedCategoryIds ?? []) ? 'checked' : '' }}>
      {{ $category->name }}
    </label>
    @endforeach
  </div>

  <div>
    <button type="submit">絞り込む</button>
    <a href="{{ route('todos.index') }}">リセット</a>
  </div>
</form>



<ul>
  @foreach ($todos as $todo)
  <li>
    <p>{{ $todo->title }}-{{ $todo->status }}</p>

    @if ($todo->category)
    <p>カテゴリー{{ $todo->category->name }}</p>
    @else
    <p>カテゴリーなし</p>
    @endif

    @if ($todo->tags->count())
    <p>
      タグ
      @foreach ($todo->tags as $tag)
      {{ $tag->name }}@if(!$loop->last)、@endif
      @endforeach
    </p>
    @else
    <p>タグなし</p>
    @endif
    <a href="{{route('todos.show',$todo) }}"><button type="button">詳細</button></a>
    <a href="{{ route('todos.edit', $todo) }}"><button type="button">編集</button></a>
    <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
      @csrf
      @method('DELETE')
      <button type="submit">削除</button>
    </form>
  </li>
  @endforeach


  {{ $todos->links('pagination::bootstrap-5') }}


</ul>

@auth
<form method="POST" action="{{ route('logout') }}">
  @csrf
  <button type="submit">ログアウト</button>
</form>

@endauth
@endsection