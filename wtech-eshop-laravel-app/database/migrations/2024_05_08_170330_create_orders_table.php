<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->date('time_ordered');
            $table->enum('state', ['new','prepared','sent','delivered']);
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->enum('transport_type', ['balikomat','kurier','pobocka']);
            $table->string('street_name', 64)->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('phone_number', 16);
            $table->enum('payment', ['kartou','dobierkou']);
        });

        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'new',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'prepared',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'sent',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'delivered',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'new',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'prepared',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'sent',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'delivered',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'new',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'prepared',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'sent',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'delivered',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'new',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'prepared',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'sent',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
        DB::table('orders')->insert(array(
            'user_id' => 1,
            'time_ordered' => '1970-01-01',
            'state' => 'delivered',
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'transport_type' => 'balikomat',
            'street_name' => 'street_name',
            'zip_code' => 0,
            'phone_number' => 'phonenumber',
            'payment' => 'dobierkou',
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
