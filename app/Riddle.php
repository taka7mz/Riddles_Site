<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riddle extends Model
{
    protected $fillable = [
        'title',
        'text',
        'image',
        'movie',
        'hint',
        'answer',
        'commentary',
        'com_img',
        'user_id',
    ];
    public function getPaginateByLimit(int $limit = 5)
    {
        return $this::with('user')->orderBy('updated_at', 'DESC')->paginate($limit);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
