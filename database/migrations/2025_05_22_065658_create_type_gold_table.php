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
            $table->string('name_vn')->nullable();
            $table->string('name_en')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('prices', function (Blueprint $table) {
            $table->foreign('type')->references('id')->on('type_gold')->onDelete('cascade');
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
