<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('website')->nullable();
            $table->string('service_pkj')->nullable();
            $table->string('email')->unique();
            $table->string('industry')->nullable();
            $table->string('location')->nullable();
            $table->string('client_type')->nullable();
            $table->string('website_type')->nullable();
            $table->string('notes')->nullable();
            $table->string('password')->nullable();
            $table->string('picture')->nullable();
            $table->string('phone')->nullable();
            $table->string('user_Type')->nullable();
            $table->string('role')->nullable();
            $table->string('token')->nullable();
            $table->timestamp('token_expire')->nullable();
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
        Schema::dropIfExists('users');
    }
}
