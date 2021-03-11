<template>
    <div>

        <div class="row">
                <!-- /بيانات المعاملة -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer"  @click="ActivePane = 'بيانات المعاملة' ">
                        <span class="info-box-icon bg-green"><i class="fa  fa-star-o"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >بيانات المعاملة</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                    <!-- بيانات المعاملة/. -->

                </div>

                <!-- ضابط الأتصال -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer"  @click="ActivePane = 'ضابط الأتصال' ">
                        <span class="info-box-icon bg-green"><i class="fa  fa-user"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >ضابط الأتصال</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- ضابط الأتصال/. -->

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

                <!-- طباعة خطاب الأرتباط -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box cursor-pointer" @click="ActivePane = 'الدفع' ">
                        <span class="info-box-icon bg-green"><i class="fa  fa-money"></i></span>
                        <div class="info-box-content">
                            <h4 class="font-weight-bold" style="padding-top:10px;" >بيانات الدفع</h4>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div>
                <!-- طباعة خطاب الأرتباط/. -->

            </div>

        <div class="tab-content">
            <div class="tab-pane fade in show" v-if="ActivePane=='بيانات المعاملة'">
               <edit-transaction-data></edit-transaction-data>
            </div>
            <div class="tab-pane fade in show" v-else-if="ActivePane=='ضابط الأتصال'">
                <div v-if="Agent !== null">
                    <edit-agent-form> </edit-agent-form>
                </div>
                <div v-else>
                    <new-agent-form></new-agent-form>
                </div>
            </div>
            <div class="tab-pane fade in show" v-else-if="ActivePane=='الملفات'">
                <documents-management-section></documents-management-section>
            </div>
            <div class="tab-pane fade in show" v-else-if="ActivePane=='الدفع'">
                <payment-details-form :Transaction="Transaction"></payment-details-form>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "SecretaryEditTransaction.vue",
        props :{
            'Transaction' : Object,
        },
        data(){
            return{

                ActivePane:'',
                Institution : '',
                Agent:null,
                MainTradeRegister:'',
                BranchedTradeRegisters:'',
                Documents:'',
                reviser:'',
                revisingManager:'',
            }
        },
        created(){
            this.Institution = this.Transaction.institution;
            this.Agent = this.Transaction.institution.agent;
            this.MainTradeRegister = this.Transaction.institution.main_trade_register[0];
            this.BranchedTradeRegisters = this.Transaction.institution.branched_trade_register;
            this.Documents = this.Transaction.documentations;
            this.reviser = this.Transaction.reviser;
            this.revisingManager = this.Transaction.revising_manager;
        },

    }
</script>

<style scoped>

</style>
