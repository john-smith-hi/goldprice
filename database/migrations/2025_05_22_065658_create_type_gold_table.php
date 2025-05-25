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
        Schema::create('type_gold', function (Blueprint $table) {
            $table->id();
            $table->integer('companies_id');
            $table->string('name_vn')->nullable();
            $table->string('name_en')->nullable();
            $table->string('note')->nullable(); 
            $table->integer('type')->default(0); // 0/1 : trong nước/quốc tế
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_gold');
    }
};
