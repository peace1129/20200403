@extends('layouts.template')
@section('title')
グループ一覧 - 確認画面
@endsection

@section('content')

<p><label class="h2">編集確認画面</label></p>
<form action="/group/editExec" method="POST">
  {{ csrf_field() }}
  グループ名
  {{ Session::get('grpName') }}

  <p class="mb10"></p>
  <button type="submit" class="btn btn-primary">編集確定</button>
</form>
@endsection
