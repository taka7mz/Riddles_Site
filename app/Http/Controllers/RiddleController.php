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
    public function store(Request $request, RiddleRequest $riddle)
    {
        $input = $request['riddle'];
        $riddle->fill($input)->save();
        return redirect('/riddles/' . $riddle->id);
    }
}
