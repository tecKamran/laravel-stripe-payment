<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->string('user_email')->nullable();
        $table->string('stripe_charge_id');
        $table->integer('amount');
        $table->string('currency');
        $table->string('status');
        $table->string('payment_method')->nullable();
$table->string('description')->nullable();
$table->string('receipt_url')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
