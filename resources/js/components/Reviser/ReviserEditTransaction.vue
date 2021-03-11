<template>
    <div>
        <div class="row">
                <!-- بيانات المعاملة -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer" @click="ActivePane = 'بيانات المعاملة' ">
                        <span class="info-box-icon bg-green"><i class="fa fa-archive"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >بيانات المعاملة</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- بيانات المعاملة./ -->
                <!-- عدد ساعات -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer" @click="ActivePane = 'عدد ساعات المعاملة' ">
                        <span class="info-box-icon bg-green"><i class="fa fa-clock-o"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >عدد ساعات المعاملة</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- عدد ساعات/. -->
                <!-- الملفات -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer" @click="ActivePane = 'الملفات' ">
                        <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >الملفات</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- الملفات/. -->

                <!-- الحسابات -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer" @click="ActivePane = 'الحسابات' ">
                        <span class="info-box-icon bg-green"><i class="fa  fa-book"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >الحسابات</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- الحسابات -->
        </div>

        <div class="tab-content">
            <div class="tab-pane fade in show" v-if="ActivePane=='عدد ساعات المعاملة'">
                <div class="container box" style="margin-top: 20px">
                    <div v-if="LoadingSpinner" class="overlay">
                        <i class="fa fa-refresh fa-spin">
                        </i>
                    </div>
                    <div class="box-body">
                        <div class="box-header">
                            <h2>بيانات المعاملة و توزيع عدد الساعات </h2>
                        </div>
                        <form id="EditTransactionForm" class="form-group" @submit.prevent="UpdateTransaction()">
                            <!-- Start / End Date  ------>
                            <div class="row form-group" >
                                <div class="col-md-6" style="padding-top: 15px">
                                    <label>تاريخ بداية المعاملة</label>
                                    <VueCtkDateTimePicker  :format="'YYYY-MM-DD H:mm'" :formatted="'H:mm , Y-M-D '" label="أختر التاريخ و الوقت" v-model="start_date"></VueCtkDateTimePicker>

                                </div>
                                <div class="col-md-6"  style="padding-top: 15px">
                                    <label>تاريخ انتهاء المعاملة</label>
                                    <VueCtkDateTimePicker  :format="'YYYY-MM-DD H:mm'" :formatted="'H:mm , Y-M-D '" label="أختر التاريخ و الوقت" v-model="end_date"></VueCtkDateTimePicker>
                                </div>
                            </div>
                            <!-- ./ Start / End Date  ------>
                            <!-- توزيع ساعات العمل  ------>
                            <div class="row" style="padding-top:15px;padding-bottom:15px">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th style="color: white;background-color: #00a65a;border-color:white">السكرتارية</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المندوب الميدانى</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المراجع الفنى</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المدقق</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">مدير المراجعة</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المدير التنفيذي</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">الشريك الإداري</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المساعد</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td>
                                            <input type="text" class="form-control" v-model="secretary_time">
                                        </td>
                                        <td><input type="text" class="form-control" v-model="fieldDelegate_time"></td>
                                        <td><input type="text" class="form-control" v-model="reviser_time"></td>
                                        <td><input type="text" class="form-control" v-model="auditor_time"></td>
                                        <td><input type="text" class="form-control" v-model="revisingManager_time"></td>
                                        <td><input type="text" class="form-control" v-model="executiveDirector_time"></td>
                                        <td><input type="text" class="form-control" v-model="Managing_partner_time"></td>
                                        <td><input type="text" class="form-control" v-model="helper_time"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- توزيع ساعات العمل/.  ------>
                            <!-- اختيرا المندوب الميدانى و المدقق  ------>
                            <div class="row">
                                <div class="col-md-6" style="padding-top: 15px">
                                    <label>اختيار المدقق</label>

                                    <v-select  :options="auditors" v-model="ChoosenAuditor"></v-select>
                                </div>
                                <div class="col-md-6" style="padding-top: 15px">
                                    <label>اختيار المندوب الميداني</label>
                                    <v-select  :options="fieldDelegates" v-model="ChoosenFieldDelegate"></v-select>

                                </div>
                            </div>


                            <!-- اختيرا المندوب الميدانى و المدقق/.  ------>
                            <div class="row" style="padding-top:20px">
                                <div class="col-md-12 ">
                                    <button type="submit" class="btn btn-block btn-success btn-lg" style="padding: 15px;width:230px" >حفظ</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane=='الملفات'">
                <transaction-files :Transaction="Transaction"></transaction-files>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane=='الحسابات'">
                <transaction-accounts :Transaction="Transaction"></transaction-accounts>
            </div>

            <div class="tab-pane fade in show" v-if="ActivePane=='بيانات المعاملة'">
                <transaction-info :Transaction="Transaction"></transaction-info>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <button @click="UpdateTransactionStatus('مدير المراجعة')"  class="btn btn-success btn-lg">ارسال الى مدير المراجعة</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-left">
                    <button @click="UpdateTransactionStatus('المدقق')"  class="btn btn-danger btn-lg">ارسال الى المدقق</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: "ReviserEditTransaction.vue",
        props:{
            'Transaction':'',

            },
        data(){
            return{
                LoadingSpinner:'',
                auditors : [],
                ChoosenAuditor: '',
                ActivePane:'بيانات المعاملة',
                ChoosenFieldDelegate:'' ,
                fieldDelegates:[],
                start_date : this.Transaction.start_date,
                end_date : this.Transaction.end_date,
                secretary_time:this.Transaction.secretary_time,
                reviser_time: this.Transaction.reviser_time,
                auditor_time: this.Transaction.auditor_time,
                fieldDelegate_time: this.Transaction.fieldDelegate_time,
                revisingManager_time: this.Transaction.revisingManager_time,
                helper_time: this.Transaction.helper_time,
                executiveDirector_time: this.Transaction.executiveDirector_time,
                Managing_partner_time:this.Transaction.Managing_partner_time,
            }
        },
        mounted() {
            if(this.Transaction.auditor){
                this.ChoosenAuditor  = {'label':this.Transaction.auditor.name,'code':this.Transaction.auditor.id }
            }
            if(this.Transaction.field_delegate){
               this.ChoosenFieldDelegate =  {'label': this.Transaction.field_delegate.name,'code':this.Transaction.field_delegate.id }
            }
        },
        created() {
            this.GetAuditors(route('employee.type','مدقق'))

            this.GetFieldDelegates(route('employee.type','مندوب ميداني'))
        },
        methods:{
            UpdateTransactionStatus(status) {
                let formData = new FormData();
                formData.append('_method', 'PATCH');
                formData.append('status', status);
                axios.post(route('Transactions.update', this.Transaction.id), formData)
                    .then((res) => {
                        this.$toast.success('.', status, {timout: 3000});
                    }).catch((error) => {
                    this.$toast.error('.', 'خطأ, برجاء المحاولة مرة أخرى', {timeout: 3000});
                })
            },
            UpdateTransaction(){

                var formData = new FormData();
              formData.append('_method','PATCH');
              formData.append('Managing_partner_time',this.Managing_partner_time);
              formData.append('executiveDirector_time',this.executiveDirector_time);
              formData.append('helper_time',this.helper_time);
              formData.append('revisingManager_time',this.revisingManager_time);
              formData.append('fieldDelegate_time',this.fieldDelegate_time);
              formData.append('auditor_time',this.auditor_time);
              formData.append('reviser_time',this.reviser_time);
              formData.append('secretary_time',this.secretary_time);
              if(this.end_date){
                  formData.append('end_date',this.end_date);
              }
              if(this.start_date){
                  formData.append('start_date',this.start_date);
              }
              if (this.ChoosenFieldDelegate){
                  formData.append('fieldDelegate_id',this.ChoosenFieldDelegate.code);
              }
              if(this.ChoosenAuditor){
                  formData.append('auditor_id',this.ChoosenAuditor.code);
              }
              console.log(formData);
                axios.post(route('Transactions.update',this.Transaction.id),formData)
                    .then((res) => {
                        console.log(res);
                        this.LoadingSpinner = false;
                        this.ValidationErrors = '';
                        this.$toast.success('.',
                            'قد تم اضافة بيانات المعاملة بنجاح'
                            ,{timout:2000})

                    }).catch((error) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});

                });

            },
            GetAuditors(endpoint){
                axios.get(endpoint)
                    .then(({data}) => {
                        this.LoadingSpinner = true;
                        data.employees.forEach((auditor) => {
                            this.auditors.push({'label' : auditor.name , 'code' : auditor.id});
                        });
                        this.LoadingSpinner = false;

                    });
            },
            GetFieldDelegates(endpoint){
                axios.get(endpoint)
                    .then(({data}) => {
                        this.LoadingSpinner = true;

                        data.employees.forEach((fieldDelegate) => {
                            this.fieldDelegates.push({'label' : fieldDelegate.name , 'code' : fieldDelegate.id});

                        });
                        this.LoadingSpinner = false;

                    });
            },
        },

    }
</script>

<style scoped>

</style>
