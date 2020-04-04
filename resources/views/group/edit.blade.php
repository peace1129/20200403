@extends('layouts.template')
@section('title')
グループ一覧 - 編集画面
@endsection

@section('content')

<p><label class="h2">編集画面</label></p>
@if ($errors->any())
  <div class="errors">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
<form action="/group/editChk" method="get">

  グループ名
  <input type="text" name="grpName" value="{{ old('grpName',session('grpName')) }}">

  <p class="mb10"></p>
  <button type="submit" class="btn btn-primary">登録確認</button>
</form>
@endsection
