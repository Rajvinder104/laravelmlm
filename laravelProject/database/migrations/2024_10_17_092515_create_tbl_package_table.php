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
        Schema::create('tbl_package', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('price');
            $table->unsignedBigInteger('commision');
            $table->string('days');
            $table->string('direct_income');
            $table->string('level_income');
            $table->string('roi_income');
            $table->unsignedBigInteger('capping');
            $table->string('direct_percent');
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_package');
    }
};
