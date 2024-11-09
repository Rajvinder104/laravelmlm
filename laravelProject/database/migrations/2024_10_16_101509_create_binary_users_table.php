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
        Schema::create('binary_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('upline_id')->nullable();
            $table->string('last_left')->nullable();
            $table->string('last_right')->nullable();
            $table->string('left_node')->nullable();
            $table->string('right_node')->nullable();
            $table->string('position')->nullable();
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binary_users');
    }
};
