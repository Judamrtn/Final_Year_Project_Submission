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
        Schema::table('projects', function (Blueprint $table) {
            // Add the SupervisorEmail column
            $table->string('SupervisorEmail')->nullable();

            // Add foreign key constraint
            $table->foreign('SupervisorEmail')
                  ->references('SupervisorEmail')
                  ->on('supervisors')
                  ->onDelete('set null'); // Set null on delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['SupervisorEmail']);

            // Drop the SupervisorEmail column
            $table->dropColumn('SupervisorEmail');
        });
    }
};
