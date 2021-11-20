<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Riddle;
use App\Review;
use App\User;
use Auth;

class ReviewController extends Controller
{
    public function review(Riddle $riddle)
    {
        return view('/riddles/review')->with(['riddle' => $riddle]);
    }
    
    public function register(Riddle $riddle, Request $request, Review $review)
    {
        $input = $request['review'];
        $input['riddle_id'] = $riddle->id;
        $input['user_id'] = Auth::id();
        $review->fill($input)->save();
        return redirect(route('riddle.detail', [
            'riddle' => $riddle->id
        ]));
        
    }
    
    public function review_index(Review $review, Riddle $riddle)
    {
        return view('/riddles/review_index')->with([
            'reviews' => $review->PaginateReview($riddle->id),
            'riddle' => $riddle
            ]);
    }
}
