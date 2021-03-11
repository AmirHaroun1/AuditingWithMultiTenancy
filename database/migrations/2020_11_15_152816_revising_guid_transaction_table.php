<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RevisingGuidTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revising_transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('revising_id')->nullable();
            $table->foreign('revising_id')
                    ->references('id')
                    ->on('revising_guid')
                     ->onDelete('cascade');

            $table->foreignId('transaction_id')->nullable();
            $table->foreign('transaction_id')
                    ->references('id')
                    ->on('transactions')
                     ->onDelete('cascade');

            $table->text('text')->nullable();

            $table->integer('status')->default(1)->nullable(); // 1 for yes , 0 for no , 2 for not applicable

            $table->string('reference')->nullable();
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
        Schema::dropIfExists('revising_transaction');
    }
}
