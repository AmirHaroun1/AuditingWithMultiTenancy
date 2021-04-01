<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountLVL4STable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_lvl_4', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('code');
            $table->string('name')->nullable();
            $table->text('procedures')->nullable();
            $table->text('policies')->nullable();
            $table->text('international_measurement')->nullable();
            $table->text('accounting_term')->nullable();

            $table->text('considerations')->nullable();
            $table->text('study')->nullable();
            $table->text('second_study')->nullable();

            $table->foreignId('oldest_parent_id')->nullable();
            $table->foreign('oldest_parent_id')
                ->references('id')
                ->on('accounts_lvl_1')
                ->onDelete('cascade');

            $table->foreignId('top_parent_id')->nullable();
            $table->foreign('top_parent_id')
                ->references('id')
                ->on('accounts_lvl_2')
                ->onDelete('cascade');

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('accounts_lvl_3')
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
        Schema::dropIfExists('accounts_l_v_l4_s');
    }
}
