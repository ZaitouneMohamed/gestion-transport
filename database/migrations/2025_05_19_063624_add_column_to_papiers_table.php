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
         $data = Papier::all();
        foreach ($data as $item) {
            $datedebut = Carbon::parse($item->date_debut);
            $datefin = Carbon::parse($item->date_fin);

            $diff = $datefin->diffInDays($datedebut);

            $lasnNotif = null;

            if ($item->date_fin > Carbon::now()) {
                $lastNotif = $item->date_debut;
            } else{
                $lastNotif = $item->date_fin;
            }

            $item->update([
                "days_count" => $diff * (-1),
                "last_notification" => $lastNotif
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('papiers', function (Blueprint $table) {
            $table->dropColumn("days_count");
            $table->dropColumn("last_notification");
        });
    }
};
