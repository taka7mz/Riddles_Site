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
    
    public function PaginateReview($id)
    {
        return $this::where('riddle_id', $id)->orderBy('review_date', 'DESC')->paginate(5);
    }
    
    const CREATED_AT = NULL;
    const UPDATED_AT = NULL;
}
