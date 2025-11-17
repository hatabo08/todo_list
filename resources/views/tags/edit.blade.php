@extends('layout')

@section('content')

@if ($errors->any())
<div style="color:red;">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<form action="{{ route('tags.update', $tag) }}" method="POST">
  @csrf
  @method('PUT')
  <input type="text" name="name" value="{{ $tag->name }}">
  <button type="submit">更新</button>
</form>
<a href="{{ route('tags.index') }}">タグ一覧へ</a>
@endsection