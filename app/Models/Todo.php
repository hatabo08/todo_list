<?php
//todoの情報をとる
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// title,description,status,user_idの内容を変更できる
class Todo extends Model
{
    use HasFactory;
    // TODO:fillableの逆を使う
    protected $guarded = [
        'id',
    ];
    public function user()
    {// このToDoは誰のものかをLaravelに教えてる
        return $this->belongsTo(User::class);
    }

}
