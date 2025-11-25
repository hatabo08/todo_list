@extends('layout')

@section('content')
<h1>新しいTODOを作る</h1>

<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <label>タイトル</label>
    <input type="text" name="title">
    <p><label>説明</label>
    <input type="text" name="description"></p>

    <div><label>ステータス</label>
    <select name="status">
        <option value="未着手">未着手</option>
        <option value="進行中">進行中</option>
        <option value="完了">完了</option>
    </select></div>

    <div>
    <label>カテゴリー</label>
    <select name="category_id">
        <option value="">選択なし</option>
        @foreach($categorys as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>



    <div>
    <label>タグ</label><br>

    @foreach($tags as $tag)
    <label>
        <input type="checkbox"
            name="tags[]"
            value="{{ $tag->id }}">
        {{ $tag->name }}
    </label>
@endforeach


   <div><button type="submit">追加</button></div>

</form>

<a href="{{ route('todos.index') }}"><button type="button">todo一覧へ</button></a>
<a href="{{ route('tags.index') }}"><button type="button">タグ一覧へ</button></a>
<a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧</button></a>
@endsection