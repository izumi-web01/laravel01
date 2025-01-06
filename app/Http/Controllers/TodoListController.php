<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\TodoList;//追記
use App\TodoList;//追記

class TodoListController extends Controller
{
    //
    public function index(Request $request)
  {
    $todo_lists = TodoList::all();
 
    return view('todo_list.index', ['todo_lists' => $todo_lists]);
  }
}
