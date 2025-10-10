<?php
use App\Models\Papier;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('papiers', function (Blueprint $table) {
            $table->integer("days_count")->nullable();
            $table->date('last_notification')->nullable();
        });

        foreach (Papier::all() as $item) {
            $datedebut = Carbon::parse($item->date_debut);
            $datefin = Carbon::parse($item->date_fin);

            $diff = $datefin->diffInDays($datedebut);

            // Ensure that lastNotif is a Carbon instance
            if ($item->date_fin > Carbon::now()) {
                $lastNotif = Carbon::parse($item->date_debut);
            } else {
                $lastNotif = Carbon::parse($item->date_fin);
            }

            // Ensure nextNotif is a Carbon instance before using copy() and addDays()
            $nextNotif = $lastNotif->copy()->addDays($diff);

            $item->update([
                "days_count" => $diff,
                "last_notification" => $lastNotif,
            ]);
        }
    }
};
