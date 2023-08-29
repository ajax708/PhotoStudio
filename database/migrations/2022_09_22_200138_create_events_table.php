<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('event_type');
            $table->date('event_startdate');
            $table->date('event_endate');
            $table->time('event_starthour');
            $table->time('event_endhour');
            $table->string('event_qr')->nullable();
            $table->string('event_status')->nullable();
            $table->decimal('latitude',8,6);
            $table->decimal('longitude', 9,6);
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
        Schema::dropIfExists('events');
    }
}
