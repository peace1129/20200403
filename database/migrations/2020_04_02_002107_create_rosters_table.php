<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rosters', function (Blueprint $table) {
            $table->Increments('user_id');
            $table->string('lastName');
            $table->string('firstName');
            $table->char('gender',1);
            $table->string('pref');
            $table->string('address');
            $table->string('grp_name')->unsigned();
            $table->timestamps();
            
            $table->foreign('grp_name')
                  ->references('grp_name')
                  ->on('groups')
                  ->onDelete('set null')
                  ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rosters');
    }
}
