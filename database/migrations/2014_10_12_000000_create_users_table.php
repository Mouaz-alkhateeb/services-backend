<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
        $table->bigIncrements('id');
        $table->string('name');
        $table->string('email');
        $table->string('password');
        $table->string('provider_id')->nullable();
        $table->string('avatar')->nullable();
        $table->text('roles_name')->default('["customer"]');
        $table->string('status')->default('غير نشط');
        $table->timestamp('last_seen')->nullable();
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