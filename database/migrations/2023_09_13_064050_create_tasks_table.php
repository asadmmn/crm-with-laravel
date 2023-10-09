<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('doer');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('priority')->nullable();
            $table->integer('progress')->nullable();
            $table->integer('est_hours')->nullable();
            $table->integer('est_minutes')->nullable();
            
            // Define the foreign key column
            $table->unsignedBigInteger('task_list_id');
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('task_list_id')->references('id')->on('task_lists')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
