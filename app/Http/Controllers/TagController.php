<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    public function index()
    {
        $tag = Tag::all();
        return view('tags.index', ['tag' => $tag]);
    }

    // 作成フォーム
    public function create()
    {
        return view('tags.create');
    }

    // 保存処理
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
        ], [
            'name.required' => 'タグ名を入力してください。',
            ]);

        Tag::create($data);

        return redirect()->route('tags.index')->with('success', 'タグを追加しました');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'タグを削除しました');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', ['tag' => $tag]);
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                ],
        ], [
            'name.required' => 'タグ名を入力してください。',
            ]);

        $tag->update($data);

        return redirect()->route('tags.index')->with('success', 'タグを更新しました！');
    }
}
