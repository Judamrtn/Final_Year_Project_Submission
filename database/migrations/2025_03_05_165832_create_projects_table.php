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
     Schema::create('projects', function (Blueprint $table) {
    $table->string('ProjectCode')->primary();
    $table->string('ProjectName');
    $table->text('ProjectProblems');
    $table->text('ProjectSolutions');
    $table->text('ProjectAbstract');
    $table->string('DepartmentCode');
    $table->string('StudentRegNumber'); // Add this column
    $table->string('ProjectDissertation');
    $table->string('ProjectSourceCodes');
    $table->string('Status')->default('Pending');
    $table->timestamps();

    // Foreign key constraints
    $table->foreign('DepartmentCode')->references('DepartmentCode')->on('departments')->onDelete('cascade');
    $table->foreign('StudentRegNumber')->references('StudentRegNumber')->on('students')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
