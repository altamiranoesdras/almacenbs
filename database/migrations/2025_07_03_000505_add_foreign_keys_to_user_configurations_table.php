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
        Schema::table('user_configurations', function (Blueprint $table) {
            $table->foreign(['user_id'], 'fk_user_configurations_users1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_configurations', function (Blueprint $table) {
            $table->dropForeign('fk_user_configurations_users1');
        });
    }
};
