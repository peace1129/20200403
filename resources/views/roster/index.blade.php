@extends('layouts.template')
@section('title')
名簿一覧
@endsection

@section('content')
<form action="/roster/group_search" method="get" id="frm1">
  <p>グループ
      <input name="selectGrp" type="text" class="textField" list="combolist" >
      <button type="submit" class="btn btn-primary" onclick="getText(3)">検索</button>
      <datalist id="combolist">
        @foreach($gList as $list)
          <option value="{{$list->grp_name}}">
        @endforeach
      </datalist>

    <button type="submit" class="btn btn-primary" name="" formaction="/roster/create">新規登録</button>
  </p>
</form>

<div class="sm">
  <table class="table table-striped table-bordered table-primary">
   <tr>
    <th>氏名</th>
    <th>性別</th>
    <th>住所</th>
    <th>グループ</th>
    <th></th>
    </tr>
    @foreach($rData as $data)
    <tr>
      <td>{{$data->lastName}}{{$data->name}}</td>
      <td>
        @if ($data->gender === "1")
          男性
        @else
          女性
        @endif
      </td>
      <td>{{$data->pref}}{{$data->address}}</td>
      <td>
        @if ($data->grp_name === "")
          所属なし
        @else

          {{$data->grp_name}}
        @endif
      </td>
      <td>
        <div style="display:inline-flex">
          <form action="/roster/edit">
            <button type="submit" class="btn btn-primary" value="{{$data->user_id}}" name="userId">編集</button>
          </form>
          <form action="/roster/delete" method="get">
            <button type="submit" class="btn btn-primary" value="{{$data->user_id}}}" name="userId">削除</button>
          </form>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>


@endsection
