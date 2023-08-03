<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ChaufeurController;
use App\Http\Controllers\ConsomationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\StationController;
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
//     return redirect('/login');
// });
Route::permanentRedirect('/', 'login');

Route::prefix("bons")->middleware(["auth", 'role:bons'])->group(function () {
    Route::get('/', function () {
        return view('admin.welcome');
    });
    Route::post('/orders_import', [HomeController::class, 'upload'])->name('orders.import');
    Route::get('getsubcategories', [PdfController::class, 'getsubcategories'])->name('getsubcategories');
    Route::get('recap', [PdfController::class, 'recap'])->name('recap');
    Route::get('tickets', [PdfController::class, 'tickets'])->name('tickets');
    Route::get('bon_reception', [PdfController::class, 'bon_reception'])->name('bon_reception');
    Route::get('clear', [HomeController::class, 'clear'])->name('clear');
});

Route::prefix("admin")->middleware(["auth", "role:gazole"])->group(function () {
    Route::get('/', function () {
        return view('gazole.index');
    });
    Route::get('camions/statistiques', function () {
        return view('gazole.statistiques.camion');
    })->name("camion.statistiques");
    Route::get('search', function () {
        return view('gazole.search.index');
    })->name("global.search");
    Route::get("users", [HomeController::class, 'GazoleUsersList'])->name("gazole.users");
    Route::resource("chaufeur", ChaufeurController::class);
    Route::resource("camions", CamionController::class);
    Route::resource("stations", StationController::class);
    Route::resource("consomations", ConsomationController::class);
    Route::resource("nature", NatureController::class);
    Route::controller(HomeController::class)->group(function () {
        Route::get("CreateBon/{id}", "CreateBon")->name("createBon");
        Route::post("AddBonToConsomation/{id}", "AddBonToConsomation")->name("AddBonToConsomation");
        Route::get("getStation", "getStations")->name("getStations");
    });
});

Route::POST("AddUser", UserController::class)->name("add.users")->middleware("auth");

Route::get("login", [AuthController::class, 'Login_form'])->name('login')->middleware("guest");
Route::post("login_c", [AuthController::class, 'login'])->name('login_c');
Route::get("logout", [AuthController::class, 'logout'])->name('logout');
