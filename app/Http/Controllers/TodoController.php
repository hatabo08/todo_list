<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Tag;


class TodoController extends Controller
{


    public function index(Request $request)
    {

        $sort = $request->query('sort', 'created_at');

        $status = $request->query('filter');

        $query = Todo::query()->with('tags');

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $query->orderBy($sort);

        $todos = $query->paginate(5)->withQueryString();

        return view('todos.index', ['todos' => $todos]);
    }

    /**
     * 新しいタスクを押すとcreate.blade.phpを表示する
     */
    public function create()
    {
        $tags = Tag::all();
        return view('todos.create', ['tags' => $tags]);
    }

    /**
     * データを保存する
     */
    public function store(StoreTodoRequest $request)
    {
        //''title'=カラム名 title=bladeのname
        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $todo->tags()->sync($request->input('tags', []));
        //sync() は、多対多（Many-to-Many）リレーションの中間テーブルを更新するメソッド
        return redirect()->route('todos.index')->with('success', 'todoを追加しました');
    }

    /**
     * $todoからtodo(viewの変数)にデータを渡してshow.blade.phpを表示する
     */
    public function show(Todo $todo)
    { //例えばid1の人のデータが$todoに入る
        $todo->load('tags');
        //loadは必要な時にデータをとる
        $tags = Tag::all();

        return view('todos.show', ['todo' => $todo, 'tags' => $tags]);
    }

    /**
     * $todoからtodo(viewの変数)にデータを渡してedit.blade.phpを表示する
     */
    public function edit(Todo $todo)
    { //例えばid1の人のデータが$todoに入る
        $todo->load('tags');
        $tags = Tag::all();
        //$selected = $todo->tags()->pluck('tags.id')->toArray();
        return view('todos.edit', ['todo' => $todo, 'tags' => $tags]);
    }

    /**
     * todolistを更新する
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        $todo->tags()->sync($request->input('tags', []));

        return redirect()->route('todos.index')->with('success', 'todoを更新しました');
    }

    /**
     * todolistを削除する
     */
    public function destroy(Todo $todo)
    { //例えばid1の人のデータが$todoに入る
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'todoを削除しました');
    }

    public function attachTag(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'tag_id' => ['required', 'integer', 'exists:tags,id'],
        ]);

        $todo->tags()->syncWithoutDetaching([$data['tag_id']]);
//
        return back()->with('success', 'タグを追加しました！');
    }

    public function detachTag(Todo $todo, Tag $tag)
    {
        $todo->tags()->detach($tag->id);

        return back()->with('success', 'タグを外しました！');
    }
}
