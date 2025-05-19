<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CamionController;
use App\Http\Controllers\ChaufeurController;
use App\Http\Controllers\ConsomationController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\NaturesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PapierController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VilleController;
use App\Models\Consomation;
use App\Models\Papier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
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
Route::permanentRedirect('/home', 'admin');

Route::prefix("admin")->middleware(["auth"])->group(function () {
    Route::get("/", [HomeController::class, 'Home']);

    Route::get("/chauffeur/{id}/chart-data", [HomeController::class, 'SuiviGazoleParChaufeur'])->name("chauffeur.SuiviGazoleParChaufeur");
    Route::get('/chauffeur/{id}', [HomeController::class, 'showDetails'])->name('chauffeur.details');


    Route::get('search', function () {
        return view('gazole.statistiques.statistiques');
    })->name("global.search");
    Route::get('camions/statistiques', function () {
        return view('gazole.statistiques.camion');
    })->name("camion.statistiques");


    Route::get('reparation/statistiques', function () {
        return view('gazole.reparation.statistiques');
    })->name("reparation.statistiques");

    Route::get("users", [HomeController::class, 'GazoleUsersList'])->name("gazole.users");
    Route::resource("chaufeur", ChaufeurController::class);
    // camion start
    Route::resource("camions", CamionController::class);
    Route::controller(CamionController::class)->group(function () {
        Route::post('AddBonCharge', 'AddNewCharge')->name("camion.AddNewCharge");
        Route::delete('deleteCharge/{camionCharge}', 'deleteCharge')->name("camion.deleteCharge");
    });
    // camion end
    Route::resource("stations", StationController::class);
    Route::resource("consomations", ConsomationController::class);
    Route::resource("missions", MissionController::class);
    Route::resource("reparations", ReparationController::class);
    Route::resource("ville", VilleController::class);
    Route::resource("pieces", PieceController::class);
    Route::resource("factures", FactureController::class);
    Route::resource("natures", NaturesController::class);
    Route::resource("papiers", PapierController::class);
    Route::resource("users", UsersController::class);

    Route::controller(ExcelController::class)->name('excel.')->group(function () {
        Route::post("exportTrajet", "exportTrajet")->name("exportTrajet");
        Route::post("exportMission", "exportMission")->name("exportMission");
        Route::post("exportFacture", "exportFacture")->name("exportFacture");
        Route::post("exportFactureTotalGenerale", "exportFactureTotalGenerale")->name("exportFactureTotalGenerale");
        Route::post("exportReparation", "exportReparation")->name("exportReparation");
        Route::post("ExportCamionSearch", "ExportCamionSearch")->name("ExportCamionSearch");
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get("CreateBon/{id}", "CreateBon")->name("createBon");
        Route::post("AddBonToConsomation/{id}", "AddBonToConsomation")->name("AddBonToConsomation");
        //
        Route::get("CreateReparationInfo/{id}", "CreateReparationInfo")->name("CreateReparationInfo");
        Route::post("AddInfoToReparation/{id}", "AddInfoToReparation")->name("AddInfoToReparation")->middleware('ValidateReparationSoldeInfo');
        Route::put("EditInfoReparation/{id}", "EditInfoReparation")->name("EditInfoReparation");
        //
        Route::get("getStation", "getStations")->name("getStations");
        Route::get("factureStatistiques", "facturesStatistiques")->name("facture.statistiques");
        Route::get("ViewBonsOfTrajet/{id}", "ViewBonsOfTrajet")->name("getBons");
        Route::post("UpdateBon/{id}", "UpdateBon")->name("UpdateBon");
        Route::delete("DeleteBon/{id}", "DeleteBon")->name("DeleteBon");
    });
    //
    Route::controller(PdfController::class)->group(function(){
        Route::get('GetInfoOfReparation/{reparation}', "GetInfoOfReparation")->name("pdf.GetInfoOfReparation");
        Route::get('GetAllReparationsInfo', "GetAllReparationsInfo")->name("pdf.GetAllReparationsInfo");
    });
    //

    Route::controller(ProfileController::class)->name("profile.")->group(function () {
        Route::get('profile', "index")->name("index");
        Route::post('/SetProfile', 'SetProfile')->name("SetProfile");
        Route::post('/updatePassword', 'updatePassword')->name("updatePassword");
    });

    Route::controller(SwitchController::class)->group(function () {
        Route::get('SwitchActiveModeForChaufeur/{id}', 'SwitchActiveModeForChaufeur')->name("SwitchActiveModeForChaufeur");
        Route::get('SwitchActiveModeForCamion/{id}', 'SwitchActiveModeForCamion')->name("SwitchActiveModeForCamion");
        Route::get('SwitchIsForAejModeForCamion/{id}', 'SwitchIsForAejModeForCamion')->name("SwitchIsForAejModeForCamion");
        Route::get('SwitchActiveModeForTrajet/{id}', 'SwitchActiveModeForTrajet')->name("SwitchActiveModeForTrajet");
    });

    // web.php
    Route::get('notifications' , [NotificationController::class, 'index'])->name("notifications.index");
    Route::delete('/notifications/deleteAll', [NotificationController::class, 'deleteAll'])->name('notifications.deleteAll');
    Route::patch('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');

});

Route::POST("AddUser", UserController::class)->name("add.users")->middleware("auth");

Route::get("login", [AuthController::class, 'Login_form'])->name('login')->middleware("guest");
Route::post("login_c", [AuthController::class, 'login'])->name('login_c');
Route::get("logout", [AuthController::class, 'logout'])->name('logout');

Route::get('/addcache', function () {
    $command = Artisan::call("route:cache");
    dd("route cache with success");
});
Route::get('/clearcache', function () {
    $command = Artisan::call("route:clear");
    dd("route clear with success");
});

Route::get('send-mail', function () {
    $trajets = Consomation::where('status', 0)->get();

    if ($trajets->count() > 0) {
        Mail::send('Mail.TestMail', ['trajets' => $trajets], function ($message) {
            $message->to('Yousseftrih59@gmail.com')
                ->subject('Test Mail');
        });
    }
    return redirect()->back()->with([
        "success" => "email send with success"
    ]);
})->name("email");

Route::get('update-days-count' , function() {
    $data = Papier::all();
    foreach ($data as $item) {
        $datedebut = Carbon::parse($item->date_debut);
        $datefin = Carbon::parse($item->date_fin);

        $diff = $datefin->diffInDays($datedebut);

        $item->update([
            "days_count" => $diff
        ]);
    }
});
