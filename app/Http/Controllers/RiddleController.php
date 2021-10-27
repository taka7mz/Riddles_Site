<?php

namespace App\Http\Controllers;

use App\Riddle;
use Illuminate\Http\Request;
use App\Http\Requests\RiddleRequest;

class RiddleController extends Controller
{
    public function index(Riddle $riddle)
    {
        return view('riddles/index')->with(['riddles' => $riddle->getPaginateByLimit()]);
    }
    public function show(Riddle $riddle)
    {
        return view('riddles/show')->with(['riddle' => $riddle]);
    }
    public function create()
    {
        return view('riddles/create');
    }
    public function store(Riddle $riddle, RiddleRequest $request)
    {
        $file_name = $request->riddle['image']->getClientOriginalName();
        $request->riddle['image']->storeAs('public/riddle_img',$file_name);
        $input = $request['riddle'];
        $input['image'] = $file_name;
        $riddle->fill($input)->save();
        return redirect('/riddles/' . $riddle->id);
    }
}
