<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_clients', function (Blueprint $table) {
            $table->id();
            $table->string('username', 256)->default('')->nullable();
            $table->string('password', 256)->default('')->nullable();
            $table->string('email', 256)->default('')->nullable();
            $table->string('phone', 50)->default('')->nullable();
            $table->string('link_fb', 256)->default('')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address', 256)->default('')->nullable();
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
        Schema::dropIfExists('account_clients');
    }
}
