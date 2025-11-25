@extends('layout')

@section('content')
<h1>カテゴリー作成</h1>

@if ($errors->any())
<div style="color:red;">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('categorys.store') }}" method="POST">
  @csrf
  <label>カテゴリー名</label>
  <input type="text" name="name" value="{{ old('name') }}">
  <button type="submit">追加</button>
</form>

<a href="{{ route('categorys.index') }}"><button type="button">カテゴリー一覧へ</button></a>
@endsection