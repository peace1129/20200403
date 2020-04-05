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
      $gList = Group::get('グループ名');

      return view('roster.index',[
        'rData'=>$rData,
        'gList'=>$gList
      ]);
    }


    // 名簿一覧グループ検索ボタン押下時処理
    public function group_search(){
      $grp = Request::input('selectGrp');
      $gList = Group::get('グループ名');

      if (is_null($grp)){
        $rData = Roster::all();
      }else{
        $rData = Roster::where('グループ名', $grp)->get();
      }

      return view('roster.index',[
        'rData'=>$rData,
        'gList'=>$gList
      ]);
    }


    // 名簿一覧新規登録ボタン押下時処理
    public function create(){
      $gList = Group::get('グループ名');

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
        'middleName'      => 'required|max:10',
        'name'            => 'required|max:10',
        'gender'          => 'required',
        'pref'            => 'required',
        'address'         => 'required'
      ]);

      Request::session()->put('user_id', Request::input('user_id'));
      Request::session()->put('middleName', Request::input('middleName'));
      Request::session()->put('name', Request::input('name'));
      Request::session()->put('gender', Request::input('gender'));
      Request::session()->put('address', Request::input('address'));
      Request::session()->put('pref', Request::input('pref'));
      Request::session()->put('grpName', Request::input('grpName'));

       return view('roster.create_exec');
    }


    // 名簿一覧追加処理
    public function createExec(){
      Roster::create([
        '苗字' => Request::session()->pull('middleName'),
        '名前' => Request::session()->pull('name'),
        '性別' => Request::session()->pull('gender'),
        '住所' => Request::session()->pull('address'),
        '都道府県' => Request::session()->pull('pref'),
        'グループ名' => Request::session()->pull('grpName'),
      ]);

      $rData = $roster->getRosterData();
      $gList = $roster->getGroupList();

      return view('roster.index',[
        'rData' => $rData,
        'gList' => $gList]);
    }


    // 名簿一覧編集ボタン押下時処理
    public function edit(){
      Request::session()->put('user_id', Request::input('user_id'));

      $uData = Roster::where('user_id', Request::input('user_id'))->first();
      $gList = Group::get('グループ名');

      $prefList = json_decode(file_get_contents('http://geoapi.heartrails.com/api/json?method=getPrefectures'), true);
      $prefCollection = collect($prefList);

      return view('roster.edit',[
        'uData' => $uData,
        'gList' => $gList,
        'prefCollection'=>$prefCollection
      ]);
    }


    // 名簿一覧編集ボタン押下時処理
    public function editChk(){
      Request::validate([
        'middleName'      => 'required|max:10',
        'name'            => 'required|max:10',
        'gender'          => 'required',
        'pref'            => 'required',
        'address'         => 'required'
      ]);

      Request::session()->put('middleName', Request::input('middleName'));
      Request::session()->put('name', Request::input('name'));
      Request::session()->put('gender', Request::input('gender'));
      Request::session()->put('address', Request::input('address'));
      Request::session()->put('pref', Request::input('pref'));
      Request::session()->put('grpName', Request::input('grpName'));

      return view('roster.edit_exec');
    }

    // 名簿一覧編集処理
    public function editExec(){
      Roster::where('user_id', Request::session()->pull('user_id'))
          ->update(['苗字' => Request::session()->pull('middleName'),
                    '名前' => Request::session()->pull('name'),
                    '性別' => Request::session()->pull('gender'),
                    '都道府県' => Request::session()->pull('pref'),
                    '住所' => Request::session()->pull('address'),
                    'グループ名' => Request::session()->pull('grpName')
                  ]);

      return view('roster.completed');
    }

    // 名簿一覧削除ボタン押下時処理
    public function delete(){
      Request::session()->put('user_id', Request::input('user_id'));
      $uData = Roster::where('user_id', Request::input('user_id'))->first();

      return view('roster.delete_exec',['uData' => $uData]);
    }

    // 名簿削除確定処理
    public function deleteExec(){
      Roster::find(Request::session()->pull('user_id'))->delete();

      return view('roster.completed');
    }
}
