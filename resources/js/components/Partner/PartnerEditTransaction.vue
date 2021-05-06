<template>
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
            <!-- بيانات المعاملة -->
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
                <!-- /.info-box -->
            </v-col>
            <!-- الملفات/. -->

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
        </v-row>

        <div class="tab-content">
            <div
                class="tab-pane fade in show"
                v-if="ActivePane == 'بيانات المعاملة'"
            >
                <transaction-info :Transaction="Transaction"></transaction-info>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane == 'الملفات'">
                <transaction-files
                    :Transaction="Transaction"
                ></transaction-files>
            </div>
            <div class="tab-pane fade in show" v-if="ActivePane == 'الحسابات'">
                <transaction-accounts
                    :Transaction="Transaction"
                ></transaction-accounts>
            </div>
        </div>

        <div class="d-flex justify-center ">
                <v-btn
                    @click.native="UpdateTransactionStatus('finished')"
                    depressed
                    x-large
                    color="primary"
                >
                    اعتماد المعاملة
                </v-btn>
        </div>
    </v-container>
</template>

<script>
export default {
    name: "PartnerEditTransaction.vue",
    props: {
        Transaction: ""
    },
    data() {
        return {
            LoadingSpinner: "",

            ActivePane: "بيانات المعاملة"
        };
    },
    methods: {
        UpdateTransactionStatus(status) {
            let formData = new FormData();
            formData.append("_method", "PATCH");
            formData.append("status", status);
            axios
                .post(
                    route("Transactions.update", this.Transaction.id),
                    formData
                )
                .then(res => {
                    this.$toast.success(".", "تم اعتماد المعاملة", {
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

<style scoped></style>
