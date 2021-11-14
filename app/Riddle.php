<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Riddle extends Model
{
    use SoftDeletes;
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
        return $this::with('user')->orderBy('created_at', 'DESC')->paginate($limit);
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function correct_users()
    {
        return $this->belongsToMany('App\User','correct_answerers')->withPivot('answer_date');
    }
}
