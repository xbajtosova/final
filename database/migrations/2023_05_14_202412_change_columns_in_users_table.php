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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_teacher')->default(false);
            $table->integer('generated_examples')->default(0);
            $table->integer('solved_examples')->default(0);
            $table->integer('points')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_teacher');
            $table->dropColumn('generated_examples');
            $table->dropColumn('solved_examples');
            $table->dropColumn('points');
        });
    }
};
