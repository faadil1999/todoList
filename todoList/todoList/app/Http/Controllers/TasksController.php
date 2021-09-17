<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
  protected  $orderBy = "asc";

    public function index()
    {
        $tasks = auth()->user()->tasks();
        return view('dashboard', compact('tasks'));
    }
    public function add()
    {
    	return view('add');
    }

    
    public function create(Request $request)
    {   $newImageName= "";

        $this->validate($request, [
            'description' => 'required',
            'picture' => 'mimes:jpg,png,jpeg',
        ]);
      
        $input = $request->all();
        if($request->hasFile('picture')){
            $newImageName = time() . '_' . $request->file('picture')->getClientOriginalName();
            $request->picture->move(public_path('images'), $newImageName);
           
        }
        
        
        
    	$task = new Task();
    	$task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->picture = $newImageName;
    	$task->save();
    	return redirect('/dashboard'); 
    }

    public function edit(Task $task)
    {

    	if (auth()->user()->id == $task->user_id)
        {            
                return view('/edit', compact('task'));
        }           
        else {
             return redirect('/dashboard');
         }            	
    }

    public function search(Request $request){
       // $search_txt = $_GET['query'];
       //    $tasks = Task::where('description' , 'LIKE', '%' ,$search_txt.'%')->get();
        if($request->has('query'))
            { 
            $search_txt = $_GET['query'];
           $tasks = Task::where('description' , 'LIKE', '%'.$search_txt.'%')->get();
            }
        else{

            $task = Tast::get();
        }

        return \view('search',\compact('tasks'));
    }

    public function filter(Request $request){
        
        if(isset($_POST['filter_asc'])) {
            return \view('search',['tasks' =>Task::orderBy('description', 'asc')->get()]);
        }  
        elseif(isset($_POST['filter_desc'])){
            return \view('search',['tasks' =>Task::orderBy('description', 'desc')->get()]);
        }
        
    }

    public function update(Request $request, Task $task)
    {
        $newImageName = "";

    	if(isset($_POST['delete'])) {
    		$task->delete();
    		return redirect('/dashboard');
        }
        elseif(isset($_POST['delete_pic'])){
            $task->picture = "";
            $task->save();
            return redirect('/dashboard');
        }
    	else
    	{    $input = $request->all();
            $this->validate($request, [
                'description' => 'required',
                'picture' => 'mimes:jpg,png,jpeg',
            ]);

            if($request->hasFile('picture')){
                $newImageName = time() . '_' . $request->file('picture')->getClientOriginalName();
                $request->picture->move(public_path('images'), $newImageName);
                $task->picture = $newImageName;
            }

            $task->description = $request->description;
            
	    	$task->save();
	    	return redirect('/dashboard'); 
    	}    	
    }
}
