<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationsController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\ReservationController;
use App\Http\Controllers\Frontend\WelcomeController ;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[WelcomeController::class,'index']);




//User Dashbord

Route::get('/categories',[FrontendCategoryController::class,'index'])->name('categories.index');
Route::get('/categories/{id}',[FrontendCategoryController::class,'show'])->name('categories.show');
Route::get('/menu',[FrontendMenuController::class,'index'])->name('menu.index');
Route::get('/reservation/StepOne',[FrontendReservationController::class,'StepOne'])->name('reservation.StepOne');
Route::get('/reservation/StepTwo',[FrontendReservationController::class,'StepTwo'])->name('reservation.StepTwo');
Route::post('/reservation/StepOne/store', [FrontendReservationController::class, 'StoreOne'])->name('reservation.store.step.One');
Route::post('/reservation/StepTwo/store', [FrontendReservationController::class, 'StoreTwo'])->name('reservation.store.step.Two');
Route::get('/Message',[WelcomeController::class,'Message'])->name('Message');

//End User Dashbord
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//admin 
Route::middleware(['auth','admin'])->name('admin.')->prefix('admin')->group(function(){
  Route::get('/',[AdminController::class,'index'])->name('index');

  Route::resource('/Category',CategoryController::class);
  Route::resource('/Menu',MenuController::class);
  Route::resource('/Reservation',ReservationsController::class);
  Route::resource('/Table',TableController::class);

});


require __DIR__.'/auth.php';
