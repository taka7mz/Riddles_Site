<?php

namespace App\Http\Controllers;

use App\Riddle;
use Illuminate\Http\Request;
use App\Http\Requests\RiddleRequest;
use App\Correct_Answerer;
use App\Review;
use App\User;
use Auth;
use Storage;
use DB;

class RiddleController extends Controller
{
    public function top(Riddle $riddle, Review $review)
    {
        $rankings = DB::table('reviews')
            ->join('riddles', 'riddles.id', '=', 'reviews.riddle_id')
            ->join('users','riddles.user_id','=', 'users.id')
            ->select('reviews.riddle_id','riddles.title', 'riddles.user_id','users.name', DB::raw('avg(reviews.star) as star_avg'), 'riddles.created_at as riddle_date')
            ->groupBy('riddle_id')->groupBy('riddles.title')->groupBy('riddles.user_id')->groupBy('users.name')->groupBy('riddle_date')
            ->orderBy('star_avg', 'DESC')->limit(5)->get();
        return view('riddles/top')->with([
            'riddles' => $riddle->getLimit(),
            'rankings' => $rankings
        ]);
    }
    
    public function index(Riddle $riddle)
    {
        return view('riddles/index')->with(['riddles' => $riddle->getPaginateByLimit()]);
    }
    
    public function ranking(Riddle $riddle)
    {
        return view('riddles/index')->with(['riddles' => $riddle]);
    }
    
    public function show(Riddle $riddle, $star = 0, $count = 0, $status = NULL)
    {
        $status = session('status');
        if(Auth::Id()){
            $reviewer = Auth::user()->reviewUsers()->get()->contains($riddle);
        }else{
            $reviewer = NULL;
        }
        $riddle_reviews = $riddle->reviews()->get();
        $latest_review = $riddle->reviews()->orderBy('review_date', 'DESC')->first();
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
            $file_img = $request->riddle['image'];
            $file_path = Storage::disk('s3')->putFile('riddle_img', $file_img, 'public');
            $full_file_path = Storage::disk('s3')->url($file_path);
            $input['image'] = $full_file_path;
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
            $judge = 'correct';
        }else{
            $judge = 'false';
        }
        return redirect()->route('riddle.detail', ['riddle' => $riddle->id])->with(['status' => $judge]);
    }
}
