<template>
    <div>
        <v-container>
            <v-row>
                <!-- بيانات المعاملة -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'بيانات المعاملة'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    {{ $t("transactionsData") }}
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-archive
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                    <!-- /.info-box -->
                </v-col>
                <!-- بيانات المعاملة./ -->
                <!-- الملفات -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'الملفات'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    {{ $t("files") }}
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-file-multiple
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- الملفات/. -->
                <!-- ميزان المراجعة -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'ميزان المراجعة'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    ميزان المراجعة
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-scale-balance
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- ميزان المراجعة/. -->
                <!-- الحسابات -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'الحسابات'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    الحسابات
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-abacus
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- الحسابات -->
                <!-- الأيضاحات -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'الإيضاحات'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    الإيضاحات
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-white-balance-sunny
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>

                <!-- الأيضاحات -->
                <!-- إيضاح_الأيضاحات -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'إيضاح_الأيضاحات'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    إيضاح الإيضاحات
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-information-outline
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- إيضاح_الأيضاحات -->
                <!-- القوائم -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'القوائم'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    القوائم المالية
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-information-outline
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- القوائم -->

                <!-- العينة -->
                <v-col cols="12" sm="6" md="3">
                    <v-card
                        class="mx-auto rounded-xl"
                        outlined
                        @click="ActivePane = 'العينة'"
                    >
                        <v-list-item three-line>
                            <v-list-item-content>
                                <v-list-item-title class="headline">
                                    العينة
                                </v-list-item-title>
                            </v-list-item-content>
                            <v-list-item-avatar size="60">
                                <v-avatar color="indigo">
                                    <v-icon dark>
                                        mdi-information-outline
                                    </v-icon>
                                </v-avatar>
                            </v-list-item-avatar>
                        </v-list-item>
                    </v-card>
                </v-col>
                <!-- العينة -->
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

        <div class="d-flex justify-center mt-5">
                <v-btn
                    @click.native="UpdateTransactionStatus('reviser')"
                    depressed
                    x-large
                    color="primary"
                >
                    إرسال الى المراجع الفني
                </v-btn>
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
            ActivePane: "ميزان المراجعة"
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
.v-list-item .v-list-item__subtitle,
.v-list-item .v-list-item__title {
    line-height: 1.5;
}
</style>
