@extends('layouts.template')
@section('title')
名簿一覧
@endsection

@section('content')
  <p><label class="h2">グループ</label>
    <form action="/roster/group_search" method="get" id="frm1">
      <input name="selectGrp" type="text" class="textField" list="combolist" >
      <button type="submit" class="btn btn-primary" onclick="getText(3)">検索</button>
      <datalist id="combolist">
        @foreach($gList as $list)
          <option value="{{$list->グループ名}}">
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
    @foreach($rData as $d)
    <tr>
      <td>{{$d->苗字}}{{$d->名前}}</td>
      <td>
        @if ($d->性別 === "1")
          男性
        @else
          女性
        @endif
      </td>
      <td>{{$d->都道府県}}{{$d->住所}}</td>
      <td>
        @if ($d->グループ名 === "")
          所属なし
        @else

          {{$d->グループ名}}
        @endif
      </td>
      <td>
        <div style="display:inline-flex">
          <form action="/roster/edit">
            <button type="submit" class="btn btn-primary" value="{{$d->user_id}}" name="user_id">編集</button>
          </form>
          <form action="/roster/delete" method="get">
            <button type="submit" class="btn btn-primary" value="{{$d->user_id}}" name="user_id">削除</button>
          </form>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>


@endsection
