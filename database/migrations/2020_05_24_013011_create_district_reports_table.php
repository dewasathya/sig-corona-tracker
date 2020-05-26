<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->date('report_date');
            $table->integer('foreign_travel_agent_foreign');
            $table->integer('foreign_travel_agent_indonesian');
            $table->integer('domestic_travel_agent');
            $table->integer('local_transmission');
            $table->integer('other_positive');
            $table->integer('total_positive');
            $table->integer('treated');
            $table->integer('recovered');
            $table->integer('died');
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
        Schema::dropIfExists('district_reports');
    }
}
