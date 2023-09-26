<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index(){

        $data = User::where('user_Type', 'team')->get();
        return view('team.table', compact('data'));
    }

    // Return update form with requested data
    public function getForm(Request $request){
        $data = ['data' => DB::table('users')->where('id', $request->id)->first()];
        return view('team.register', $data);
    }

    // Register team member form
    public function register_TeamMember(){
        return view('team.register');
    }
    // Save Client in DB
    public function saveTeamMember(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'role' => 'required|max:50',
            'user_Type' => 'required|max:50',
            'email' => 'required|email|unique:users|max:100',
            // 'password' => 'required|min:6|max:50',
            // 'cpassword' => 'required|min:6|same:password'
        ],[
            // 'cpassword.same' => 'Password did not match!',
            // 'cpassword.required' => 'Confirm password is required!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->user_Type = $request->user_Type;
            $user->notes = $request->notes;
            $user->token = $request->token;
            // $user->password = Hash::make($request->password);
            // $user->name = $request->name;

            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Registered successfully!'
            ]);
        }
    }

    // Handle Update Form
    public function updateForm(Request $request){
        $user_id = $request->id;
        $user = User::find($user_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'role' => 'required|max:50',
            'user_Type' => 'required|max:50',
            'email' => ['required', 'email', 'max:100',  Rule::unique('users')->ignore( $user->email, 'email')],
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            User::where('id', $user_id)->update([
                'name' => $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_Type' => $request->user_Type,
                'notes' => $request->notes,
            ]);

            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully!'
            ]);
        }
    }


    public function destroy($id){
        $record = User::find($id);

        if (!$record) {
            $message = 'Record not found.';
            $statusCode = 404; // Not Found
        } else {
            $record->delete();
            $message = 'Record deleted successfully.';
            $statusCode = 200; // OK
        }

        $data = $data = User::where('user_Type', 'team')->get();

        $res = response()->json([
            'status' => 200,
            'message' => 'Record deleted Successfully!',
        ]);

        return response()->view('team.row', compact('data'), $statusCode);


    }
}
