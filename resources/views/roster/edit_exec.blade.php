@extends('layouts.template')
@section('title')
名簿一覧 - 確認画面
@endsection

@section('content')

<p><label class="h2">編集確認画面</label></p>
<p>以上の情報で編集を行います。</p>

<form action="/roster/editExec" method="POST">
{{ csrf_field() }}
  <div class="container-fluid">
    <div class="row md-5">
      <div class="col-md-1">
        <label>氏名</lavel>
      </div>
      <div>
        {{ Session::get('middleName') }}
        {{ Session::get('name') }}
      </div>
    </div>

    <div class="row">
      <div class="col-md-1">
        <label>性別</lavel>
      </div>
      <div>
        @if (Session::get('gender')  === "1")
          男性
        @else
          女性
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-md-1">
        <label>都道府県</lavel>
      </div>
      <div>
        {{ Session::get('pref') }}
      </div>
    </div>

    <div class="row">
      <div class="col-md-1">
        <label>住所</lavel>
      </div>
      {{ Session::get('address') }}
    </div>

    <div class="row">
      <div class="col-md-1">
        <label>グループ</lavel>
      </div>
      {{ Session::get('grpName') }}
    </div>

  </div>
  <p></p>
<button type="submit" class="btn btn-primary">編集確定</button>
</form>

@endsection
