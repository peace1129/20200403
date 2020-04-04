<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roster extends Model
{
  protected $primaryKey = 'user_id';
  protected $table = 'rosters';

  protected $fillable = [
    '苗字','名前', '性別', '都道府県', '住所', 'グループ名',
  ];

  // 名簿一覧テーブル表示用データの取得
  public function getRosterData()
  {
    $data = DB::table($this->table)->get();
    return $data;
  }

  // グループ名取得
  public function getSelectGrpList($grp){
    $data = DB::table($this->table)->where('グループ名', $grp)->get();

    return $data;
  }

  // 重複したグループを削除したデータの取得
  public function getGroupList(){
    $data = DB::table('groups')->distinct('グループ名')->get();
    return $data;
  }

  // 指定したuserIdのレコードを取得
  public function getUserData($userId)
  {
    $data = DB::table($this->table)->where('user_id', $userId)->first();
    return $data;
  }

  // 名簿一覧テーブルの指定userIdのレコードを削除
  public function deleteUserId($userId)
  {
    Roster::find($userId)->delete();
  }
}
