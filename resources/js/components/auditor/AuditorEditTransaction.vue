<template>
    <div>
        <v-container>
            <v-row>
                <!-- بيانات المعاملة -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto"
                        outlined
                        @click="ActivePane = 'بيانات المعاملة'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    {{$t('transactionsData')}} 
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar tile size="80" color="indigo">
                                <v-icon dark>
                                    mdi-archive
                                </v-icon>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                    <!-- /.info-box -->
                </v-col>
                <!-- بيانات المعاملة./ -->
                <!-- الملفات -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto"
                        outlined
                        @click="ActivePane = 'الملفات'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    {{$t('files')}} 
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar tile size="80" color="indigo">
                                <v-icon dark>
                                    mdi-file-multiple
                                </v-icon>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- الملفات/. -->
                <!-- ميزان المراجعة -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto"
                        outlined
                        @click="ActivePane = 'ميزان المراجعة'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    ميزان المراجعة 
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar tile size="80" color="indigo">
                                <v-icon dark>
                                    mdi-scale-balance
                                </v-icon>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- ميزان المراجعة/. -->
                <!-- الحسابات -->
                <v-col cols="12" sm="6" md="3">
                    <div
                        class="info-box cursor-pointer"
                        @click="ActivePane = 'الحسابات'"
                    >
                        <span class="info-box-icon bg-green"
                            ><i class="fa  fa-book"></i
                        ></span>
                        <div class="info-box-content">
                            <h4
                                class="font-weight-bold"
                                style="padding-top:10px;"
                            >
                                الحسابات
                            </h4>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </v-col>
                <!-- الحسابات -->

                <!-- الأيضاحات -->
                <v-col cols="12" sm="6" md="3">
                    <div
                        class="info-box cursor-pointer"
                        @click="ActivePane = 'الإيضاحات'"
                    >
                        <span class="info-box-icon bg-green"
                            ><i class="fa fa-certificate"></i
                        ></span>
                        <div class="info-box-content">
                            <h4
                                class="font-weight-bold"
                                style="padding-top:10px;"
                            >
                                الإيضاحات
                            </h4>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </v-col>
                <!-- إيضاح_الأيضاحات -->
                <!-- إيضاح_الأيضاحات -->
                <v-col cols="12" sm="6" md="3">
                    <div
                        class="info-box cursor-pointer"
                        @click="ActivePane = 'إيضاح_الأيضاحات'"
                    >
                        <span class="info-box-icon bg-green"
                            ><i class="fa fa-info"></i
                        ></span>
                        <div class="info-box-content">
                            <h4
                                class="font-weight-bold"
                                style="padding-top:10px;"
                            >
                                إيضاح الإيضاحات
                            </h4>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </v-col>
                <!-- إيضاح_الأيضاحات -->
                <!-- الحسابات -->
                <v-col cols="12" sm="6" md="3">
                    <div
                        class="info-box cursor-pointer"
                        @click="ActivePane = 'القوائم'"
                    >
                        <span class="info-box-icon bg-green"
                            ><i class="fa fa-info"></i
                        ></span>
                        <div class="info-box-content">
                            <h4
                                class="font-weight-bold"
                                style="padding-top:10px;"
                            >
                                القوائم المالية
                            </h4>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </v-col>
                <!-- الحسابات -->

                <!-- الحسابات -->
                <v-col cols="12" sm="6" md="3">
                    <div
                        class="info-box cursor-pointer"
                        @click="ActivePane = 'العينة'"
                    >
                        <span class="info-box-icon bg-green"
                            ><i class="fa fa-info"></i
                        ></span>
                        <div class="info-box-content">
                            <h4
                                class="font-weight-bold"
                                style="padding-top:10px;"
                            >
                                العينة
                            </h4>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </v-col>
                <!-- الحسابات -->
            </v-row>
        </v-container>

        <div class="tab-content">
            <div class="tab-pane fade in show" v-if="ActivePane == 'الملفات'">
                <transaction-files
                    :Transaction="Transaction"
                ></transaction-files>
            </div>
            <div
                class="tab-pane fade in show"
                v-if="ActivePane == 'ميزان المراجعة'"
            >
                <upload-excel-accounts
                    :Transaction="Transaction"
                ></upload-excel-accounts>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane == 'الحسابات'">
                <transaction-accounts
                    :Transaction="Transaction"
                ></transaction-accounts>
            </div>
            <div
                class="tab-pane fade in show"
                v-if="ActivePane == 'بيانات المعاملة'"
            >
                <transaction-info :Transaction="Transaction"></transaction-info>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane == 'الإيضاحات'">
                <transaction-clearances
                    :Transaction="Transaction"
                ></transaction-clearances>
            </div>
            <div
                class="tab-pane fade in show"
                v-if="ActivePane == 'إيضاح_الأيضاحات'"
            >
                <transaction-clearance-of-clearances
                    :Transaction="Transaction"
                ></transaction-clearance-of-clearances>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane == 'القوائم'">
                <transaction-financial-statements
                    :Transaction="Transaction"
                ></transaction-financial-statements>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane == 'العينة'">
                <account-statements-sample
                    :Transaction="Transaction"
                ></account-statements-sample>
            </div>
        </div>

        <div class="text-center">
            <button
                @click="UpdateTransactionStatus('reviser')"
                class="btn btn-success btn-lg"
            >
                إرسال الى المراجع الفني
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "AuditorEditTransaction",
    props: {
        Transaction: Object
    },
    data() {
        return {
            ActivePane: "بيانات المعاملة"
        };
    },
    methods: {
        UpdateTransactionStatus() {
            let formData = new FormData();
            formData.append("_method", "PATCH");
            formData.append("status", "المراجع الفني");
            axios
                .post(
                    route("Transactions.update", this.Transaction.id),
                    formData
                )
                .then(res => {
                    this.$toast.success(".", "تم الأرسال الى المراجع الفني", {
                        timout: 3000
                    });
                })
                .catch(error => {
                    this.$toast.error(".", "خطأ, برجاء المحاولة مرة أخرى", {
                        timeout: 3000
                    });
                });
        }
    }
};
</script>

<style scoped>
.v-list-item .v-list-item__subtitle, .v-list-item .v-list-item__title {
    line-height: 1.5;
}
</style>
