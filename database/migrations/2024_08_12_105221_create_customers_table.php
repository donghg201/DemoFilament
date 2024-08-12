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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('Cust_Id')->unique();
            $table->string('Address')->nullable();
            $table->string('City')->nullable();
            $table->string('Cust_Type_Id');
            $table->string('Fed_Id');
            $table->string('Postal_Code')->nullable();
            $table->string('State')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
