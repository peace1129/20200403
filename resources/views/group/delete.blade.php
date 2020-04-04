@extends('layouts.template')
@section('title')
グループ一覧 - 削除確認画面
@endsection

@section('content')

<p><label class="h2">削除確認画面</label></p>
<form action="/group/deleteExec" method="POST">
  {{ csrf_field() }}
  グループ名
  {{ Session::get('grpName') }}

  <p class="mb10"></p>
  <button type="submit" class="btn btn-primary">削除</button>
</form>
@endsection
