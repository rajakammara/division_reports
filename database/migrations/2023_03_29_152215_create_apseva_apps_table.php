<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApsevaAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apseva_apps', function (Blueprint $table) {
            $table->id();
            $table->string('mandal_name');
            $table->string('sec_name');
            $table->string('department');
            $table->string('service_name');
            $table->string('app_number');            
            $table->string('sla_status');
            $table->string('rural_urban');
            $table->string('app_date');
            $table->integer('sla');
            $table->string('div_name')->nullable();
            $table->string('new_mandal_name')->nullable();
            $table->string('admin_remarks')->nullable();
            $table->string('user_remarks')->nullable();
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
        Schema::dropIfExists('apseva_apps');
    }
}
