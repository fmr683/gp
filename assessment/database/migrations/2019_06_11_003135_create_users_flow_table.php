<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersFlowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_flow', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->date('created_at');
            $table->integer('onboarding_perentage');
            $table->integer('count_applications');
            $table->integer('count_accepted_applications');

            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_flow');
    }
}
