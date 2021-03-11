<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transaction', function (Blueprint $table) {
            $table->id();

            $table->foreignId('first_level_account_id')->nullable();
            $table->foreign('first_level_account_id')
                ->references('id')
                ->on('accounts_lvl_1')
                ->onDelete('cascade');

            $table->foreignId('second_level_account_id')->nullable();
            $table->foreign('second_level_account_id')
                ->references('id')
                ->on('accounts_lvl_2')
                ->onDelete('cascade');

            $table->foreignId('third_level_account_id')->nullable();
            $table->foreign('third_level_account_id')
                ->references('id')
                ->on('accounts_lvl_3')
                ->onDelete('cascade');

            $table->foreignId('fourth_level_account_id')->nullable();
            $table->foreign('fourth_level_account_id')
                ->references('id')
                ->on('accounts_lvl_4')
                ->onDelete('cascade');

            $table->foreignId('transaction_id')->nullable();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');

            $table->integer('account_level');
            $table->string('name')->nullable();
            $table->string('code')->nullable();

            $table->text('related_party_type')->nullable();
            $table->text('related_party_branch')->nullable();

            $table->double('current_year')->default(0);
            $table->double('current_year_creditor')->default(0);
            $table->double('current_year_debtor')->default(0);

            $table->double('edited_current_year_creditor')->default(0);
            $table->double('edited_current_year_debtor')->default(0);


            $table->integer('should_be_shown_in_FinancialStatements')->nullable();

            $table->double('first_past_year')->default(0);

            $table->double('second_past_year')->default(0);

            $table->double('third_past_year')->default(0);

            $table->double('fourth_past_year')->default(0);

            $table->double('aggregated_debit')->default(0);
            $table->double('aggregated_credit')->default(0);

            $table->text('comment')->nullable();
            $table->boolean('ReadDataOnly')->default('0');

            $table->text('policy')->nullable()->default('');
            $table->text('considerations')->nullable()->default('');
            $table->text('study')->nullable()->default('');
            $table->text('second_study')->nullable()->default('');

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('account_transaction')
                ->onDelete('cascade');

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
        Schema::dropIfExists('account_transaction');

    }
}
