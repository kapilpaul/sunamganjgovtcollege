<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('mobile_no');
            $table->string('image');
            $table->date('date_of_birth');
            $table->string('admission_year');
            $table->string('class');
            $table->string('group');
            $table->string('subject');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('occupation')->nullable();
            $table->text('occupation_details')->nullable();
            $table->integer('current_student')->default(0);
            $table->integer('outside_of_bd')->default(0);
            $table->integer('only_register')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
