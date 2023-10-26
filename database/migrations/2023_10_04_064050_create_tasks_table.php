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
            // $table->string('file_name');
            $table->string('doer');
            $table->date('start_date');
            $table->date('due_date');
            $table->unsignedBigInteger('pro_id');
            $table->unsignedBigInteger('task_list_id')->nullable(); // This makes task_list_id nullable
            $table->text('notes')->nullable(); // This makes notes nullable
            $table->string('priority')->nullable(); // This makes priority nullable
            $table->integer('progress')->nullable(); // This makes progress nullable
            $table->integer('est_hours')->nullable(); // This makes est_hours nullable
            $table->integer('est_minutes')->nullable(); // This makes est_minutes nullable
            // $table->string('status')->nullable(); // This makes status nullable
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
        Schema::dropIfExists('tasks');
    }
}
