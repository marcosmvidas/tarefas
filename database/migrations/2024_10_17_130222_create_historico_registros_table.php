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
        Schema::create('historico_registros', function (Blueprint $table) {
            $table->id();
            $table->string('model_name');
            $table->bigInteger('record_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('action');
            $table->text('changes')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historico_registros');
    }
};
