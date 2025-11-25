<?php
//todoの情報をとる
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// title,description,status,user_idの内容を変更できる
class Todo extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'category_id',
    ];
    public function user()
    { // このToDoは誰のものかをLaravelに教えてる
        return $this->belongsTo(User::class);
    }

    // app/Models/Todo.php

    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'tag_todo')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
