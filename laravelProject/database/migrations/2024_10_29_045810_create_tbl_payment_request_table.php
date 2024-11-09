<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_payment_request', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('payment_method')->nullable();
            $table->string('amount')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(0);
            $table->string('remarks')->nullable();
            $table->string('type')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_payment_request');
    }
};
