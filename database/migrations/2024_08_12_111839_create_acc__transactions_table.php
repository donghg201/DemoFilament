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
        Schema::create('acc__transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('Txn_Id')->unique();
            $table->float('Amount');
            $table->timestamp('Funds_Avail_Date');
            $table->timestamp('Txn_Date');
            $table->foreignId('Account_Id')->constrained('Account')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('Execution_Branch_Id')->nullable();
            $table->integer('Teller_Emp_Id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acc__transactions');
    }
};
