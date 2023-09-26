<?php

use App\Http\Controllers\clients;
use App\Http\Controllers\ProjectManagement;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('main');
// });

Route::get('/login', [UserController::class, 'index']);
Route::get('/forgot-password', [UserController::class, 'forgot_password']);
Route::get('/reset-password/{email}/{token}', [UserController::class, 'reset_password'])->name('reset-password');
Route::get('/register-admin', [UserController::class , 'register_admin']);



Route::post('/login', [UserController::class, 'loginUser'])->name('auth.login');
Route::post('/register-admin', [UserController::class, 'saveAdmin'])->name('auth.registeer-admin');
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('auth.forgot-password');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('auth.reset-password');


Route::group(['middleware' => ['LoginCheck']], function(){
    Route::get('/', [UserController::class, 'dashboard'])->name('/');
    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');

    // client
    Route::get('/clients', [clients::class, 'index']);
    Route::post('/register-client', [UserController::class, 'saveClient'])->name('client.client-registration');
    Route::get('/register-client', [UserController::class, 'register_client']);
    Route::get('/client', [clients::class, 'getClientForm'])->name('client');
    Route::get('/client/{id}', [clients::class, 'getClientForm'])->name('singleClient');
    Route::delete('/client/{id}', [clients::class, 'destroy'])->name('deleteClient');
    Route::post('/update-client', [clients::class, 'updateClientForm'])->name('updateClient');


    // Routes for team
    Route::get('/team', [TeamController::class, 'index']);
    Route::post('/register-team-member', [TeamController::class, 'saveTeamMember'])->name('register-team-member');
    Route::get('/register-team-member', [TeamController::class, 'register_TeamMember']);
    Route::get('/team-member', [TeamController::class, 'getForm'])->name('team');
    Route::get('/team/{id}', [TeamController::class, 'getForm'])->name('singleTeam-member');
    Route::delete('/team/{id}', [TeamController::class, 'destroy'])->name('deleteTeam-member');
    Route::post('/update-team-member', [TeamController::class, 'updateForm'])->name('updateTeam-member');

    // Project Management
    Route::get('/project', [ProjectManagement::class, 'index']);
    Route::get('/projectList', [ProjectManagement::class, 'projectList']);
    Route::get('/project/{id}', [ProjectManagement::class, 'editProject'])->name('getEditProject');
    Route::get('/project/{id}/addUser', [ProjectManagement::class, 'getPeopleForProject'])->name('getPeopleForProject');
    Route::get('/project/{id}/getOwner', [ProjectManagement::class, 'getOwnersForProject'])->name('getOwnerForProject');
    Route::post('/project/addOwner', [ProjectManagement::class, 'addOwnersForProject'])->name('addOwnerForProject');
    Route::post('/project/addUser', [ProjectManagement::class, 'addPeopleForProject'])->name('addPeopleForProject');
    Route::post('/save-project', [ProjectManagement::class, 'saveProject'])->name('saveProject');
    Route::post('/fvrt-project', [ProjectManagement::class, 'fvrtProject'])->name('fvrtProject');
    Route::post('/update-project', [ProjectManagement::class, 'update'])->name('updateProject');
    Route::delete('/project/{id}', [ProjectManagement::class, 'destroy'])->name('deleteProject');

    // Tasks
    Route::get('/project/{id}/tasks/li', [TasksController::class, 'index'])->name('taskindex');
    Route::get('/project/{id}/tasks/list', [TasksController::class, 'rindex']);


});
