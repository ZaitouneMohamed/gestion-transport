<?php
use App\Models\Papier;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('papiers', function (Blueprint $table) {
           $table->integer("days_count")->nullable();
           $table->date('last_notification')->nullable();
        });

        $today = Carbon::today();

        foreach (Papier::all() as $item) {
            echo "\n=== Processing Papier ID: {$item->id} - {$item->title} ===\n";

            if (!$item->date_debut || !$item->date_fin) {
                echo "⚠ Skipping: Missing dates\n";
                continue;
            }

            $datedebut = Carbon::parse($item->date_debut)->startOfDay();
            $datefin = Carbon::parse($item->date_fin)->startOfDay();

            echo "date_debut: {$datedebut->format('Y-m-d')}\n";
            echo "date_fin (before): {$datefin->format('Y-m-d')}\n";

            $cycleLength = abs($datedebut->diffInDays($datefin));

            if ($cycleLength == 0) {
                $cycleLength = 365;
            }

            echo "cycle_length: {$cycleLength} days\n";

            if ($datefin->lessThanOrEqualTo($today)) {
                echo "Status: OVERDUE\n";

                $daysSinceFin = $datefin->diffInDays($today);
                $cyclesPassed = floor($daysSinceFin / $cycleLength);

                echo "Days since fin: {$daysSinceFin}\n";
                echo "Cycles passed: {$cyclesPassed}\n";

                $newDateFin = $datefin->copy()->addDays(($cyclesPassed + 1) * $cycleLength);

                while ($newDateFin->lessThanOrEqualTo($today)) {
                    $newDateFin->addDays($cycleLength);
                }

                $lastNotif = $newDateFin->copy()->subDays($cycleLength);

                echo "new date_fin: {$newDateFin->format('Y-m-d')}\n";
                echo "last_notification: {$lastNotif->format('Y-m-d')}\n";

                $item->days_count = $cycleLength;
                $item->last_notification = $lastNotif;
                $item->date_fin = $newDateFin;
                $item->save();

            } else {
                echo "Status: FUTURE\n";
                echo "date_fin (unchanged): {$datefin->format('Y-m-d')}\n";
                echo "last_notification: {$datedebut->format('Y-m-d')}\n";

                $item->days_count = $cycleLength;
                $item->last_notification = $datedebut;
                $item->save();
            }

            // Verify after save
            $item->refresh();
            echo "AFTER SAVE:\n";
            echo "  days_count: {$item->days_count}\n";
            echo "  last_notification: " . ($item->last_notification ? $item->last_notification->format('Y-m-d') : 'NULL') . "\n";
            echo "  date_fin: " . ($item->date_fin ? $item->date_fin->format('Y-m-d') : 'NULL') . "\n";
        }
    }
};
