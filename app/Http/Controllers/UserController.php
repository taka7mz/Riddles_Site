<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function mypage(User $user)
    {
        return view('users/mypage')->with(['own_riddle' => $user->getOwnPaginateByLimit()]);
    }
    public function user_riddles(User $user)
    {
        
        return view('users/user_index')->with(['user_riddle' => $user->getUserPaginateByLimit($user->id)]);
    }
    
}
