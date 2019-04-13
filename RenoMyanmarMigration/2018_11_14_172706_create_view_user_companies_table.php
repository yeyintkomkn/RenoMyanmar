<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades;

class CreateViewUserCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql="SELECT companies.*
                FROM companies
                WHERE companies.verify=1 
                AND companies.status=1";
        Facades\DB::statement("
                      CREATE VIEW view_user_companies AS
                      SELECT companies.*
                FROM companies
                WHERE companies.verify=1 
                AND companies.status=1
                    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_user_companies');
    }
}
