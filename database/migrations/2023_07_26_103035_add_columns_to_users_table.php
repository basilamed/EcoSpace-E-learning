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
            $table->string('surname')->nullable();
            $table->string('username')->unique()->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('contact')->nullable();
            $table->string('birthPlace')->nullable();
            $table->string('birthCountry')->nullable();
            $table->string('birthDate')->nullable();
            $table->string('jmbg')->nullable();
            $table->string('role')->nullable();
            $table->string('picture')->nullable();
            $table->string('approved')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['surname', 'username', 'gender', 'contact', 'birthPlace', 'birthCountry', 'birthDate', 'jmbg', 'role', 'picture', 'approved']);
        });
    }
};
