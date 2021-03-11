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
            $table->text('procedures')->default('');
            $table->text('policies')->default('');
            $table->text('international_measurement')->default('');
            $table->text('accounting_term')->default('');

            $table->text('considerations')->nullable()->default('');
            $table->text('study')->nullable()->default('');
            $table->text('second_study')->nullable()->default('');


            $table->foreignId('Financial_group_id')->nullable();
            $table->foreign('Financial_group_id')
                ->references('id')
                ->on('financial_groups')
                ->onDelete('cascade');

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
