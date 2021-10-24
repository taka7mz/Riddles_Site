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
    ];
    public function getPaginateByLimit(int $limit = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit);
    }
}
