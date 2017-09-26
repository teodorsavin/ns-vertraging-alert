<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->index();
            $table->string('short_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('long_name')->nullable();
            $table->string('country');
            $table->string('uic_code');
            $table->decimal('latitude', 9, 7);
            $table->decimal('longitude', 9, 7);
            $table->string('type');
            $table->string('synonyms');
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
        Schema::dropIfExists('stations');
    }
}
