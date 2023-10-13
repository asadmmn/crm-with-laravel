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


// 

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
    public function update(Request $request, $id)
    {
        //
    }

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
