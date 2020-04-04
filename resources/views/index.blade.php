@extends('layouts.template')
@section('title')
メニュー
@endsection

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col h2 sm">
      <p>名簿管理</p>
      <p><a href="/roster/index">・名簿一覧</a></p>
      <p><a href="/roster/create">・新規登録</a></p>
    </div>
    <div class="col h2">
      <p>グループ管理</p>
      <p><a href="/group/index">・グループ一覧</a></p>
      <p><a href="/group/create">・新規登録</a></p>
    </div>
  </div>
</div>
@endsection
