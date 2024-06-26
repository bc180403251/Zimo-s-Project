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
            $table->String('first_name');
            $table-> String('last_name');
            $table-> String('email');
            $table -> String('phone');
            $table -> String('gender');
            $table -> softDeletes('deleted_at');
//            $table ->id('company_id');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
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
