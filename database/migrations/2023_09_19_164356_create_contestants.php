<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contestants', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('contest_id');
            $table->unsignedBigInteger('referral_id');
            $table->integer('start_position')->default(99);
            $table->integer('current_position');

            $table->foreign('contest_id')
                ->references('id')
                ->on('contests')
                ->onDelete('cascade');
            $table->foreign('referral_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contestants');
    }
};
