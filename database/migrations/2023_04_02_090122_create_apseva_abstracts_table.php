<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApsevaAbstractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apseva_abstracts', function (Blueprint $table) {
            $table->id();
            $table->string('mandal_name');
            $table->string('department');
            $table->integer('total_req');
            $table->integer('beyond_sla');
            $table->integer('within_sla');
            $table->integer('lapsing24hrs');
            $table->integer('lapsing48hrs');
            $table->string('rural_urban');
            $table->string('div_name')->nullable();
            $table->string('new_mandal_name')->nullable();
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
        Schema::dropIfExists('apseva_abstracts');
    }
}
