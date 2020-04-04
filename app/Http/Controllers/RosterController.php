<?php

namespace App\Http\Controllers;

use App\Roster;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

// 名簿管理クラス
class RosterController extends Controller
{

    // 名簿一覧表示時処理
    public function index(){
      $roster = new Roster();
      $rData = $roster->getRosterData();
      $gList = $roster->getGroupList();

      return view('roster.index',[
        'rData'=>$rData,
        'gList'=>$gList
      ]);
    }


    // 名簿一覧グループ検索ボタン押下時処理
    public function group_search(Request $request){
      $grp = $request->input('selectGrp');
      $roster = new Roster();
      $gList = $roster->getGroupList();

      if (is_null($grp)){
        $rData = $roster->getRosterData();

      }else{
        $rData = $roster->getSelectGrpList($grp);

      }

      return view('roster.index',[
        'rData'=>$rData,
        'gList'=>$gList
      ]);
    }


    // 名簿一覧新規登録ボタン押下時処理
    public function create(){
      $roster = new Roster();
      $gList = $roster->getGroupList();

      //都道府県取得APIの読み込み
      $prefList = json_decode(file_get_contents('http://geoapi.heartrails.com/api/json?method=getPrefectures'), true);
      $prefCollection = collect($prefList);

      return view('roster.create',[
        'gList'=>$gList,
        'prefCollection'=>$prefCollection
      ]);
    }


    // 名簿一覧の新規登録画面に名簿情報が入力された状態で登録ボタンが押下された場合の処理
    public function createChk(Request $request){
      $request->validate([
        'middleName'      => 'required|max:10',
        'name'            => 'required|max:10',
        'gender'          => 'required',
        'pref'            => 'required',
        'address'         => 'required'
      ]);

      $request->session()->put('middleName', $request->input('user_id'));
      $request->session()->put('middleName', $request->input('middleName'));
      $request->session()->put('name', $request->input('name'));
      $request->session()->put('gender', $request->input('gender'));
      $request->session()->put('address', $request->input('address'));
      $request->session()->put('pref', $request->input('pref'));
      $request->session()->put('grpName', $request->input('grpName'));

       return view('roster.create_exec');
    }


    // 名簿一覧追加処理
    public function createExec(Request $request){
      $roster = new Roster();

      $roster->create([
        '苗字' => $request->session()->pull('middleName'),
        '名前' => $request->session()->pull('name'),
        '性別' => $request->session()->pull('gender'),
        '住所' => $request->session()->pull('address'),
        '都道府県' => $request->session()->pull('pref'),
        'グループ名' => $request->session()->pull('grpName'),
      ]);

      $rData = $roster->getRosterData();
      $gList = $roster->getGroupList();

      return view('roster.index',[
        'rData' => $rData,
        'gList' => $gList]);
    }


    // 名簿一覧編集ボタン押下時処理
    public function edit(Request $request){

      $request->session()->put('user_id', $request->input('user_id'));
      $userId = $request->input('user_id');
      $roster = new Roster();
      $uData = $roster->getUserData($userId);
      $gList = $roster->getGroupList();

      $prefList = json_decode(file_get_contents('http://geoapi.heartrails.com/api/json?method=getPrefectures'), true);
      $prefCollection = collect($prefList);

      return view('roster.edit',[
        'uData' => $uData,
        'gList' => $gList,
        'prefCollection'=>$prefCollection
      ]);
    }


    // 名簿一覧編集ボタン押下時処理
    public function editChk(Request $request){
      $request->validate([
        'middleName'      => 'required|max:10',
        'name'            => 'required|max:10',
        'gender'          => 'required',
        'pref'            => 'required',
        'address'         => 'required'
      ]);

      $request->session()->put('middleName', $request->input('middleName'));
      $request->session()->put('name', $request->input('name'));
      $request->session()->put('gender', $request->input('gender'));
      $request->session()->put('address', $request->input('address'));
      $request->session()->put('pref', $request->input('pref'));
      $request->session()->put('grpName', $request->input('grpName'));

      return view('roster.edit_exec');
    }

    // 名簿一覧編集処理
    public function editExec(Request $request){
      $roster = new Roster();
      $userId = $request->session()->pull('user_id');

      Roster::where('user_id',$userId )
          ->update(['苗字' => $request->session()->pull('middleName'),
                    '名前' => $request->session()->pull('name'),
                    '性別' => $request->session()->pull('gender'),
                    '都道府県' => $request->session()->pull('pref'),
                    '住所' => $request->session()->pull('address'),
                    'グループ名' => $request->session()->pull('grpName')
                  ]);

      return view('roster.completed');
    }

    // 名簿一覧削除ボタン押下時処理
    public function delete(Request $request){
      $roster = new Roster();
      $request->session()->put('user_id', $request->input('user_id'));
      $uData = $roster->getUserData($request->input('user_id'));

      return view('roster.delete_exec',['uData' => $uData]);
    }

    // 名簿削除確定処理
    public function deleteExec(Request $request){
      $roster = new Roster();
      $roster->deleteUserId($request->session()->pull('user_id'));

      return view('roster.completed');
    }
}
