<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpenHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->bigInteger('timetable_id')->unsigned()->nullable();
            $table->foreign('timetable_id')->references('id')->on('timetables')->onDelete('set null');
            $table->timestamps();
        });

        $this->load();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_hours');
    }

    private function load()
    {
        $t = new \App\Models\Timetable();
        $t->id = 1;
        $t->day = 'Monday';
        $t->key_day = 1;
        $t->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 12:30:00';
        $h->end = '1999-01-01 17:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 19:00:00';
        $h->end = '1999-01-01 23:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $t = new \App\Models\Timetable();
        $t->id = 2;
        $t->day = 'Tuesday';
        $t->key_day = 2;
        $t->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 12:30:00';
        $h->end = '1999-01-01 17:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 19:00:00';
        $h->end = '1999-01-01 23:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $t = new \App\Models\Timetable();
        $t->id = 3;
        $t->day = 'Wednesday';
        $t->key_day = 3;
        $t->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 12:30:00';
        $h->end = '1999-01-01 17:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 19:00:00';
        $h->end = '1999-01-01 23:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $t = new \App\Models\Timetable();
        $t->id = 4;
        $t->day = 'Thursday';
        $t->key_day = 4;
        $t->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 12:30:00';
        $h->end = '1999-01-01 17:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 19:00:00';
        $h->end = '1999-01-01 23:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $t = new \App\Models\Timetable();
        $t->id = 5;
        $t->day = 'Friday';
        $t->key_day = 5;
        $t->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 12:30:00';
        $h->end = '1999-01-01 17:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 19:00:00';
        $h->end = '1999-01-01 23:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $t = new \App\Models\Timetable();
        $t->id = 6;
        $t->day = 'Saturday';
        $t->key_day = 6;
        $t->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 12:30:00';
        $h->end = '1999-01-01 17:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $h = new \App\Models\OpenHour();
        $h->start = '1999-01-01 19:00:00';
        $h->end = '1999-01-01 23:00:00';
        $h->timetable_id = $t->id;
        $h->save();

        $t = new \App\Models\Timetable();
        $t->id = 7;
        $t->day = 'Sunday';
        $t->key_day = 0;
        $t->save();
    }
}
