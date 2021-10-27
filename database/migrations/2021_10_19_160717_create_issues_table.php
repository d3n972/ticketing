<?php

use App\Models\Project;
use App\Models\Severity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * The commented out foreign keys will be added by the severities migration,
         * because we can't add foreign key for a field which not yet exists.
         */
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('author')->constrained('users','id')->default(1);
            // $table->foreignId('assignee')->constrained('users','id')->default(1);
            $table->string('title');
            $table->longText('content');
            // $table->foreignId('project')->constrained('teams');
            // $table->foreignId('severity')->constrained()->default(1);
            $table->integer('status')->default(-1);
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
        Schema::dropIfExists('issues');
    }
}
