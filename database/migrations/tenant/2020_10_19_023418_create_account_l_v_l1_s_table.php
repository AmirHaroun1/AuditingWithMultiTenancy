<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountLVL1STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_lvl_1', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('code');
            $table->string('name');
            $table->text('procedures')->nullable();
            $table->text('policies')->nullable();
            $table->text('international_measurement')->nullable();
            $table->text('accounting_term')->nullable();

            $table->text('considerations')->nullable();
            $table->text('study')->nullable();
            $table->text('second_study')->nullable();



            $table->boolean('is_related_party')->nullable();

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
        Schema::dropIfExists('accounts_lvl_1');
    }
}
