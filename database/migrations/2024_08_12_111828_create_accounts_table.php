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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('User')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('Account_Id')->unique();
            $table->float('Avail_Balance')->nullable();
            $table->date('Close_Date')->nullable();
            $table->date('Last_Activity_Date')->nullable();
            $table->date('Open_Date');
            $table->float('Pending_Balance')->nullable();
            $table->string('Status')->nullable();
            $table->foreignId('Cust_Id')->constrained('Customer')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Open_Branch_Id')->constrained('Branch')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Open_Emp_Id')->constrained('Employee')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('Product_Id')->constrained('Product')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
