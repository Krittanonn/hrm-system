<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {   
        // employees table
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            
            $table->foreignId('department_id')->constrained()->onDelete('cascade'); // FK to departments table
            $table->foreignId('position_id')->constrained()->onDelete('cascade'); // FK to positions table
            
            $table->date('hire_date'); // date start work
            $table->string('phone')->nullable(); // can be null
            $table->string('address')->nullable(); 
            
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // FK to users table

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
