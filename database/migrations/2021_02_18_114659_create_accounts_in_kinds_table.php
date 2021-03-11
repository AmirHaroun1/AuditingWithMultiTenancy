<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsInKindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_in_kinds', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->double('detailed_debit')->default(0)->nullable();
            $table->double('detailed_credit')->default(0)->nullable();

            $table->double('aggregated_debit')->default(0)->nullable();
            $table->double('aggregated_credit')->default(0)->nullable();

            $table->string('type');
            $table->string('serial');
            $table->date('date');

            $table->string('corresponding_statement_code');
            $table->foreignId('statement_id')->nullable();
            $table->foreign('statement_id')
                ->references('id')
                ->on('account_transaction')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_in_kinds');
    }
}
