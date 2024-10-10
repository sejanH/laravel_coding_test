<?php

use App\Http\Controllers\VaccineRegistrationController;
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
//     return view('welcome');
// });
Route::get('/',[VaccineRegistrationController::class,'index']);
Route::post('check',[VaccineRegistrationController::class,'checkRegistration'])->name('check');
Route::post('register',[VaccineRegistrationController::class,'center_register'])->name('post.register');
Route::get('register',[VaccineRegistrationController::class,'register'])->name('register');