<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccountClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_clients', function (Blueprint $table) {
            $table->integer('province_id')->default(0)->nullable()->after('date_of_birth');
            $table->integer('district_id')->default(0)->nullable()->after('province_id');
            $table->integer('ward_id')->default(0)->nullable()->after('province_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_clients', function (Blueprint $table) {
            //
        });
    }
}
