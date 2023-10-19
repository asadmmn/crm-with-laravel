<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\TaskList;
use App\Models\Projects;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
       
        $task_lists = TaskList::all();
        
        $gettask = $id;
       //dd($gettask);
       //dd($task_lists);
       
        return view('project_management.tasks.index', compact('gettask','task_lists'));
    }

  
    
    public function getTasks($id)
    {
        $taskList = TaskList::findOrFail($id);
        $tasks = $taskList->tasks;
        $allCount = $tasks->count();
        $completedTaskCount = $tasks->where('status', 'completed')->count();
        
        //$taskName = ($allCount == $completedTaskCount) ? $taskList->task_list_name : "null";
        if($allCount == $completedTaskCount){
            $taskName =$taskList->task_list_name;
        }else{
            $taskName ="Not";
        }
        return view('project_management.tasks.tasks', compact('tasks', 'taskName'));
    }
    

    
    public function rindex(Request $request, $id)
    {
        $task_lists = TaskList::all();
        $gettask = $id;
        $project = Projects::findOrFail($id);
        $task_lists = $project->taskLists;
        $completedTasks = Tasks::where('status', 'completed')->get();
    
        // $tasksView = $this->getTasks($id);
        // $taskName = $tasksView->getData()['taskName'];
    
        return view('project_management.tasks.rindex', compact('completedTasks', 'gettask', 'task_lists'));
    }
    

    
   
//task completion   
public function completeTask($id)
{
    //dd("hello");
    $task = Tasks::findOrFail($id);

    // Assuming you have a column named 'status' in your tasks table
    $task->status = 'completed'; // Set the new status value

    $task->save(); // Save the updated task

    // Optionally, you can return a response here
    return response()->json(['message' => 'Task completed successfully']);
}


//task uncompletion   
public function uncompleteTask($id)
{
    //dd("hello");
    $task = Tasks::findOrFail($id);

    // Assuming you have a column named 'status' in your tasks table
    $task->status = 'uncomplete'; // Set the new status value

    $task->save(); // Save the updated task

    // Optionally, you can return a response here
    return response()->json(['message' => 'Task set to uncomplete']);
}

//task show 
public function viewTask($id)
{
    //dd("hello");
    $task = Tasks::findOrFail($id);

    // Assuming you have a column named 'status' in your tasks table
    return view('project_management.tasks.taskdetail', compact('task'));
}

// edit a task
public function editTask()
{
    //
    return view('project_management.tasks.add_task');
}




//update task
public function updateTask(Request $request, $taskId)
{
    
        // Validate the form data
        $data = $request->validate([
            'subject' => 'nullable|string',
         'file' =>'nullable|file',
            'doer' => 'nullable|integer',
            'st_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'priority' => 'nullable|string',
            'progress' => 'nullable|integer',
            'hours' => 'nullable|integer',
            'minutes' => 'nullable|integer',
            
            
        ]);

        // Find the task by ID
        $task = Tasks::findOrFail($taskId);
        
             $old_file=$task->file_name;
     
        $file = $request->file('file');
//        dd($file);
        if ($file) {
            $fileName = $file->store('uploads'); // Adjust the directory as per your needs
        }else{ 
            $fileName = $old_file;
        }
        
        // Update the task with the validated data
        $task->update([
            'subject' => $data['subject'],
        'file_name' => $fileName,
            'doer' => $data['doer'],
        'start_date' => $data['st_date'],
        'due_date' => $data['due_date'],
        'notes' => $data['notes'],
        'priority' => $data['priority'],
        'progress' => $data['progress'],
        'est_hours' => $data['hours'],
        'est_minutes' => $data['minutes'],
       ]);

        // Handle file uploads if applicable
 
        return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
    }



// delete task

public function deleteTask($taskId)
{
    //dd("hi");
    $task = Tasks::findOrFail($taskId);

    // Perform any additional checks or validations before deletion, if necessary

    $task->delete();

    return response()->json(['message' => 'Task deleted successfully']);
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('project_management.tasks.add_task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTasksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        //dd("hi");
       // dd($request->file);
        $data = $request->validate([
            'subject' => 'required|string',
            'file' => 'nullable|file', // Allow nullable file uploads
            'doer' => 'required|integer',
            'st_date' => 'nullable|date',
            'due_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'priority' => 'required|string',
            'progress' => 'nullable|integer',
            'hours' => 'nullable|integer',
            'minutes' => 'nullable|integer',
            'pro_id' => 'required|integer',
        ]);
    
        $est_time = ($request->input('hours') * 60) + $request->input('minutes');

     // Handle file upload
     $file = $request->file('file');
     if ($file) {
         $fileName = $file->store('uploads'); // Adjust the directory as per your needs
     } else {
         $fileName = "no file";
     }
     //dd( $fileName);
        $task = Tasks::create([
            'subject' => $data['subject'],
            'file_name'=>  $fileName,
            'doer' => $data['doer'],
            'start_date' => $data['st_date'],
            'due_date' => $data['due_date'],
            'notes' => $data['notes'],
            'priority' => $data['priority'],
            'progress' => $data['progress'],
            'est_hours' => $data['hours'],
            'est_minutes' => $data['minutes'],
            'task_list_id' => $id,
        ]);
    //dd($task);
        $project_id = $request->pro_id;
        return response()->json(['redirect' => route('taskview', ['id' => $project_id])]);

    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTasksRequest  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTasksRequest $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
