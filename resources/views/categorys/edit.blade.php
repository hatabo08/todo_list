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
<form action="{{ route('categorys.update', $category) }}" method="POST">
  @csrf
  @method('PUT')
  <input type="text" name="name" value="{{ $category->name }}">
  <button type="submit">更新</button>
</form>
<a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧へ</button></a>
@endsection