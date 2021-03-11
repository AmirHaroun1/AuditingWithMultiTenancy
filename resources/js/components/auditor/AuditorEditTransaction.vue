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
            <!-- ميزان المراجعة -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer" @click="ActivePane = 'ميزان المراجعة' ">
                        <span class="info-box-icon bg-green"><i class="fa  fa-balance-scale"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >ميزان المراجعة</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
            </div>
            <!-- ميزان المراجعة/. -->
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

            <!-- الأيضاحات -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box cursor-pointer" @click="ActivePane = 'الإيضاحات' ">
                    <span class="info-box-icon bg-green"><i class="fa fa-certificate"></i></span>
                    <div class="info-box-content">
                        <h4 class="font-weight-bold" style="padding-top:10px;" >الإيضاحات</h4>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <!-- إيضاح_الأيضاحات -->
            <!-- إيضاح_الأيضاحات -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box cursor-pointer" @click="ActivePane = 'إيضاح_الأيضاحات' ">
                        <span class="info-box-icon bg-green"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <h4 class="font-weight-bold" style="padding-top:10px;" >إيضاح الإيضاحات</h4>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <!-- إيضاح_الأيضاحات -->
            <!-- الحسابات -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box cursor-pointer" @click="ActivePane = 'القوائم' ">
                        <span class="info-box-icon bg-green"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <h4 class="font-weight-bold" style="padding-top:10px;" > القوائم المالية</h4>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <!-- الحسابات -->

            <!-- الحسابات -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box cursor-pointer" @click="ActivePane = 'العينة' ">
                    <span class="info-box-icon bg-green"><i class="fa fa-info"></i></span>
                    <div class="info-box-content">
                        <h4 class="font-weight-bold" style="padding-top:10px;" >العينة</h4>
                    </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
            </div>
            <!-- الحسابات -->
        </div>

        <div class="tab-content">
                <div class="tab-pane fade in show" v-if="ActivePane=='الملفات'">
                   <transaction-files :Transaction="Transaction"></transaction-files>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='ميزان المراجعة'">
                    <upload-excel-accounts :Transaction="Transaction"></upload-excel-accounts>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='الحسابات'">
                    <transaction-accounts :Transaction="Transaction"></transaction-accounts>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='بيانات المعاملة'">
                    <transaction-info :Transaction="Transaction"></transaction-info>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='الإيضاحات'">
                    <transaction-clearances :Transaction="Transaction" ></transaction-clearances>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='إيضاح_الأيضاحات'">
                    <transaction-clearance-of-clearances :Transaction="Transaction" ></transaction-clearance-of-clearances>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='القوائم'">
                    <transaction-financial-statements :Transaction="Transaction" ></transaction-financial-statements>
                </div>
                <div class="tab-pane fade in show" v-if="ActivePane=='العينة'">
                    <account-statements-sample :Transaction="Transaction"></account-statements-sample>
                </div>
        </div>

        <div class="text-center">
            <button @click="UpdateTransactionStatus()" class="btn btn-success btn-lg">ارسال الى المراجع الفني</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AuditorEditTransaction",
        props :{
            'Transaction' : Object,
        },
        data(){
            return{
                ActivePane:'بيانات المعاملة',
            }
        },
        methods:{
            UpdateTransactionStatus(){
                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('status','المراجع الفني');
                axios.post(route('Transactions.update',this.Transaction.id),formData)
                    .then((res)=>{
                        this.$toast.success('.','تم الأرسال الى المراجع الفني',{timout:3000});
                    }).catch((error)=>{
                    this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                })
            },


        },

    }
</script>

<style scoped>

</style>
