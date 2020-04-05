<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
  protected $primaryKey = 'grp_name';
  public $incrementing = false;
  protected $table = 'groups';

  protected $fillable = [
    'grp_name',
  ];

  // グループテーブルをグループ名でGroupByしたデータの取得
  public function getGrpCnt()
  {
    $GrpCnt = DB::select('SELECT grp_name,SUM(grp_count) as grp_count FROM ('
                        .'(SELECT grp_name,COUNT(*) as grp_count FROM rosters GROUP BY grp_name)'
                        .'UNION'
                        .'( SELECT grp_name,0 as grp_count FROM groups GROUP BY grp_name) ) as foo '
                        .'WHERE grp_name <> \'\' '
                        .'GROUP BY grp_name '
                        .'ORDER BY grp_name');

    // $roster = DB::table('rosters')
    //               ->selectRaw('グループ名, count(*) as grp_count')
    //               ->groupBy('グループ名');
    //
    //
    // $result = DB::table('groups')
    //         ->selectRaw('グループ名, 0 as grp_count')
    //         ->union($roster)
    //         ->whereNotNull('グループ名')
    //         ->get();
    //
    //
    //
    // dd($result);

    return $GrpCnt;
  }
}
