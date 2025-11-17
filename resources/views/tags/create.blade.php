@extends('layout')

@section('content')
<h1>タグ作成</h1>

@if ($errors->any())
<div style="color:red;">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('tags.store') }}" method="POST">
  @csrf
  <label>タグ名</label>
  <input type="text" name="name" value="{{ old('name') }}">
  <button type="submit">追加</button>
</form>

<a href="{{ route('tags.index') }}">タグ一覧へ</a>
@endsection