<?php
use App\Models\User;
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
        if(!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->decimal('total_price', 20, 2);
                $table->string('status', 10, 2);
                $table->timestamps();
            });
//            Schema::create('orders', function (Blueprint $table) {
//                $table->foreignId(User::class, 'created_by')->nullable();
//                $table->foreignId(User::class, 'updated_by')->nullable();
//            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};