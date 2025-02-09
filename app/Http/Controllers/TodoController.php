<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('todos.show', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('todos.edit', ['todo' => $todo]);  
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success','タスクを削除しました！');
    }

    public function updateDescription(Request $request, Todo $todo)
    {
        $request->validate([
            'description' => 'nullable|string|max:500',
        ]);

        $todo->update([
            'description' => $request->description,
        ]);

        return response()->json(['success' => true, 'message' => '説明を更新しました！']);
    }
}
