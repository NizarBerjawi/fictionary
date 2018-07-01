<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->uuid('role_uuid');
            $table->uuid('user_uuid');

            $table->index(['role_uuid', 'user_uuid']);
            $table->foreign('role_uuid')->references('uuid')->on('roles');
            $table->foreign('user_uuid')->references('uuid')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_user', function(Blueprint $table) {
            $table->dropForeign(['role_uuid']);
            $table->dropForeign(['user_uuid']);
        });

        Schema::dropIfExists('role_user');
    }
}
