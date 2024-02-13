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
        Schema::create('lyc_situations', function (Blueprint $table) {
            $table->id();
            $table->string('Number_manko', 50);
            $table->bigInteger( 'Phase_id' )->unsigned();
            $table->foreign('Phase_id')->references('id')->on('phases')->onDelete('cascade');
            $table->string('Etablissement', 200);
            $table->string('Number_hk', 50);

            $table->decimal('Credit_OSB',11,2)->nullable();
            $table->decimal('Revenues_OSB',11,2);
            $table->decimal('Expenses_OSB',11,2);
            $table->decimal('Credit_Fin_Month_OSB',11,2);

            $table->decimal('Credit_OIEB',11,2)->nullable();
            $table->decimal('Revenues_OIEB',11,2);
            $table->decimal('Expenses_OIEB',11,2);
            $table->decimal('Credit_Fin_Month_OIEB',11,2);

            $table->decimal('Total',11,2);
            $table->text('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lyc_situations');
    }
};
