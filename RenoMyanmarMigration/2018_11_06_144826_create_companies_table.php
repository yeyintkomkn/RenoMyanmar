<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('email');
            $table->string('phone');
            $table->string('facebook_url')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->double('google_map_lat')->nullable();
            $table->double('google_map_lon')->nullable();
            $table->string('type')->nullable();
            $table->string('vision_and_mission')->nullable();
            $table->string('what_we_do')->nullable();
            $table->string('why_join_us')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
