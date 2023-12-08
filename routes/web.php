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
use App\Http\Controllers\PieceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReparationController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\SwitchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use App\Models\Chaufeur;
use App\Models\Consomation;
use App\Models\facture;
use App\Models\Station;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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

Route::prefix("admin")->middleware(["auth", "role:gazole"])->group(function () {
    Route::get('/', function () {
        $results = Station::join('factures as f', 'stations.id', '=', 'f.station_id')
            ->select('stations.name', DB::raw('COUNT(f.id) as total_factures'), DB::raw('SUM(f.prix) as total_prix'))
            ->whereMonth('f.date', now()->month)
            ->whereYear('f.date', now()->year)
            ->groupBy('stations.id', 'stations.name')
            ->get();

        $results_2 = facture::select(
            DB::raw('YEAR(date) AS year'),
            DB::raw('MONTH(date) AS month'),
            DB::raw('SUM(prix) AS total_prix')
        )
            ->whereIn('station_id', function ($query) {
                $query->select('id')->from('stations')->where('name', '!=', 'divers');
            })
            ->groupBy(DB::raw('YEAR(date), MONTH(date)'))
            ->get();

        // $chaufeurs_consomation = Consomation::with("chaufeur")
        //     ->selectRaw('chaufeur_id')
        //     ->whereMonth('date', now()->month)
        //     ->whereYear('date', now()->year)
        //     ->where('status', 1)
        //     ->groupBy('chaufeur_id')
        //     ->get();
        $chaufeurs_consomation = Chaufeur::withCount(['consomations as sum_statues' => function ($query) {
            $query->where('statue', 1)
                ->whereMonth('date', now()->month)
                ->whereYear('date', now()->year);
        }])
        ->where('statue', 1)
        ->get();
        // dd($chaufeurs_consomation);
        return view('gazole.index', compact("results", "results_2", "chaufeurs_consomation"));
    });

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
    Route::resource("camions", CamionController::class);
    Route::resource("stations", StationController::class);
    Route::resource("consomations", ConsomationController::class);
    Route::resource("missions", MissionController::class);
    Route::resource("reparations", ReparationController::class);
    Route::resource("ville", VilleController::class);
    Route::resource("pieces", PieceController::class);
    Route::resource("factures", FactureController::class);
    Route::resource("natures", NaturesController::class);

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
        Route::get("getStation", "getStations")->name("getStations");
        Route::get("factureStatistiques", "facturesStatistiques")->name("facture.statistiques");
        Route::get("ViewBonsOfTrajet/{id}", "ViewBonsOfTrajet")->name("getBons");
        Route::post("UpdateBon/{id}", "UpdateBon")->name("UpdateBon");
        Route::delete("DeleteBon/{id}", "DeleteBon")->name("DeleteBon");
    });

    Route::controller(ProfileController::class)->name("profile.")->group(function () {
        Route::get('profile', "index")->name("index");
        Route::post('/SetProfile', 'SetProfile')->name("SetProfile");
        Route::post('/updatePassword', 'updatePassword')->name("updatePassword");
    });

    Route::controller(SwitchController::class)->group(function () {
        Route::get('SwitchActiveModeForChaufeur/{id}', 'SwitchActiveModeForChaufeur')->name("SwitchActiveModeForChaufeur");
        Route::get('SwitchActiveModeForCamion/{id}', 'SwitchActiveModeForCamion')->name("SwitchActiveModeForCamion");
        Route::get('SwitchActiveModeForTrajet/{id}', 'SwitchActiveModeForTrajet')->name("SwitchActiveModeForTrajet");
    });
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
