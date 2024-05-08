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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('time_ordered');
            $table->enum('state', ['new','prepared','sent','delivered']);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('street_name', 64);
            $table->integer('zip_code');
            $table->string('phonenumber', 16);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
