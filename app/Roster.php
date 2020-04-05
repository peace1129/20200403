<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roster extends Model
{
  protected $primaryKey = 'user_id';
  protected $table = 'rosters';

  protected $fillable = [
    'lastName','firstName', 'gender', 'pref', 'address', 'grp_name'
  ];
}
