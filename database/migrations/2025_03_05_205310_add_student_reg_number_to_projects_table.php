<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentRegNumberToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Check if the column already exists
        if (!Schema::hasColumn('projects', 'StudentRegNumber')) {
            Schema::table('projects', function (Blueprint $table) {
                // Add the StudentRegNumber column
                $table->string('StudentRegNumber')->after('DepartmentCode');
            });

            // Add foreign key constraint
            Schema::table('projects', function (Blueprint $table) {
                $table->foreign('StudentRegNumber')
                      ->references('StudentRegNumber')
                      ->on('students')
                      ->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the foreign key constraint if it exists
            if (Schema::hasColumn('projects', 'StudentRegNumber')) {
                $table->dropForeign(['StudentRegNumber']);
            }

            // Drop the StudentRegNumber column if it exists
            if (Schema::hasColumn('projects', 'StudentRegNumber')) {
                $table->dropColumn('StudentRegNumber');
            }
        });
    }
}