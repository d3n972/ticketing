<?php

use App\Models\Severity;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeveritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('severities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\models\User::class,'owner');
            $table->string('name');
            $table->string('css_classes')->default('bg-white text-black');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('issues', function (Blueprint $table) {

            $table->foreignId('author')->constrained('users','id')->default(1);
            $table->foreignId('assignee')->constrained('users','id')->default(1);
            $table->foreignId('project')->constrained('teams');
            $table->foreignId('severity')->constrained()->default(1);

        });
        $levels=[['No impact / Informational','bg-gray-100 text-black'], ['Low','bg-gray-300 text-black'], ['Minor','bg-green-600'],['Major','bg-yellow-800'], ['Severe','bg-red-700'],['Critical','bg-red-800']];
        foreach ($levels as $sev) {
            $s=new Severity();
            $s->owner=1;
            $s->name=$sev[0];
            $s->css_classes=$sev[1];
            $s->save();

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('severities');
    }
}
