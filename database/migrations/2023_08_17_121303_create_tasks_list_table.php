<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_lists', function (Blueprint $table) {
            $table->id();
            $table->string('task_list_name');
            $table->string('template'); // You might want to change this to an appropriate type
            $table->text('notes')->nullable();
            $table->integer('users');
            $table->boolean('pin_task_list');
            $table->string('time');
            $table->unsignedBigInteger('projects_id'); // Added this line for the foreign key
            $table->timestamps();
    
            $table->foreign('projects_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_lists');
    }
}
