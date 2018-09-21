<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('organization');
            $table->text('summary');
            $table->string('address');
            $table->integer('phone');
            $table->string('email');
            $table->string('submitted_by');
            $table->text('background');         
            $table->text('activities');
            $table->integer('budget');           
            $table->boolean('draft')->default(false);
            $table->text('stage')->nullable();

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
        Schema::dropIfExists('proposals');
    }
}
