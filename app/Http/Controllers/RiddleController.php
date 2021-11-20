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
    
    public function show(Riddle $riddle, Review $review, $star = 0, $count = 0, $status = NULL)
    {
        $status = session('status');
        $reviewer = $review::where('user_id', Auth::Id())->where('riddle_id', $riddle->id)->first();
        $riddle_reviews = $review::where('riddle_id', $riddle->id)->get();
        $latest_review = $review::where('riddle_id', $riddle->id)->orderBy('review_date', 'DESC')->first();
        foreach($riddle_reviews as $riddle_review){
            $star += $riddle_review->star;
            $count++;
        }
        if($count === 0){
            $average = -1;
        }else{
            $average = $star/$count;
        }
        return view('riddles/show')->with([
            'riddle' => $riddle, 
            'reviewer' => $reviewer, 
            'average' => $average, 
            'latest_review' => $latest_review,
            'status' => $status
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
            $file_id = $request->riddle['title'];
            $file_ex = $request->riddle['image']->getClientOriginalExtension();
            $file_path = $request->riddle['image']->storeAs('public/riddle_img', Auth::Id().'.'.$file_id.'.'.$file_ex);
            $file_name = Auth::Id().'.'.$file_id.'.'.$file_ex;
            $input['image'] = $file_name;
        }
        $input += [ 'user_id' => $request->user()->id ];
        $riddle->fill($input)->save();
        return redirect('/users/mypage');
    }
    
    public function delete(Riddle $riddle)
    {
        dd($riddle->id);
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
            $judge = 'correct';
        }else{
            $judge = 'false';
        }
        return redirect()->route('riddle.detail', ['riddle' => $riddle->id])->with(['status' => $judge]);
    }
}
