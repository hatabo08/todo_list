<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Models\Tag;
use App\Models\Category;


class TodoController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->query('sort', 'created_at');

        $selectedStatus = $request->query('filter', []); 

        $selectedTagIds = $request->input('tags', []);

        
        $selectedCategoryIds = $request->input('categorys', []);

        $query = Todo::query()->with(['tags', 'category']);

        if (!empty($selectedStatus)) {
            $query->whereIn('status', $selectedStatus);
        }

        if (!empty($selectedTagIds)) {
            $query->whereHas('tags', function ($q) use ($selectedTagIds) {
                $q->whereIn('tags.id', $selectedTagIds);
            });
        }

        if (!empty($selectedCategoryIds)) {
            $query->whereIn('category_id', $selectedCategoryIds);
        }

        $query->orderBy($sort);

        $todos = $query->paginate(5)->withQueryString();

        $tags = Tag::orderBy('name')->get();
        $categorys = Category::orderBy('name')->get();

        return view('todos.index', [
            'todos' => $todos,
            'tags' => $tags,
            'categorys' => $categorys,
            'selectedStatus' => $selectedStatus,
            'selectedTagIds' => $selectedTagIds,
            'selectedCategoryIds' => $selectedCategoryIds,
            'sort' => $sort,
        ]);
    }


    public function create()
    {
        $tags = Tag::all();
        $categorys = Category::all();
        return view('todos.create', ['tags' => $tags, 'categorys' => $categorys]);
    }


    public function store(StoreTodoRequest $request)
    {
        //''title'=カラム名 title=bladeのname
        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        $todo->tags()->sync($request->input('tags', []));
        //sync() は、多対多（Many-to-Many）リレーションの中間テーブルを更新するメソッド
        return redirect()->route('todos.index')->with('success', 'todoを追加しました');
    }

    public function show(Todo $todo)
    {
        $todo->load('tags',category);
        //loadは事前にデータをとる
        $tags = Tag::all();

        $categorys = Category::all();

        return view('todos.show', ['todo' => $todo, 'tags' => $tags, 'categorys' => $categorys]);
    }


    public function edit(Todo $todo)
    {
        $todo->load('tags', 'category');
        $tags = Tag::all();
        $categorys = Category::all();
        $selected = $todo->tags()->pluck('tags.id')->toArray();
        return view('todos.edit', ['todo' => $todo, 'tags' => $tags, 'categorys' => $categorys, 'selected' => $selected,]);
    }

    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        $todo->tags()->sync($request->input('tags', []));

        return redirect()->route('todos.index')->with('success', 'todoを更新しました');
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'todoを削除しました');
    }
}
