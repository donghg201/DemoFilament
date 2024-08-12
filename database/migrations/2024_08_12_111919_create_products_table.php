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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Id')->unique();
            $table->date('Date_Offered')->nullable();
            $table->date('Date_Retired')->nullable();
            $table->string('Name')->nullable();
            // $table->string('Product_Type_Id');
            $table->foreignId('Product_Type_Id')->constrained('Product_Type')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
