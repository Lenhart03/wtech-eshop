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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('user_group', ['basic', 'admin']);
        });

        DB::table('users')->insert(array(
            'firstname' => 'Admin',
            'lastname' => '',
            'email' => 'admin@pcpartshop.sk',
            'password' => '$2y$12$L.PxYFDpOTXcE7HfJTdOlO.DGkoUprfQtyUKM4L/iu80qMFVpmB0S',
            'user_group' => 'admin',
        ));
        DB::table('users')->insert(array(
            'firstname' => 'Jan',
            'lastname' => 'Lenhart',
            'email' => 'jan.lenhart2003@gmail.com',
            'password' => '$2y$12$L.PxYFDpOTXcE7HfJTdOlO.DGkoUprfQtyUKM4L/iu80qMFVpmB0S',
            'user_group' => 'basic',
        ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
