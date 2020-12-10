<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_holidays', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->date('date');
            $table->string('title')->nullable();

            $table->timestamps();

            $table->unsignedBigInteger('work_type_id');

            $table
                ->foreign('work_type_id')
                ->references('id')
                ->on('holiday_work_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holiday_holidays');
    }
}
