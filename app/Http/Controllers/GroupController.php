<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
  public function createChk(Request $request){
    $request->validate([
      'grpName'      => 'required|max:10|unique:groups,グループ名'
    ]);

    $request->session()->put('grpName', $request->input('grpName'));

    return view('group.create_exec');
  }

  // 新規グループ名作成処理
  public function createExec(Request $request){
      $group = new Group();
      $group->create([
        'グループ名' => $request->session()->get('grpName')
      ]);

      $gData = $group->getGrpCnt();

      return view('group.index',['gData' => $gData]);
  }

  //
  public function edit(Request $request){
      $request->session()->put('grpName', $request->input('grpName'));


      return view('group.edit');
  }


  public function editChk(Request $request){
    $request->validate([
      'grpName'      => 'required|max:10|unique:groups,グループ名'
    ]);
    $request->session()->put('grpName', $request->input('grpName'));

    return view('group.edit_exec');
  }

  public function editExec(Request $request){
    $group = new Group();
    $group->create([
      'グループ名' => $request->session()->get('grpName')
    ]);

    return view('group.completed');
  }

  public function delete(Request $request){
    $request->session()->put('grpName', $request->input('grpName'));

    return view('group.delete');
  }

  public function deleteExec(Request $request){
    $group = new Group();
    $group->deleteGrp($request->session()->get('grpName'));


    return view('group.completed');
  }

}
