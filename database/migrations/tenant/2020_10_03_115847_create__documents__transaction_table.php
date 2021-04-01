<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_transaction', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transaction_id');
            $table->foreign('transaction_id')
                    ->references('id')
                    ->on('transactions');

            $table->foreignId('document_id');
            $table->foreign('document_id')
                ->references('id')
                ->on('documents');

            $table->text('DocumentPath');
            $table->text('original_name')->nullable();

            $table->text('comment');

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
        Schema::dropIfExists('document_transaction');
    }
}
