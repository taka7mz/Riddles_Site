<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'comment', 'star','user_id', 'riddle_id',
    ];
    
    protected $table = 'reviews';
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
}
