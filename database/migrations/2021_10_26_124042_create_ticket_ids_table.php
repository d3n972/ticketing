<?php

use App\Models\TicketId;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketIdsTable extends Migration{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up(){
    Schema::create('ticket_ids', function(Blueprint $table){
      $table->id();
      $table->timestamps();
      $table->foreignId('project')->unique()->constrained('teams', 'id')->default(1);
      $table->string('pattern')->default('T-######');
      $table->unsignedBigInteger('current')->default(1);
    });

    Schema::table('issues', function(Blueprint $table){
      $table->string('ticket_id')->default('MIGRATED');
    });
    foreach(\App\Models\Team::all() as $model){
      if(TicketId::where('project', $model->id)->count() != 1){
        $tid = new TicketId();
        $tid->project = $model->id;
        $tid->save();
      }
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down(){
    Schema::dropIfExists('ticket_ids');
  }
}
