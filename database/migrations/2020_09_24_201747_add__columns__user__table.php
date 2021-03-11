<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('national_id')->after('id')->nullable();
            $table->string('phone')->after('name')->nullable();
            $table->string('role')->after('email_verified_at')->nullable();
            $table->date('birth_date')->after('phone')->nullable();
            $table->date('national_id_date')->after('national_id')->nullable();
            $table->text('signature')->after('phone')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
