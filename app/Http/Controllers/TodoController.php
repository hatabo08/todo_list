<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTodoRequest; 
use App\Http\Requests\UpdateTodoRequest;


class TodoController extends Controller
{
    /**
     * Todomodelからのデータを$todoに入れてtodo(viewの変数)に渡してindex.blade.phpを表示する
     */
    public function index(Request $request) 
    {    $sort=$request->query('sort', 'created_at');
         
        $todos = Auth::user()->todos()->orderBy($sort, 'asc')->get();dd($todos);
        return view('todos.index', ['todos' => $todos]);
    }//query=?以降の部分を読み込む関数

    /**
     * 新しいタスクを押すとcreate.blade.phpを表示する
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * データを保存する
     */
    public function store(StoreTodoRequest $request)
    {
//ログインしてるユーザーが入力したデータを、自分のデータとして保存してる
        Auth::user()->todos()->create([
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status,
    ]);

       return redirect()->route('todos.index')->with('success','タスクを追加しました！');
    }

    /**
     * $todoからtodo(viewの変数)にデータを渡してshow.blade.phpを表示する
     */
    public function show(Todo $todo)
    {//例えばid1の人のデータが$todoに入る
        return view('todos.show', ['todo' => $todo]);
    }

    /**
     * $todoからtodo(viewの変数)にデータを渡してedit.blade.phpを表示する
     */
    public function edit(Todo $todo)
    {//例えばid1の人のデータが$todoに入る
        return view('todos.edit', ['todo' => $todo]);  
    }//編集

    /**
     * todolistを更新する
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
       

        $todo->update($request->all());

        return redirect()->route('todos.index')->with('success','タスクを更新しました!');
    }

    /**
     * todolistを削除する
     */
    public function destroy(Todo $todo)
    {//例えばid1の人のデータが$todoに入る
        $todo->delete();
        return redirect()->route('todos.index')->with('success','タスクを削除しました！');
    }

}
