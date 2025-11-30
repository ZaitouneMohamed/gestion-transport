<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBonRequest;
use App\Imports\OrderImport;
use App\Models\Bons;
use App\Models\Chaufeur;
use App\Models\Consomation;
use App\Models\facture;
use App\Models\Papier;
use App\Models\ReparationInfo;
use App\Models\Station;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("CreateBon")->only("AddBonToConsomation");
    }

    public function Home()
    {
        // In tinker or a new migration
   Papier::all()->each(function ($papier) {
       if ( $papier->date_fin) {
           $dateDebut = Carbon::parse($papier->date_debut);
           $dateFin = Carbon::parse($papier->date_fin);

           $papier->days_count = $dateFin->diffInDays($dateDebut, false);
           $papier->last_notification = $papier->date_debut;
           $papier->save();
       }
   });
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $total_factures_current_month = facture::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->whereIn('station_id', function ($query) {
                $query->select('id')->from('stations')->where('name', '!=', 'divers');
            })
            ->sum('prix');

        $results = Station::join('factures as f', 'stations.id', '=', 'f.station_id')
            ->select(
                'stations.name',
                DB::raw('COUNT(f.id) as total_factures'),
                DB::raw('SUM(f.prix) as total_prix')
            )
            ->whereMonth('f.date', now()->month)
            ->whereYear('f.date', now()->year)
            ->groupBy('stations.id', 'stations.name')
            ->get();

        foreach ($results as $result) {
            $result->percentage_prix = $total_factures_current_month > 0 ? ($result->total_prix / $total_factures_current_month) * 100 : 0;
        }

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

        $chaufeursWithSumStatues = \App\Models\Chaufeur::with([
            'consomations' => function ($query) {
                $query->whereMonth('date', now()->month)
                    ->whereYear('date', now()->year)
                    ->where('status', 1)
                    ->with([
                        'bons' => function ($q) {
                            $q->where('nature', 'gazole')->orderBy('id');
                        },
                        'camion'
                    ]);
            }
        ])
        ->where('statue', 1)
        ->whereNotIn('full_name', ['YOUCEF STATION', 'M.SAYAH', 'HAKIM'])
        ->get();

        // Add sum_statues per chauffeur
        $chaufeursWithSumStatues->each(function ($chauffeur) {
            $chauffeur->sum_statues = $chauffeur->consomations->sum(function ($consomation) {
                if (isset($consomation->calculated_values['statue'])) {
                    $statue = $consomation->calculated_values['statue'];
                } else {
                    $bons = $consomation->bons;

                    if ($bons->count() < 2) return 0;

                    $firstBon = $bons->first();
                    $lastBon = $bons->last();

                    if (!$firstBon->km || !$lastBon->km) return 0;

                    $kmTotal = $lastBon->km - $firstBon->km;
                    $qtyLittre = $bons->sum('qte_litre') - $firstBon->qte_litre;

                    if (!$qtyLittre || !$kmTotal || $kmTotal <= 0) return 0;

                    $taux = $qtyLittre / $kmTotal * 100;

                    $camion = $consomation->camion;

                    if (!$camion || !$camion->consommation) return 0;

                    $statue = $taux - $camion->consommation;
                }

                $statue = round($statue, 2);
                $consomation->calculated_statue = $statue;

                return $statue;
            });
        });

        // ✅ Sort by smallest to largest sum_statues
        $chaufeursWithSumStatues = $chaufeursWithSumStatues->sortBy('sum_statues')->values();


                $currentMonthStart = Carbon::now()->startOfMonth();


                $currentMonthEnd = Carbon::now()->endOfMonth();

            $stationsData = Station::withSum(['factures as factures_prix_sum' => function ($query) use ($currentMonthStart, $currentMonthEnd) {
                $query->whereBetween('date', [$currentMonthStart, $currentMonthEnd]);
            }],'prix')->get();

            $nearestPapiers = Cache::remember('nearest_papiers', 60 * 24, function () {
                return Papier::whereNotNull('date_fin')
                    ->whereNotNull('days_count')
                    ->orderBy('date_fin', 'asc')
                    ->with('Camion:id,matricule')
                    ->get();
            });
            $nearestFourPapiersToEnd = Cache::remember('nearest_four_papiers_to_end', 60 * 24, function () {
                $today = Carbon::today();

                return Papier::whereNotNull('date_fin')
                    ->whereNotNull('days_count')
                    ->with('Camion:id,matricule')
                    ->get()
                    ->sortBy(function ($papier) use ($today) {
                        // Sort by days remaining (ascending)
                        return $today->diffInDays($papier->date_fin, false);
                    })
                    ->take(4);
            });

            return view('gazole.index', compact("results", "nearestFourPapiersToEnd", "nearestPapiers", "results_2", "chaufeursWithSumStatues", "stationsData"));
        }

    public function SuiviGazoleParChaufeur($id)
    {
        $chauffeur = Chaufeur::with(['Consomations'])
            ->find($id);

        if (!$chauffeur) {
            return response()->json(['error' => 'Chauffeur not found'], 404);
        }

        $chauffeurData = [];

        foreach ($chauffeur->Consomations as $trajet) {
            $month = $trajet->date->format('Y-m');


            if (!isset($chauffeurData[$month])) {
                $chauffeurData[$month] = 0;
            }


            $chauffeurData[$month] += $trajet->QtyLittre;
        }


        return response()->json([$chauffeur->full_name => $chauffeurData]);
    }

    public function showDetails($id)
    {
        $chauffeur = Chaufeur::with('Consomations')
            ->find($id);
        if (!$chauffeur) {
            return response()->json(['error' => 'Chauffeur not found'], 404);
        }
        $chauffeurData = [];
        $prixData = [];
        foreach ($chauffeur->Consomations as $trajet) {
            if ($trajet->status == 1) {
                $date = date_create($trajet->date);
                $month = $date->format('Y-m');
                if (!isset($chauffeurData[$month])) {
                    $chauffeurData[$month] = 0;
                    $prixData[$month] = 0;
                }
                $chauffeurData[$month] += $trajet->QtyLittre;
                $prixData[$month] += $trajet->prix;
            }
        }
        return view('gazole.chaufeur.chart', compact('chauffeurData', 'chauffeur', 'prixData'));
    }

    public function upload(Request $request)
    {
        request()->validate([
            'orders' => 'required|mimes:xlx,xlsx|max:2048'
        ]);
        Excel::import(new OrderImport, $request->file('orders'));
        return back()->with('massage', 'User Imported Successfully');
    }
    public function factures()
    {
        return view('gazole.factures.index');
    }
    public function facturesStatistiques()
    {
        return view('gazole.factures.statistiques');
    }

    function GazoleUsersList()
    {
        $users = User::role('gazole')->get();
        return view('gazole.user.index', compact('users'));
    }

    function CreateBon($id)
    {
        return view('gazole.bon.create', compact("id"));
    }
    function CreateReparationInfo($id)
    {
        return view('gazole.reparation.CreateDetail', compact("id"));
    }
    public function AddBonToConsomation(StoreBonRequest $request, $id)
    {
        $ville = Station::find($request->station_id)->ville;
        $tarif = $request->tarif;
        $qte_litre = $request->qte_litre;
        $km = $request->km_return;
        if ($km <= 0 || $qte_litre <= 0) {
            $qte_litre = 1;
            $km = 1;
        }
        $prix = $tarif * $qte_litre;
        $bons = Bons::create([
            "consomation_id" => $id,
            "qte_litre" => $request->qte_litre,
            "prix" => $prix,
            "station_id" => $request->station_id,
            "ville" => $ville,
            "date" => $request->date,
            "numero_bon" => $request->numero_bon,
            "km" => $km,
            "nature" => $request->nature,
            "description" => $request->description,
        ]);
        if ($request->type == "yes") {
            facture::create([
                "date" => $request->date,
                "prix" => $prix,
                "station_id" => $request->station_id,
                "n_bon" => $request->numero_bon,
            ]);
        }
        return redirect()->route('consomations.index')->with([
            "success" => "bon added successfly"
        ]);
    }

    public function AddInfoToReparation(Request $request, $id)
    {
        $this->validate($request, [
            'reparation_id' => "required",
            'camion_id' => "required",
            'chaufeur_id' => "required",
            'prix' => "required|numeric",
            'date' => "required",
            'nature' => "required",
            'type_id' => "required",
        ]);
        ReparationInfo::create([
            "reparation_id" => $request->reparation_id,
            "camion_id" => $request->camion_id,
            "chaufeur_id" => $request->chaufeur_id,
            "prix" => $request->prix,
            "date" => $request->date,
            "nature" => $request->nature,
            "type_id" => $request->type_id,
        ]);

        return redirect()->route('reparations.index')->with([
            "success" => "reparation info added successfly"
        ]);
    }
    public function EditInfoReparation(Request $request, $id)
    {
        $reparation = ReparationInfo::find($id);
        $this->validate($request, [
            'camion_id' => "required",
            'chaufeur_id' => "required",
            'prix' => "required",
            'date' => "required",
            'nature' => "required",
            'type_id' => "required",
        ]);
        $reparation->update([
            "camion_id" => $request->camion_id,
            "chaufeur_id" => $request->chaufeur_id,
            "prix" => $request->prix,
            "date" => $request->date,
            "nature" => $request->nature,
            "type_id" => $request->type_id,
        ]);

        return redirect()->back()->with([
            "success" => "reparation info Edit successfly"
        ]);
    }
    public function getStations(Request $request)
    {
        $city = $request->city;
        $stations = Station::where('ville', $city)->get();
        return response()->json($stations);
    }

    public function ViewBonsOfTrajet($id)
    {
        $trajet = Consomation::find($id);
        return view('gazole.bon.index', compact("trajet"));
    }

    public function UpdateBon($id, Request $request)
    {
        $bon = Bons::findOrFail($id);
        $bon->update([
            "date" => $request->date,
            "qte_litre" => $request->qte,
            "prix" => $request->prix,
            "km" => $request->km,
            "station_id" => $request->station
        ]);
        if ($request->type == "yes") {
            facture::create([
                "date" => $request->date,
                "prix" => $request->prix,
                "station_id" => $request->station,
                "n_bon" => $request->numero_bon,
            ]);
        }
        return redirect()->back()->with([
            "success" => "bon updated successfully;"
        ]);
    }
    public function DeleteBon($id)
    {
        $bon = Bons::findOrFail($id);
        if ($bon != null) {
            $bon->delete();
            return redirect()->back()->with([
                "success" => "bon deleted successfully;"
            ]);
        };
    }
}
