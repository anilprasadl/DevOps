<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_environments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('app_details_id')->unsigned()->nullable();
            $table->foreign('app_details_id')->references('id')->on('app_details')->onDelete('cascade');
            $table->string('url');
            $table->string('ip');
            $table->string('port');
            $table->string('provider');
            $table->string('instance_family');
            $table->string('deploy_hook');
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_environments');
    }
}
