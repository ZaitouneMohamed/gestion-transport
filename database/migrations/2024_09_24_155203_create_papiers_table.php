    <?php

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
            Schema::create('papiers', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->date('date_debut');
                $table->date('date_fin');
                $table->text('description')->nullable();
                $table->integer('etat')->default(0);
                $table->foreignId('camion_id')->unsigned();
                $table->foreign('camion_id')->references('id')->on('camions')->onDelete('cascade');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('papiers');
        }
    };
