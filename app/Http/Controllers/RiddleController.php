<?php

namespace App\Http\Controllers;

use App\Riddle;
use Illuminate\Http\Request;
use App\Http\Requests\RiddleRequest;
use App\Correct_Answerer;
use App\Review;
use App\User;
use Auth;

class RiddleController extends Controller
{
    public function index(Riddle $riddle)
    {
        return view('riddles/index')->with(['riddles' => $riddle->getPaginateByLimit()]);
    }
    
    public function show(Riddle $riddle, Review $review, $star = 0, $count = 0)
    {
        $reviewer = $review::where('user_id', Auth::Id())->where('riddle_id', $riddle->id)->first();
        $riddle_reviews = $review::where('riddle_id', $riddle->id)->get();
        $latest_review = $review::where('riddle_id', $riddle->id)->orderBy('review_date', 'DESC')->first();
        foreach($riddle_reviews as $riddle_review){
            $star += $riddle_review->star;
            $count++;
        }
        if($count === 0){
            $average = -1;
        }
        else{
            $average = $star/$count;
        }
        return view('riddles/show')->with([
            'riddle' => $riddle, 
            'reviewer' => $reviewer, 
            'average' => $average, 
            'latest_review' => $latest_review,
            'status' => NULL
        ]);
    }
    
    public function create()
    {
        return view('riddles/create');
    }
    
    public function store(Riddle $riddle, RiddleRequest $request)
    {
        $input = $request['riddle'];
        if(!empty($request->riddle['image'])){
            $file_name = $request->riddle['image']->getClientOriginalName();
            $request->riddle['image']->storeAs('public/riddle_img',$file_name);
            $input['image'] = $file_name;
        }
        $input += [ 'user_id' => $request->user()->id ];
        $riddle->fill($input)->save();
        return redirect('/users/mypage');
    }
    
    public function delete(Riddle $riddle)
    {
        $riddle->delete();
        return redirect('/users/mypage');
    }
    
    public function answer(Riddle $riddle, Request $request, Correct_Answerer $correct_answerer)
    {
        $answer = $request["user_ans"];
        if($riddle->answer === $answer){
            if(Auth::Id() && Auth::Id() !== $riddle->user_id){
                $answerer = $correct_answerer::where('user_id', Auth::Id())->where('riddle_id', $riddle->id)->first();
                if($answerer === NULL){
                    $riddle->correct_users()->attach(Auth::Id());
                }
            }
            return view('riddles/show')->with(['riddle' => $riddle,'status' => 'correct']);
            // $correct_answerer = new App\Correct_Answerer; 上と同じ動き
            // $correct_answerer->user_id = Auth::Id();
            // $correct_answerer->riddle_id = $riddle->id;
        }else{
             return view('riddles/show')->with(['riddle' => $riddle,'status' => 'false']);
        }
            
    }
    
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
}
