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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('diachi')->nullable();
            $table->string('note')->nullable();
            $table->text('moreinfo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('type_gold', function (Blueprint $table) {
            $table->foreign('companies_id')->references('id')->on('type_gold')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
