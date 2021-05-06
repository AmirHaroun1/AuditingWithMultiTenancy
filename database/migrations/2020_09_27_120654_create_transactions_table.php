<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('financial_year')->nullable(); //السنة المالية
            $table->unsignedInteger('MainTradeRegisterNumber')->nullable(); //رقم السجل الرئيسي

            $table->date('start_financial_year')->nullable(); // بداية السنة المالية
            $table->date('end_financial_year')->nullable(); //نهاية السنة المالية

            $table->string('financial_period')->nullable(); //  الفتره المالية

            $table->string('measurement_standard')->nullable(); //معيار القياس
            $table->string('measurement_standard_determinants')->nullable(); // محددات معيار القياس

            $table->unsignedBigInteger('agreed_contract_value')->default(0); //قيمة التعاقد المتفق عليها
            $table->unsignedBigInteger('down_payment')->default(0); //الدفعة المقدمة
            $table->unsignedBigInteger('final_payment')->default(0); //الدفعة النهائية
            $table->unsignedBigInteger('zakat_deposit_fees')->default(0); //أتعاب الذكاه
            $table->unsignedBigInteger('value_added_tax')->default(0);  //ضرائب القيمة المضافة
            $table->unsignedBigInteger('offer_value')->default(0); //قيمة الخصم
            $table->unsignedBigInteger('total_value')->default(0); //اجمالى أتعاب

            $table->string('status')->default('under_review'); //الحالة

            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->double('secretary_time')->default(0);
            $table->double('fieldDelegate_time')->default(0);
            $table->double('auditor_time')->default(0);
            $table->double('executiveDirector_time')->default(0);
            $table->double('Managing_partner_time')->default(0);
            $table->double('reviser_time')->default(0);
            $table->double('revisingManager_time')->default(0);
            $table->double('helper_time')->default(0);

            $table->text('secretary_notes')->nullable();
            $table->text('reviser_notes')->nullable();
            $table->text('revisingManager_notes')->nullable();
            $table->text('auditor_notes')->nullable();
            $table->text('archiveSecretary_notes')->nullable();

            // $table->text('executiveDirector_notes')->nullable();

            $table->double('secretary_actualTime')->nullable();
            $table->double('reviser_actualTime')->nullable();
            $table->double('revisingManager_actualTime')->nullable();
            $table->double('auditor_actualTime')->nullable();
            $table->double('Managing_partner_time_actualTime')->nullable();

            $table->string('time_status')->default('acceptable');
            $table->text('rejection_reason')->nullable();

            $table->boolean('auditor_is_changed')->default(0);

            $table->foreignId('reviser_id')->nullable(); // المراجع الفنى
            $table->foreign('reviser_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');

            $table->foreignId('revisingManager_id')->nullable(); // مدير المراجع الفنى
            $table->foreign('revisingManager_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');


            $table->foreignId('auditor_id')->nullable(); // المدقق
            $table->foreign('auditor_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');


            $table->foreignId('fieldDelegate_id')->nullable(); // المندوب الميدانى
            $table->foreign('fieldDelegate_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');


            $table->foreignId('institution_id')->nullable(); //المنشأة طالبة المراجعة
            $table->foreign('institution_id')
                ->references('id')
                ->on('institutions')
                ->onDelete('SET NULL');


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
        Schema::dropIfExists('transactions');
    }
}
