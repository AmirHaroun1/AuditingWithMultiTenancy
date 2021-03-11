<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountLVL3STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_lvl_3', function (Blueprint $table) {

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

            $table->foreignId('top_parent_id')->nullable();
            $table->foreign('top_parent_id')
                ->references('id')
                ->on('accounts_lvl_1')
                ->onDelete('cascade');

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('accounts_lvl_2')
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
        Schema::dropIfExists('accounts_lvl_3');
    }
}
