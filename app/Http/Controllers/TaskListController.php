<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskList;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $task_lists=TaskList::all();
        dd($task_lists);
        return view('project_management.tasks.rindex' , compact('task_lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function update(Request $request, $taskId)
    {
        // Validate the request data if needed
        $request->validate([
            'list_name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            // Add validation rules for other fields if necessary
        ]);
    
        // Find the task list by ID
        $taskList = TaskList::find($taskId);
    
        // Check if the task list exists
        if (!$taskList) {
            return response()->json(['message' => 'Task list not found'], 404);
        }
    
        // Update task list properties
        $taskList->task_list_name = $request->input('list_name');
        
        // Check if notes is empty
        if (!empty($request->input('notes'))) {
            $taskList->notes = $request->input('notes');
        } else {
            $taskList->notes = 'Alternative Text for Empty Notes'; // Set alternative text
        }
    
        // Check if template is empty
        if (!empty($request->input('use_template'))) {
            $taskList->template = $request->input('use_template');
        } else {
            $taskList->template = 'Alternative Text for Empty Template'; // Set alternative text
        }
    
        $taskList->users = $request->input('users');
        $taskList->pin_task_list = $request->has('pin_task_list'); // Assuming it's a checkbox
    
        // Save the updated task list
        $taskList->save();
    
        return response()->json(['message' => 'Task list updated successfully'], 200);
    }
    

  

public function deleteTaskList($taskId){


    $taskList = TaskList::find($taskId);
    $taskList->delete();

    return response()->json(['message' => 'Task list deleted successfully']);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$taskId)
    {   //dd("hello there");
        $project_id=$taskId;
        //dd($request->project_id);
        // Validate the request data
        // $request->validate([
        //     'list_name' => 'required|string|max:255', // Adjust the validation rules as needed
        //     'use_template' => 'string|max:255', // Add more rules if needed
        //     // Add validation rules for other fields
        // ]);
// Ensure 'use_template' is provided before creating a TaskList
$use_template = $request->input('use_template');

if ($use_template === null) {
    // Assign a default value or handle the case where 'use_template' is null
    $use_template = 'no tempelate';
}
// Create a new task list
$taskList = TaskList::create([
    'task_list_name' => $request->input('list_name'),
    'template' => $use_template,
            'notes' => $request->input('notes'),
            'users' => $request->input('users'),
            'pin_task_list' => $request->has('pin_task_list'), // Assuming it's a checkbox
            'time' => $request->input('time'),
            'projects_id' => $project_id,
        ]);

     
        return redirect()->route('taskview', ['id' => $project_id]);
    }


// task list show
public function singleTaskList($id)
{
    $taskList = TaskList::findOrFail($id);
 //dd($taskList->id);   
    return view('project_management.tasks.tasklist', compact('taskList'));
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
   // Retrieve a task list
// $taskList = TaskList::find(1);

// // Update a task list
// $taskList->list_name = 'Updated name';
// $taskList->save();

// // Delete a task list
// $taskList->delete();

   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
