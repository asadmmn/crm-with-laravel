<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\TaskList;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectManagement extends Controller
{
    public function index(){
        $data = Projects::where('created_by', '=', session('loggedInUser'))->with('users')->get();
        $team = User::where('user_Type', 'team')->get();
        // $prId=$data->id;
        $lists=TaskList::all();
       
        return view('project_management.create_projects.index', compact('data', 'team','lists'));
    }

    // Get Project rows
    public function projectList(){
        $data = Projects::where('created_by', session('loggedInUser'))->with('ownerName')->get();
       
        return view('project_management.create_projects.row', compact('data'));
    }

    // Get Edit project View
    public function editProject(Request $request, $id){
        $data = ['data' => DB::table('projects')->where('created_by', session('loggedInUser'))->where('id', $id)->first()];
        return view('project_management.create_projects.edit-project', $data);
    }

    // Save Project
    public function saveProject(Request $request){
        
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|unique:projects,project_name',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            $table = new Projects();
            // foreach($request)
            $table->created_by  = session('loggedInUser');
            $table->project_name = $request->project_name;

            $table->notes = $request->notes;
            $table->project_category = $request->proj_category;
            $table->access_to_users = $request->add_ppl;
            $table->company = $request->company;



            $table->save();

            $id = $table->id;
            if(isset($request->add_ppl)){
                foreach($request->add_ppl as $p){
                    $user = User::find($p);
                    $project = Projects::find($id);
                    $role = 1;
                    $user->projects()->attach($project, ['role_id' => $role]);
                }
            }


            return response()->json([
                'status' => 200,
                'message' => 'Added successfully!'
            ]);
        }
    }

    // Fvrt Project
    public function fvrtProject(Request $request){
        $id = $request->id;
        $project = Projects::find($id);

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            Projects::where('id', $id)->update([
                'fvrt' => 1,
            ]);

            $project->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully!'
            ]);
        }
    }

    // Handle Update Form
    public function update(Request $request){
        $id = $request->id;
        $data = Projects::find($id);

        $validator = Validator::make($request->all(), [
            'project_name' => ['required',  Rule::unique('projects')->ignore( $data->project_name, 'project_name')],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            Projects::where('id', $id)->update([
                'project_name' => $request->project_name,
                'notes' => $request->notes,
                'project_category' => $request->project_category,
                'company' => $request->company,
            ]);

            $data->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully!'
            ]);
        }
    }

    // Get unassigned People for project
    public function getPeopleForProject(Request $request, $id){
        $data = User::whereDoesntHave('projectWithUAUser', function($query) use($id) {
            $query->where('project__access__users.projects_id', $id);
        })->where('user_Type', 'team')->get();
        return view('project_management.create_projects.add_users', compact('data', 'id'));
    }

    // Get User for project for owner view
    public function getOwnersForProject(Request $request, $id){
        $data = User::where('user_Type', 'team')->get();
        return view('project_management.create_projects.add_owner', compact('data', 'id'));
    }

    // Add/Update owner for project
    public function addOwnersForProject(Request $request){
        $id = $request->id;
        $project = Projects::find($id);
        $owner = isset($request->owner) ? $request->owner : 0;

        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            Projects::where('id', $id)->update([
                'owner' => $owner,
            ]);

            $project->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully!'
            ]);
        }
    }

    // Assign people to project
    public function addPeopleForProject(Request $request){
        $id = $request->id;

        foreach($request->add_ppl as $p){
            $user = User::find($p);
            $project = Projects::find($id);
            $role = 1;
            $user->projects()->attach($project, ['role_id' => $role]);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Users added successfully!'
        ]);
    }

    // Delete Record
    public function destroy($id){
        $record = Projects::find($id);

        if (!$record) {
            $message = 'Record not found.';
            $statusCode = 404; // Not Found
        } else {
            $record->delete();
            $message = 'Record deleted successfully.';
            $statusCode = 200; // OK
        }

        $data = Projects::where('created_by', session('loggedInUser'))->get();

        $res = response()->json([
            'status' => 200,
            'message' => 'Record deleted Successfully!',
        ]);

        return response()->view('project_management.create_projects.row', compact('data'), $statusCode);


    }
}
