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
        if(!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->references('id')->on('orders');
                $table->decimal('amount');
                $table->string('status',45);
                $table->string('type',45);
//            $table->foreignId(\App\Models\User::class, 'created_by')->nullable();
//            $table->foreignId(\App\Models\User::class, 'updated_by')->nullable();
                $table->timestamps();

            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
