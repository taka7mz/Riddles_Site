<?php

namespace App\Http\Controllers;

use App\Riddle;
use Illuminate\Http\Request;
use App\Http\Requests\RiddleRequest;
use App\Correct_Answerer;
use Auth;

class RiddleController extends Controller
{
    public function index(Riddle $riddle)
    {
        return view('riddles/index')->with(['riddles' => $riddle->getPaginateByLimit()]);
    }
    public function show(Riddle $riddle)
    {
        return view('riddles/show')->with(['riddle' => $riddle, 'status' => NULL]);
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
}
