<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('Emp_Id')->unique();
            $table->date('End_Date');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->date('Start_Date');
            $table->string('Title')->nullable();
            $table->integer('Assigned_Branch_Id')->nullable();
            // $table->integer('Dept_Id');
            $table->foreignId('Dept_Id')->constrained('Department')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('Superior_Emp_Id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
