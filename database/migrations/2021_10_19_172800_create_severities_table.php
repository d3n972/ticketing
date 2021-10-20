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
            $table->timestamps();
            $table->softDeletes();
        });

        $levels=['No impact / Informational', 'Low', 'Minor','Major', 'Severe','Critical'];
        foreach ($levels as $sev) {
            $s=new Severity();
            $s->owner=1;
            $s->name=$sev;
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
