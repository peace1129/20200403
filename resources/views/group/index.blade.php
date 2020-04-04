@extends('layouts.template')
@section('title')
グループ一覧
@endsection

@section('content')

<div class="container-fluid">

  <div class="row">
    <div class="col-md-4">
      <form action="/group/create" method="get" class="text-right">
        <button type="submit" class="btn btn-primary" name="" formaction="/group/create">新規登録</button>
      </form>
    </div>
  </div>

  <div class="row">
    <table class="table table-striped table-bordered table-primary">
      <tr>
        <th>グループ</th>
        <th>所属数</th>
        <th></th>
      </tr>
      @foreach($gData as $d)
      <tr>
        <td>{{$d->グループ名}}</td>
        <td>{{$d->所属数}}</td>
        <td>
          <div style="display:inline-flex">
            <form action="/group/edit" method="get">
              <button type="submit" class="btn btn-primary" value="{{$d->グループ名}}" name="grpName">編集</button>
            </form>
            <form action="/group/delete" method="get">
              <button type="submit" class="btn btn-primary" value="{{$d->グループ名}}" name="grpName">削除</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection
