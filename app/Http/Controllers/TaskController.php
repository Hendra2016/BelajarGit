<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\TaskRepository;
use App\Http\Requests;
use App\tasks;
use Auth;
use Session;
class TaskController extends Controller
{

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

     public function index(Request $request)
    {
        $task = tasks::where('user_id','=',$request->user()->id)->orderBy('list_date','desc')->paginate(10);
        return view('tasks.task')->with('tasks',$task);
    }

    public function store(Request $request){
        $date = date('Y-n-d h:i:s', time());
        $task = new tasks;
        $flash = "";
        if($request->input('id') != ""){
            $task = tasks::findOrFail($request->input('id'));
            $task->updated_date = $date;
            $flash = "Task successfully updated!";
        }else {
            $task->created_date = $date;
            $flash = "Task successfully added!";
        }
        $task->user_id = Auth::user()->id;
        Session::flash('flash_message', $flash);
        $input = $request->all();
        $task->fill($input)->save();
        return redirect('/task');
    }

    public function show($id)
    {
        $task = tasks::findOrFail($id);

        return view('tasks.show', [
        	'tasks' => $task,
        	]);
    }

    public function edit($id)
    {
        $task = tasks::findOrFail($id);
        return view('tasks.add', [
            'tasks' => $task, 'title'=>'Edit Task'
            ]);
    }

    public function add(){
        $tasks = new tasks;
        return view('tasks.add', ['tasks'=>$tasks, 'title'=>'Add Task']);
    }

    public function delete($id){
        $task = tasks::findOrFail($id);
        $task->delete();
        Session::flash('flash_message', 'Task successfully deleted!');
        return redirect('/task');
    }
}
