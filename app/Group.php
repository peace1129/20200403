<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
  // protected $primaryKey = 'グループ名';
  protected $table = 'groups';

  protected $fillable = [
    'グループ名',
  ];

  // グループテーブルをグループ名でGroupByしたデータの取得
  public function getGrpCnt()
  {
    $GrpCnt = DB::select('SELECT グループ名,SUM(所属数) as 所属数 FROM ('
                        .'(SELECT グループ名,COUNT(*) as 所属数 FROM rosters GROUP BY グループ名)'
                        .'UNION'
                        .'( SELECT グループ名,0 as 所属数 FROM groups GROUP BY グループ名) ) as foo '
                        .'WHERE グループ名 <> \'\' '
                        .'GROUP BY グループ名 '
                        .'ORDER BY グループ名');

    // $roster = DB::table('rosters')
    //               ->selectRaw('グループ名, count(*) as 所属数')
    //               ->groupBy('グループ名');
    //
    //
    // $result = DB::table('groups')
    //         ->selectRaw('グループ名, 0 as 所属数')
    //         ->union($roster)
    //         ->whereNotNull('グループ名')
    //         ->get();
    //
    //
    //
    // dd($result);

    return $GrpCnt;
  }

  // グループテーブルの指定グループ名のレコードを削除
  public function deleteGrp($grpName)
  {
    Group::find($grpName)->delete();
  }
}
