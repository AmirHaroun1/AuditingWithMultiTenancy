<template>
    <div class="container box" style="margin-top: 20px">

        <div class="row">
            <div class="box-header">
                <h2>بيانات المعاملة</h2>
            </div>
            <div class="box-body">
                <!------ رقم السجل ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px" >
                        <label class="float-right">رقم السجل الرئيسي</label>
                        <input  v-model="Transaction.MainTradeRegisterNumber" type="number" class="form-control" disabled >
                    </div>
                </div>
                <!------ تاريخ السجل ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">تاريخ السجل الرئيسى</label>

                        <input v-if="Transaction.institution.main_trade_register" v-model="Transaction.institution.main_trade_register.date" type="date" class="form-control"disabled >

                    </div>
                </div>
                <!------ مكان اصدار ------>
                <div class="row">

                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">مكان اصدار السجل الرئيسى</label>

                        <input v-if="Transaction.institution.main_trade_register" v-model="Transaction.institution.main_trade_register.production_place" type="text" class="form-control"  disabled>
                    </div>
                </div>
                <hr>
                <div class="row" id="CompanyInformation">
                    <!------ أسم المنشأة ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">أسم المنشأة</label>
                        <input v-if="Transaction.institution" v-model="Transaction.institution.name" type="text" class="form-control" disabled >
                    </div>
                    <!------ أسم المنشأة/. ------>
                    <!------ رقم المنشأة ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">رقم المنشأة</label>
                        <input v-if="Transaction.institution" v-model="Transaction.institution.name" type="number" class="form-control" disabled >
                    </div>
                    <!------ رقم المنشأة/. ------>
                    <!------ الكيان القانوني ------>
                    <div class="col-md-3" style="padding-bottom: 20px">
                        <label class="float-right">الكيان القانوني</label>
                        <input v-if="Transaction.institution" v-model="Transaction.institution.legal_entity" class="form-control" disabled>

                    </div>
                    <!------ الكيان القانوني/. ------>
                    <!------ اهتمامات الملاك ------>
                    <div class="col-md-3" style="padding-bottom: 20px">
                        <label class="float-right">الكيان القانوني</label>
                        <input v-if="Transaction.institution" v-model="Transaction.institution.angel_interests" class="form-control" disabled>

                    </div>
                    <!------ اهتمامات الملاك/. ------>
                    <!------ طبيعة ملكية المنشأة وكيفية تمويلها ------>
                    <div class="col-md-3" style="padding-bottom: 20px">
                        <label class="float-right">طبيعة ملكية المنشأة وكيفية تمويلها</label>
                        <input v-model="Transaction.institution.nature" class="form-control" disabled>
                    </div>
                    <!------ طبيعة ملكية المنشأة وكيفية تمويلها/. ------>
                    <!------ تقويم العام المالي للمنشأة ------>
                    <div class="col-md-3" style="padding-bottom: 20px">
                        <label class="float-right">تقويم العام المالي للمنشأة</label>
                        <input v-model="Transaction.institution.date_type" class="form-control" disabled>
                    </div>
                    <!------ تقويم العام المالي للمنشأة/. ------>
                    <!------ نشاط المنشأة ------>
                    <div class="col-md-9" style="padding-bottom: 20px">
                        <label class="float-right">نشاط المنشأة</label>
                        <textarea class="form-control" v-model="Transaction.institution.business_activity" rows="6"  disabled >
                        </textarea>
                    </div>
                    <!------ نشاط المنشأة/. ------>
                    <!------ عنوان المنشأة ------>
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">العنوان</label>
                        <input class="form-control" v-model="Transaction.institution.address" disabled>

                    </div>
                    <!------ عنوان المنشأة./ ------>
                    <!------ الرقم المميز لدى هيئة الذكاة ------>
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">الرقم المميز لدى هيئة الذكاة</label>
                        <input type="number" class="form-control" v-model="Transaction.institution.charity_num" disabled >

                    </div>
                    <!------ الرقم المميز لدى هيئة الذكاة/. ------>
                    <!------ رقم الضريبة المضافة ------>
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">رقم الضريبة المضافة</label>
                        <input type="number" class="form-control" v-model="Transaction.institution.extra_tax_num" disabled>
                    </div>
                    <!------ رقم الضريبة المضافة/> ------>
                </div>

                <hr>
                <!------ تاريخ انتهاء السجل ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom:20px">
                        <label class="float-right">تاريخ انتهاء السجل</label>

                        <input v-model="Transaction.institution.main_trade_register.EndDate" type="date" class="form-control" disabled>

                    </div>
                </div>
                <!------ تاريخ انتهاء السجل/. ------>
                <!------   السنة المالية ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px" >
                        <label class="float-right">السنة المالية</label>

                        <input  v-model="Transaction.financial_year" type="number" class="form-control" disabled>

                    </div>
                </div>
                <!------   السنة المالية/. ------>
                <!------   الفترة المالية ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right"> الفترة المالية</label>

                        <input  v-model="Transaction.financial_period" type="text" class="form-control" disabled>
                    </div>
                </div>
                <!------   الفترة المالية/. ------>
                <!------ بداية / نهاية  السنة المالية ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">بداية السنة المالية</label>

                        <input v-model="Transaction.start_financial_year" type="date" class="form-control" disabled>

                    </div>
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">نهاية السنة المالية</label>

                        <input v-model="Transaction.end_financial_year" type="date" class="form-control" disabled>

                    </div>
                </div>
                <!------ بداية / نهاية  السنة المالية/. ------>
                <div v-if="!Transaction.branched_trade_registers.length" class="row" style="padding-top: 10px" v-for="register in Transaction.branched_trade_registers">
                    <div class="col-md-3">
                        <label class="float-right">رقم السجل </label>
                        <input type="number" v-model="register.number" class="form-control" disabled>
                    </div>
                    <div class="col-md-3">
                        <label class="float-right">مكان اصدار السجل </label>
                        <input type="text" v-model="register.production_place" class="form-control" disabled>
                    </div>
                    <div class="col-md-3">
                        <label class="float-right"> تاريخ اصدار السجل </label>
                        <input type="date"  v-model="register.date" class="form-control" disabled>
                    </div>
                    <div class="col-md-3">
                        <label class="float-right"> تاريخ انتهاء السجل </label>
                        <input type="date"  v-model="register.EndDate" class="form-control" disabled>
                    </div>
                </div>
                <!----- Choose revisers Form Content -->
                <div class="row" id="chooseRevisers">
                    <div v-if="Transaction.auditor" class="col-md-6">
                        <h3 class="box-header">المدقق المسؤول</h3>
                        <input type="text" v-model="Transaction.auditor.name" class="form-control" disabled>

                    </div>
                    <div v-if="Transaction.reviser" class="col-md-6">
                        <h3 class="box-header">المراجع المسؤول</h3>
                        <input type="text" v-model="Transaction.reviser.name" class="form-control" disabled>
                    </div>
                </div>
                <!----- /.Choose revisers Form Content -->

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TransactionInfo",
        props:{
            'Transaction':Object,
        }
    }
</script>

<style scoped>

</style>
