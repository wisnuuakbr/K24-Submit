<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role',['admin', 'member']); // 'admin' for Administrator, 'member' for Member
            $table->string('nama', 255);
            $table->string('email', 255)->unique();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin',['L', 'P'])->nullable();
            $table->string('no_hp',15)->nullable();
            $table->string('no_ktp',16)->nullable();
            $table->string('foto_path', 255)->nullable(); // Path to the uploaded photo
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}