<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewMainCategoryCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement("
                      create view view_main_category_companies as
                      select sub_category_companies.*,sub_categories.main_category_id
                      from sub_category_companies
                      left join sub_categories 
                      on sub_category_companies.subcategory_id=sub_categories.id
                      ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_main_category_companies');
    }
}
