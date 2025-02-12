<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Task;
use App\DataTransferObjects\Collections\TaskCollection;
use DateTime;
use App\Traits\AuthTrait;


class TaskController extends Controller
{

    use AuthTrait;

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loginUser = $this->getLoginUser(); // Traits のメソッドを呼び出す

    if($loginUser){
        $tasks = Task::where('status', false)->where('user_id', $loginUser->id)->orderBy('updated_at', 'desc')->get();// collectionが返る
        $arrays = $tasks->toArray();// 配列に変換
        $tasks = new TaskCollection($arrays);// インスタンス生成
        $tasksFinished = Task::where('status', true)->where('user_id', $loginUser->id)->orderBy('updated_at', 'desc')->get();
        $arraysFinished = $tasksFinished->toArray();
        $tasksFinished = new TaskCollection($arraysFinished);
    }

        return view('tasks.index', [
            'msg' => 'これはtasks.index.blade.phpです',
            'tasks' => isset($loginUser) ? $tasks->toArray() : '',// TaskContentのインスタンスの配列を生成
            'tasksFinished' => isset($loginUser) ? $tasksFinished->toArray() : '',
        ]);
        
    }

    /**
     * Display a demonstration.
     *
     * @return \Illuminate\Http\Response
     */
    public function sample(Request $request){
        // ゲスト ID を取得
        if (! $request->session()->has('guest_id')) {
            $guest_id = Str::uuid(); // UUID を生成
            $request->session()->put('guest_id', $guest_id); // セッションに保存
        } else {
            $guest_id = $request->session()->get('guest_id');
        }
    
        $tasks = Task::where('status', false)->where('guest_id', $guest_id)->orderBy('updated_at', 'desc')->get();// collectionが返る
        $arrays = $tasks->toArray();// 配列に変換
        $tasks = new TaskCollection($arrays);// インスタンス生成
        $tasksFinished = Task::where('status', true)->where('guest_id', $guest_id)->orderBy('updated_at', 'desc')->get();
        $arraysFinished = $tasksFinished->toArray();
        $tasksFinished = new TaskCollection($arraysFinished);
    // }

        return view('tasks.sample', [
            'msg' => 'これはtasks.sample.blade.phpです',
            'tasks' => $tasks->toArray(),// TaskContentのインスタンスの配列を生成
            'tasksFinished' => $tasksFinished->toArray(),
            'guest_id' => $guest_id
        ]);
        
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
        if (auth()->check()) {
            $task->user_id = auth()->id();
        } else {
            // ゲストユーザーの場合
            $task->guest_id = $request->input('guest_id'); // ゲストIDを保存
        }
        $task_name = $request->input('task_name');
        $task->name = $task_name;
        $task->save();
        if (auth()->check()){
            $redirectTo = '/tasks';
        }else{
            $redirectTo = '/sample';
        }
        return redirect($redirectTo);
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
