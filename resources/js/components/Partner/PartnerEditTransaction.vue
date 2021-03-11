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

            <div class="tab-pane fade in show" v-if="ActivePane=='بيانات المعاملة'">
                <transaction-info :Transaction="Transaction"></transaction-info>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane=='الملفات'">
                <transaction-files :Transaction="Transaction"></transaction-files>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane=='الحسابات'">
                <transaction-accounts :Transaction="Transaction"></transaction-accounts>
            </div>
        </div>

        <div class="row">
            <div class="text-center">
                <button @click="UpdateTransactionStatus('تم الأعتماد')"  class="btn btn-success btn-lg">اعتماد المعاملة</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        name: "PartnerEditTransaction.vue",
        props:{
            'Transaction':'',
        },
        data(){
            return{
                LoadingSpinner:'',

                ActivePane:'بيانات المعاملة',

            }
        },
        methods: {
            UpdateTransactionStatus(status) {
                let formData = new FormData();
                formData.append('_method', 'PATCH');
                formData.append('status', status);
                axios.post(route('Transactions.update', this.Transaction.id), formData)
                    .then((res) => {
                        this.$toast.success('.', 'تم اعتماد المعاملة', {timout: 3000});
                    }).catch((error) => {
                    this.$toast.error('.', 'خطأ, برجاء المحاولة مرة أخرى', {timeout: 3000});
                })
            },
        }

    }
</script>

<style scoped>

</style>
