<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenreablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genreables', function (Blueprint $table) {
            $table->uuid('genre_uuid');
            $table->uuid('genreable_uuid');
            $table->string('genreable_type');

            $table->primary(['genre_uuid', 'genreable_uuid', 'genreable_type']);
            $table->foreign('genre_uuid')->references('uuid')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genreables');
    }
}
