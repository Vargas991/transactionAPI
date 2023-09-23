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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->float('monto');
            $table->string('tipo');
            $table->float('balance');
            $table->unsignedBigInteger('cuenta_id');
            
            $table->timestamps();
            
            $table
                ->foreign('cuenta_id')
                ->references('id')
                ->on('cuentas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
