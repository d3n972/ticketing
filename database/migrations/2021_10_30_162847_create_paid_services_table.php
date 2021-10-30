<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_services', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); //may be used to indicate when the proposal was rejected 
            $table->foreignId('issue')->constrained('issues','id');
            $table->foreignId('author')->constrained('users','id');
            $table->foreignId('client_assignee')->constrained('users','id');
            $table->string('public_id');
            $table->longtext('description')->nullable();
            $table->integer('status')->default(0); //
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paid_services');
    }
}
