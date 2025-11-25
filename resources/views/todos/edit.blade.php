@extends('layout')

@section('content')
<h1>編集</h1>

<form action="{{ route('todos.update', ['todo' => $todo->id])
 }}" method="POST">
    @csrf
    @method('PUT')
    <button type="submit">更新</button>
    <a href="{{ route('todos.index') }}"><button type="button">todo一覧へ</button></a>
    <a href="{{ route('tags.index') }}"><button type="button">タグ一覧へ</button></a>
    <a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧</button></a>
    <div>
        <label>タイトル</label>
        <input type="text" name="title" value="{{ $todo->title }}">
    </div>

    <div>
        <label>詳細</label>
        <textarea name="description">{{ $todo->description }}</textarea>
    </div>

    <div>
        <label>ステータス</label>
        <select name="status">
            <option value="未着手" {{ $todo->status == '未着手' ? 'selected' : '' }}>未着手</option>
            <option value="進行中" {{ $todo->status == '進行中' ? 'selected' : '' }}>進行中</option>
            <option value="完了" {{ $todo->status == '完了' ? 'selected' : '' }}>完了</option>
        </select>
    </div>


    <div> <label>カテゴリー</label>
        <select name="category_id">
            <option value="">選択なし</option>
            @foreach($categorys as $category)
            <option value="{{ $category->id }}"
                {{$todo->category_id == $category->id ? 'selected' : '' }}>
                {{-- =は値を比較する、selectedは値がすでに選ばれてる状態 --}}
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div> <label>タグ</label>
        @foreach($tags as $tag)
        <label>
            <input type="checkbox"
                name="tags[]"
                value="{{ $tag->id }}"
                @if(in_array($tag->id,$selected ?? [])) checked @endif>
            {{ $tag->name }}
        </label>
        
        @endforeach
    </div>
</form>
@endsection
{{--in_array入れるの中に値があるか見るため--}}
{{--[]値が複数あるときのため--}}


