<?php

namespace App\Http\Controllers;

use Request;
use App\Group;

class GroupController extends Controller
{
  // グル―プ一覧表示時処理
  public function index(){
    $group = new Group();
    $gData = $group->getGrpCnt();

    return view('group.index',['gData' => $gData]);
  }

  // 新規グループ作成ボタン押下時処理
  public function create(){

    return view('group.create');
  }

  // グループ名重複チェックボタン押下時処理
  public function createChk(){
    Request::validate([
      'grpName'      => 'required|max:10|unique:groups,grp_name'
    ]);

    Request::session()->put('grpName', Request::input('grpName'));

    return view('group.create_exec');
  }

  // 新規グループ名作成処理
  public function createExec(){
      Group::create([
        'grp_name' => Request::session()->get('grpName')
      ]);

      $group = new Group();
      $gData = $group->getGrpCnt();

      return view('group.index',['gData' => $gData]);
  }

  // 指定グループ編集ボタン押下時処理
  public function edit(){
      Request::session()->put('oldGrpName', Request::input('grpName'));


      return view('group.edit');
  }

  // グループ編集ボタン押下時処理
  public function editChk(){
    Request::validate([
      'grpName'      => 'required|max:10|unique:groups,grp_name'
    ]);
    Request::session()->put('NewgrpName', Request::input('grpName'));


    return view('group.edit_exec');
  }

  // グループ編集確定ボタン押下時処理
  public function editExec(){
    dd(Request::session()->get('grpName'));
    Group::where('grp_name', Request::session()->pull('grpName'))
        ->update(['grp_name' => Request::session()->pull('grpName')
                ]);

    return view('group.completed');
  }

  // 指定グループ削除ボタン押下時処理
  public function delete(){
    Request::session()->put('grpName', Request::input('grpName'));

    return view('group.delete');
  }

  // グループ削除確定ボタン押下時処理
  public function deleteExec(){
    Group::find(Request::session()->pull('grpName'))->delete();

    return view('result.completed');
  }
}
