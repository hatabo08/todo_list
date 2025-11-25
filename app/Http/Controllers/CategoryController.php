<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Todo;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        return view('categorys.index', ['categorys' => $categorys]);
    }

    public function create()
    {
        return view('categorys.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'カテゴリー名を入力してください。',
        ]);

        Category::create($data);

        return redirect()->route('categorys.index')->with('success', 'カテゴリーを追加しました');
    }

    public function edit(Category $category)
    {
        return view('categorys.edit', ['category' => $category]);
    }

    public function update(Request $request,Category $category)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                ],
        ], [
            'name.required' => 'カテゴリー名を入力してください。',
            ]);

        $category->update($data);

        return redirect()->route('categorys.index')->with('success', 'カテゴリーを更新しました！');
    }

    public function destroy(Category $category)
    {
         Todo::where('category_id', $category->id)->update([
        'category_id' => null,
    ]);
        $category->delete();
        return redirect()->route('categorys.index')->with('success', 'カテゴリーを削除しました');
    }
}
