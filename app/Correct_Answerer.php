<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Correct_Answerer extends Model
{
    protected $fillable = [
        'user_id','riddle_id'
    ];
    
    protected $table = 'correct_answerers';
    
}
