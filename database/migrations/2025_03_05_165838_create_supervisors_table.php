<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
            $table->string('SupervisorEmail')->primary();
            $table->string('SupervisorFirstName');
            $table->string('SupervisorLastName');
            $table->string('SupervisorPhoneNumber');
            $table->string('ProjectCode');
            $table->foreign('ProjectCode')->references('ProjectCode')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('supervisors');
    }
};
