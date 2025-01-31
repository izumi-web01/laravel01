<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Task;
use App\DataTransferObjects\Collections\TaskCollection;
use DateTime;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    // ログインユーザーの ID を取得
    $user_id = auth()->id();
    if(isset($user_id)){
        $tasks = Task::where('status', false)->where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();// collectionが返る
        $arrays = $tasks->toArray();// 配列に変換
        $tasks = new TaskCollection($arrays);// インスタンス生成
        $tasksFinished = Task::where('status', true)->where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();
        $arraysFinished = $tasksFinished->toArray();
        $tasksFinished = new TaskCollection($arraysFinished);
    }

        return view('tasks.index', [
            'msg' => 'これはtasks.index.blade.phpです',
            'tasks' => isset($user_id) ? $tasks->toArray() : '',// TaskContentのインスタンスの配列を生成
            'tasksFinished' => isset($user_id) ? $tasksFinished->toArray() : '',
        ]);
        
    }

    /**
     * Display a demonstration.
     *
     * @return \Illuminate\Http\Response
     */
    public function sample(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 入力値をDBに保存する
        
        
        $task = new Task;
        // ログインユーザーの ID を取得
        $user_id = auth()->id();
        $task->user_id = $user_id;
        $task_name = $request->input('task_name');
        $task->name = $task_name;
        $task->save();
        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::find($id);
        
        return view('tasks.edit',[
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //　編集　完了
        if($request->status === null){
            $task = Task::find($id);
            $task->name = $request->input('task_name');
            $task->save();
        }else{
            $task = Task::find($id);
            $task->status = true;
            $task->save();
        }
        
        
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::find($id);
        $task->delete();
        return redirect('/tasks');
    }
}
