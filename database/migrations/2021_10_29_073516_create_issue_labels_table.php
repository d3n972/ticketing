<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_labels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('label')->constrained('labels','id');
            $table->foreignId('issue')->constrained('issues','id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_labels');
    }
}
