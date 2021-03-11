<template>
    <div id="PaymentSection">
        <div class="box" style="margin-top: 20px">
            <div class="box-header">
                <h2>الدفع</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-group" @submit.prevent="submitPaymentData()">
                    <!-- /قيمة التعاقد -->
                    <div id="MesurmentsValues">
                        <div class="row">
                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                <label class="float-right">محددات معيار القياس</label>

                                <select v-model="measurement_standard_determinants"  class="form-control" required>
                                    <option v-for="option in measurement_standard_determinantsOptions" :value="option.value">{{option.value}}</option>

                                </select>
                                <div v-if="ValidationErrors.measurement_standard_determinants"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.measurement_standard_determinants[0] }}
                                    </h4>
                                </div>
                            </div>
                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                <label class="float-right"> معيار القياس</label>

                                <select v-model="measurement_standard"  class="form-control" required>
                                    <option v-for="option in measurement_standardOptions" :value="option.value">{{option.value}}</option>

                                </select>
                                <div v-if="ValidationErrors.measurement_standard"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.measurement_standard[0] }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                <label class="float-right">قيمة التعاقد المتفق عليها</label>

                                <input @input="CheckTotal_value()" v-model="agreed_contract_value" type="number" class="form-control" required>

                                <div v-if="ValidationErrors.agreed_contract_value"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.agreed_contract_value[0] }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                                <div class=" form-group col-md-6" style="padding-bottom: 20px">
                                    <label class="float-right"> القيمة المضافة : {{value_added_tax_amount}} ريال</label>

                                    <input @input="CheckTotal_value()" v-model="value_added_tax_percentage" type="text" class="form-control" required>

                                    <div v-if="ValidationErrors.value_added_tax"   style="margin-top:10px">
                                        <h4 class="  font-weight-bold" style="color:red">
                                            {{ ValidationErrors.value_added_tax[0] }}
                                        </h4>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="form-group col-md-6" style="padding-bottom: 20px">
                                    <label class="float-right">اقرار الذكاة</label>

                                    <input @input="CheckTotal_value()" v-model="zakat_deposit_fees" type="number" class="form-control" required>

                                    <div v-if="ValidationErrors.zakat_deposit_fees"   style="margin-top:10px">
                                        <h4 class="  font-weight-bold" style="color:red">
                                            {{ ValidationErrors.zakat_deposit_fees[0] }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                    <label class="float-right">قيمة الخصم</label>

                                    <input @input="CheckTotal_value()" v-model="offer_value" type="number" class="form-control" required>

                                    <div v-if="ValidationErrors.offer_value"   style="margin-top:10px">
                                        <h4 class="  font-weight-bold" style="color:red">
                                            {{ ValidationErrors.offer_value[0] }}
                                        </h4>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6" style="padding-bottom: 20px">
                                    <label class="float-right">الإجمالي</label>

                                    <input disabled v-model="total_value" type="number" class="form-control" required>

                                    <div v-if="ValidationErrors.total_value"   style="margin-top:10px">
                                        <h4 class="  font-weight-bold" style="color:red">
                                            {{ ValidationErrors.total_value[0] }}
                                        </h4>
                                    </div>

                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-6" style="padding-bottom: 20px">
                                    <label class="float-right">الدفعة المقدمة</label>

                                    <input @input="CheckFinal_Payment()" v-model="down_payment" type="number" class="form-control" required>

                                    <div v-if="ValidationErrors.down_payment"   style="margin-top:10px">
                                        <h4 class="  font-weight-bold" style="color:red">
                                            {{ ValidationErrors.down_payment[0] }}
                                        </h4>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                <label class="float-right">الدفعة النهائية </label>

                                <input disabled v-model="final_payment" type="number" class="form-control" required>

                                <div v-if="ValidationErrors.final_payment"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.final_payment[0] }}
                                    </h4>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                <label class="float-right">كود العميل</label>

                                <input :value="this.$parent.Institution.id" type="text" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6" style="padding-bottom: 20px">
                                <label class="float-right">حالة العملية</label>

                                <select v-model="status" type="checkbox" class="form-control" required>
                                    <option value="فى حيذ التنفيذ">فى حيذ التنفيذ</option>
                                    <option value="غير مفعلة">غير مفعلة</option>
                                    <option value="تعتمد من طرف المراجع الفني">تعتمد من طرف المراجع الفني</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- /.قيمة التعاقد -->

                    <div class="row">
                        <div class="col-md-12 ">
                            <button   class="btn btn-block btn-success btn-lg" style="padding: 15px;width:230px" >  حفظ</button>
                        </div>
                    </div>
                    <hr>

                    <!--بيانات سند القبض -->
                    <div id="ReceiptVoucherInfo">
                        <div class="box-header">
                            <h2>طباعة سند القبض & خطاب الأرتباط</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-4" style="padding-top:20px">
                                <label>النوع</label>
                                <select v-model="PaymentType" type="text" class="form-control">
                                    <option bv value="مقدم أتعاب">مقدم أتعاب</option>

                                    <option value="دفعة أتعاب نهائية">دفعة أتعاب نهائية</option>
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-between text-center">
                                <a :href="PrintLink" target="_blank" class="btn btn-default btn-lg" style="margin-top:15px"><i class="fa fa-print"></i> طباعة سند قبض</a>
                                <a  :href="EngagementLetterLink" target="_blank" class="btn btn-default btn-lg" style="margin-top:15px"><i class="fa fa-print"></i> طباعة خطاب الأرتباط</a>
                        </div>


                    </div>
                    <!--بيانات سند القبض/. -->

                </form>

            </div>

            <div v-if="LoadingSpinner" class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props :{
          'Transaction':Object,
        },
        data() {
            return{
                LoadingSpinner:'',
                ValidationErrors:'',

                measurement_standard_determinantsOptions :[],
                measurement_standardOptions:[],

                measurement_standard_determinants : this.Transaction.measurement_standard_determinants,
                measurement_standard : this.Transaction.measurement_standard,

                agreed_contract_value : this.Transaction.agreed_contract_value,

                down_payment : this.Transaction.down_payment,
                final_payment : this.Transaction.final_payment,
                total_value : this.Transaction.total_value,

                value_added_tax_percentage : '15'+'%',
                value_added_tax_amount : this.Transaction.value_added_tax,
                zakat_deposit_fees : this.Transaction.zakat_deposit_fees,
                offer_value : this.Transaction.offer_value,
                status : this.Transaction.status,


                ReviserCompanyName:'مكتوب مسعود الرفيدى',
                PaymentType:'مقدم أتعاب',
                PaymentValue:'',
                financial_year :this.Transaction.financial_year,

            }

        },

        created() {
            this.GetDropDowns(route('system.DropDowns.retrieve.option'));

        },
        methods:{
            GetDropDowns(endpoint){
                this.LoadingSpinner = true;
                axios.get(endpoint)
                    .then(({data})=>{
                        data.DropDownsOptions.forEach((option,index)=>{

                            if(option.name == 'محددات معيار القياس'){
                                this.measurement_standard_determinantsOptions.push(option);
                            }
                            else if(option.name == 'معيار القياس'){
                                this.measurement_standardOptions.push(option);
                            }
                        })
                    })
                this.LoadingSpinner = false;
            },
            submitPaymentData(){
                this.LoadingSpinner = true;
                let formData = new FormData();

                formData.append('_method','PATCH');
                formData.append('measurement_standard_determinants',this.measurement_standard_determinants);
                formData.append('measurement_standard',this.measurement_standard);

                formData.append('agreed_contract_value',this.agreed_contract_value);
                formData.append('value_added_tax',this.value_added_tax_amount);
                formData.append('zakat_deposit_fees',this.zakat_deposit_fees);
                formData.append('offer_value',this.offer_value);

                formData.append('down_payment',this.down_payment);
                formData.append('final_payment',this.final_payment);
                formData.append('total_value',this.total_value);
                formData.append('status',this.status);

                axios.post(route('Transactions.update',this.Transaction.id),formData)
                .then((res)=>{
                    this.LoadingSpinner = false;

                    this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                        'قد تم تسجيل البيانات بنجاح '
                        ,{timout:2000});

                }).catch((error)=>{
                    this.LoadingSpinner = false;

                    this.ValidationErrors = error.response.data.errors;

                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                })
            },
            CheckTotal_value(){
                this.value_added_tax_amount = parseFloat(this.agreed_contract_value) * ( parseFloat(this.value_added_tax_percentage.replace('%','')) / 100);
                return this.total_value = ( parseFloat(this.agreed_contract_value) + parseFloat(this.zakat_deposit_fees) + this.value_added_tax_amount ) - parseInt(this.offer_value);
            },
            CheckFinal_Payment()
            {
                return this.final_payment = parseFloat(this.total_value) - parseFloat(this.down_payment);
            }
        },
        computed :{
            PrintLink () {
                if (this.PaymentType == 'دفعة أتعاب نهائية')
                {
                   this.PaymentValue = this.final_payment;
                }else{
                    this.PaymentValue = this.down_payment;
                }

              return route('Print.ReceiptVoucher',{TransactionYear:this.financial_year,CompanyName: this.$parent.Institution.name   ,   PaymentType: this.PaymentType   ,   PaymentValue: this.PaymentValue ,ReviserCompanyName : this.ReviserCompanyName}) ;
            },
            EngagementLetterLink(){
                return route('Print.EngagementLetter',[this.$parent.Institution,this.Transaction]);
            }

        },


        name: "PaymentDetailsForm.vue",

    }
</script>

<style scoped>

</style>
