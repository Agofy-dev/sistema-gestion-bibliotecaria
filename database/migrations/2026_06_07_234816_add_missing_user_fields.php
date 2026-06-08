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
            $table->string('second_name');
            $table->string('last_name');
            $table->string('second_last_name');
            $table->boolean('status')->default(true);
            $table->boolean('disabled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'second_name',
                'last_name',
                'second_last_name',
                'status',
                'disabled',
            ]);
        });
    }
};
