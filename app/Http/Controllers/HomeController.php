<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\tasks;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $values = ['user_id' =>$request->user()->id, 'list_date' => date('Y-m-d', time())];
        $task = tasks::where($values)->orderBy('list_date','desc')->paginate(10);
        return view('home')->with('tasks',$task);
    }
}
