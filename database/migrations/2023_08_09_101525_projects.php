<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->string('project_name');
            $table->string('company');
            $table->string('notes')->nullable();
            $table->string('project_category')->nullable();
            $table->json('access_to_users')->nullable();
            $table->binary('fvrt')->default(0);
            $table->unsignedBigInteger('owner')->nullable();
            $table->timestamps();

            $table->foreign('owner')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
