<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Todomodelからのデータを$todoに入れてtodo(viewの変数)に渡してindex.blade.phpを表示する
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }

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
    public function store(Request $request)
    {
       $request->validate([ 
        'title' => 'required',
        'status' => 'required|in:未着手,進行中,完了',
       ]);

       Todo::create($request->all());

       return redirect()->route('todos.index')->with('success','タスクを追加しました！');
    }

    /**
     * $todoからtodo(viewの変数)にデータを渡してshow.blade.phpを表示する
     */
    public function show(Todo $todo)
    {
        return view('todos.show', ['todo' => $todo]);
    }

    /**
     * $todoからtodo(viewの変数)にデータを渡してedit.blade.phpを表示する
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', ['todo' => $todo]);  
    }

    /**
     * todolistを更新する
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:未着手,進行中,完了', 
        ]);

        $todo->update($request->all());

        return redirect()->route('todos.index')->with('success','タスクを更新しました!');
    }

    /**
     * todolistを削除する
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success','タスクを削除しました！');
    }

}
