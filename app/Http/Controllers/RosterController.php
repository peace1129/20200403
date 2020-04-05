<?php

namespace App\Http\Controllers;

use App\Roster;
use App\Group;
use Request;
use Illuminate\Support\Collection;

// 名簿管理クラス
class RosterController extends Controller
{

    // 名簿一覧表示時処理
    public function index(){
      $rData = Roster::all();
      $gList = Group::get('grp_name')->all();
      

      return view('roster.index',[
        'rData'=>$rData,
        'gList'=>$gList
      ]);
    }


    // 名簿一覧グループ検索ボタン押下時処理
    public function group_search(){
      $selectGrp = Request::input('selectGrp');
      $gList = Group::get('grp_name');

      if (is_null($selectGrp)){
        $rData = Roster::all();
      }else{
        $rData = Roster::where('grp_name', $selectGrp)->get();
      }

      return view('roster.index',[
        'rData'=>$rData,
        'gList'=>$gList
      ]);
    }


    // 名簿一覧新規登録ボタン押下時処理
    public function create(){
      $gList = Group::get('grp_name');

      //都道府県取得APIの読み込み
      $prefList = json_decode(file_get_contents('http://geoapi.heartrails.com/api/json?method=getPrefectures'), true);
      $prefCollection = collect($prefList);

      return view('roster.create',[
        'gList'=>$gList,
        'prefCollection'=>$prefCollection
      ]);
    }


    // 名簿一覧の新規登録画面に名簿情報が入力された状態で登録ボタンが押下された場合の処理
    public function createChk(){
      Request::validate([
        'lastName'        => 'required|max:10',
        'firstName'       => 'required|max:10',
        'gender'          => 'required',
        'pref'            => 'required',
        'address'         => 'required',
        'grpName'         => 'exists:groups,grp_name'
      ]);

      Request::session()->put('userId', Request::input('userId'));
      Request::session()->put('lastName', Request::input('lastName'));
      Request::session()->put('firstName', Request::input('firstName'));
      Request::session()->put('gender', Request::input('gender'));
      Request::session()->put('address', Request::input('address'));
      Request::session()->put('pref', Request::input('pref'));
      Request::session()->put('grpName', Request::input('grpName'));

       return view('roster.create_exec');
    }


    // 名簿一覧追加処理
    public function createExec(){
      Roster::create([
        'lastName' =>  Request::session()->pull('lastName'),
        'firstName' => Request::session()->pull('firstName'),
        'gender' => Request::session()->pull('gender'),
        'pref' => Request::session()->pull('pref'),
        'address' => Request::session()->pull('address'),
        'grp_name' => Request::session()->pull('grp_name')
      ]);

      $rData = Roster::all();
      $gList = Group::get('grp_name');

      return view('roster.index',[
        'rData' => $rData,
        'gList' => $gList]);
    }


    // 名簿一覧編集ボタン押下時処理
    public function edit(){
      Request::session()->put('userId', Request::input('userId'));
      $rData = Roster::where('user_id', Request::input('userId'))->first();
      $gList = Group::get('grp_name');

      $prefList = json_decode(file_get_contents('http://geoapi.heartrails.com/api/json?method=getPrefectures'), true);
      $prefCollection = collect($prefList);


      return view('roster.edit',[
        'rData' => $rData,
        'gList' => $gList,
        'prefCollection'=>$prefCollection
      ]);
    }


    // 名簿一覧編集ボタン押下時処理
    public function editChk(){
      Request::validate([
        'lastName'        => 'required|max:10',
        'firstName'       => 'required|max:10',
        'gender'          => 'required',
        'pref'            => 'required',
        'address'         => 'required',
        'grpName'         => 'exists:groups,grp_name'
      ]);

      Request::session()->put('lastName', Request::input('lastName'));
      Request::session()->put('firstName', Request::input('firstName'));
      Request::session()->put('gender', Request::input('gender'));
      Request::session()->put('address', Request::input('address'));
      Request::session()->put('pref', Request::input('pref'));
      Request::session()->put('grpName', Request::input('grpName'));

      return view('roster.edit_exec');
    }

    // 名簿一覧編集処理
    public function editExec(){
      Roster::where('user_id', Request::session()->pull('userId'))
          ->update(['lastName' => Request::session()->pull('lastName'),
                    'firstName' => Request::session()->pull('firstName'),
                    'gender' => Request::session()->pull('gender'),
                    'pref' => Request::session()->pull('pref'),
                    'address' => Request::session()->pull('address'),
                    'grp_name' => Request::session()->pull('grpName')
                  ]);

      return view('result.completed');
    }

    // 名簿一覧削除ボタン押下時処理
    public function delete(){
      Request::session()->put('userId', Request::input('userId'));
      $rData = Roster::where('user_id', Request::input('userId'))->first();

      return view('roster.delete_exec',['rData' => $rData]);
    }

    // 名簿削除確定処理
    public function deleteExec(){
      Roster::find(Request::session()->pull('userId'))->delete();
            
      return view('result.completed');
    }
}
