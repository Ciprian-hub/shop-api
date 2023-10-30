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
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('states');
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->json('states')->nullable()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('states');
        });
        Schema::table('countries', function (Blueprint $table) {
            $table->string('states')->nullable();
        });
    }
};
