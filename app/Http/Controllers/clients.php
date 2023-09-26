<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class clients extends Controller
{
    public function index(){
        $data = User::where('user_Type', 'client')->get();
        // $data = ['clients' => DB::table('users')->where('user_Type', 'client')];
        return view('clients.table', compact('data'));
    }

    // Return update form with requested client's data
    public function getClientForm(Request $request){
        $data = ['data' => DB::table('users')->where('id', $request->id)->first()];
        return view('clients.client-registration', $data);
    }

    public function updateClientForm(Request $request){
        $user_id = $request->id;
        $user = User::find($user_id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'business_name' => 'required|max:50',
            'service_pkj' => 'required|max:50',
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
                'business_name' => $request->business_name,
                'website' => $request->website,
                'service_pkj' => $request->service_pkj,
                'email' => $request->email,
                'industry' => $request->industry,
                'location' => $request->location,
                'client_type' => $request->client_type,
                'website_type' => $request->website_type,
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

        $data = $data = User::where('user_Type', 'client')->get();

        $res = response()->json([
            'status' => 200,
            'message' => 'Record deleted Successfully!',
        ]);

        return response()->view('clients.row', compact('data'), $statusCode);


    }
}


