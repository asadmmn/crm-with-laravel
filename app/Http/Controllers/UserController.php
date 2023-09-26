<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){
        if(session()->has('loggedInUser')){
            return redirect('/');
        } else {
            return view('auth.login');
        }

    }

    public function register_client(){
        return view('clients.client-registration');
    }

    public function forgot_password(){
        if(session()->has('loggedInUser')){
            return redirect('/');
        } else {
            return view('auth.forgot-password');

        }
    }

    public function reset_password(Request $request){
        if(session()->has('loggedInUser')){
            return back();
        } else {
            $email = $request->email;
            $token = $request->token;
            return view('auth.reset-password', ['email' => $email, 'token' => $token]);

        }
    }

    // handle reset password ajax request
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:50',
            'confirm_password' => 'required|min:6|max:50|same:password'
        ], [
            'confirm_password' => 'Password did not match!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            $user = DB::table('users')->where('email', $request->email)->whereNotNull('token')->where('token', $request->token)->where('token_expire', '>', Carbon::now())->exists();

            if($user){
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password),
                    'token' => null,
                    'token_expire' => null
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'New password updated!&nbsp;&nbsp;<a href="/login">Login Now</a>'
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Reset Link expired! Request a new password Link!'
                ]);
            }
        }
    }

    // Admin Registration Page
    public function register_admin(){
        if(session()->has('loggedInUser')){
            return redirect('/');
        } else {
            return view('auth.register-admin');
        }
    }

    // Save Client in DB
    public function saveClient(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'business_name' => 'required|max:50',
            'service_pkj' => 'required|max:50',
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
            $user->business_name = $request->business_name;
            $user->website = $request->website;
            $user->service_pkj = $request->service_pkj;
            $user->email = $request->email;
            $user->industry = $request->industry;
            $user->location = $request->location;
            $user->client_type = $request->client_type;
            $user->website_type = $request->website_type;
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

    // Save Admin
    public function saveAdmin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|max:50',
            'cpassword' => 'required|min:6|same:password'
        ],[
            'cpassword.same' => 'Password did not match!',
            'cpassword.required' => 'Confirm password is required!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            $user = new User();
            $user->email = $request->email;
            $user->token = $request->token;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->user_Type = $request->user_Type;

            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Registered successfully!'
            ]);
        }

        // return view('auth.login');
        return view('auth.login');
    }


    // handle login user ajax request
    public function loginUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        }else {
            $user = User::where('email', $request->email)->first();
            if($user){
                if(Hash::check($request->password, $user->password)){
                    $request->session()->put('loggedInUser', $user->id);
                    return response()->json([
                        'status' => 200,
                        'message' => 'success'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'message' => 'Email or password is incorrect'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'User not found!'
                ]);
            }
        }

        return view('welcome');
    }

    // Redirect the logged in user to their respective page
    public function dashboard(){
        $data = ['userinfo' => DB::table('users')->where('id', session('loggedInUser'))->first()];
        return view('clients.client-registration', $data);
    }

    // Update profile Image
    public function profileImageUpdate(Request $request){
        $user_id = $request->user_id;
        $user = User::find($user_id);

        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);

            if($user->picture){
                Storage::delete('public/images' . $user->picture);
            }
        }

        User::where('id', $user_id)->update([
            'picture' => $fileName
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Profile Image updated Successfully!'
        ]);
    }

    // Handle forgot password
    public function forgotPassword(Request $request){
        $validator = validator::make($request->all(), [
            'email' => 'required|email|max:100'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'message' => $validator->getMessageBag()
            ]);
        } else {
            $token = Str::uuid();
            $user = DB::table('users')->where('email', $request->email)->first();
            $details = [
                'body' => route('reset-password', ['email' => $request->email, 'token' => $token])
            ];

            if($user){
                User::where('email', $request->email)->update([
                    'token' => $token,
                    'token_expire' => Carbon::now()->addMinutes(10)->toDateTimeString()
                ]);

                Mail::to($request->email)->send(new ForgotPassword($details));
                return response()->json([
                    'status' => 200,
                    'message' => 'Reset password link has been sent to your e-mail.'
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'This email is not registered with us!'
                ]);
            }
        }
    }

    // Logout method
    public function logout(){
        if(session()->has('loggedInUser')){
            session()->pull('loggedInUser');
            return redirect('/login');
        }
    }
}
