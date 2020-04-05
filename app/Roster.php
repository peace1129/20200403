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
}
