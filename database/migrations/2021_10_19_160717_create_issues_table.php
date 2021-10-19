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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class,'author');
            $table->foreignIdFor(User::class,'assignee')->nullable();  
            $table->string('title');
            $table->longText('content');
            $table->foreignIdFor(Project::class,'project');
            $table->foreignIdFor(Severity::class,'severity')->default(0);
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
