<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToSupervisorsTable extends Migration
{
    public function up()
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->string('password')->nullable()->after('SupervisorPhoneNumber');
        });
    }

    public function down()
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
}
