<template>
<div>
    <v-tabs v-model="tab" background-color="primary" dark centered icons-and-text>
        <v-tab @click="ActivePane = 'بيانات المعاملة' ">
            {{$t('transactionInfoTitle')}}
            <v-icon>fa fa-star-o</v-icon>
        </v-tab>

        <v-tab @click="ActivePane = 'عدد ساعات المعاملة' ">
            {{$t('transactionHours')}}
            <v-icon>fa fa-clock-o</v-icon>
        </v-tab>

        <v-tab @click="ActivePane = 'الملفات' ">
            {{$t('files')}}
            <v-icon>fa fa-files-o</v-icon>
        </v-tab>

        <v-tab @click="ActivePane = 'الحسابات' ">
            {{$t('accounts')}}
            <v-icon>fa fa-book</v-icon>
        </v-tab>

        <v-tab @click="ActivePane = 'الشريك الأداري' ">
            {{$t('managinePartner')}}
            <v-icon>fa fa-user</v-icon>
        </v-tab>
    </v-tabs>
    <div class="tab-content">
        <div class="tab-pane fade in show" v-if="ActivePane=='عدد ساعات المعاملة'">
            <div class="container box" style="margin-top: 20px">
                <div v-if="LoadingSpinner" class="overlay">
                    <i class="fa fa-refresh fa-spin">
                    </i>
                </div>
                <div class="box-body">
                    <div class="box-header">
                        <h2> توزيع عدد الساعات </h2>
                    </div>
                    <form id="EditTransactionForm" class="form-group" @submit.prevent="">
                        <!-- Start / End Date  ------>
                        <div class="row form-group">
                            <div class="col-md-6" style="padding-top: 15px">
                                <label>تاريخ بداية المعاملة</label>
                                <VueCtkDateTimePicker :format="'YYYY-MM-DD H:mm'" :formatted="'H:mm , Y-M-D '" label="أختر التاريخ و الوقت" v-model="Transaction.start_date" :disabled="true"></VueCtkDateTimePicker>

                            </div>
                            <div class="col-md-6" style="padding-top: 15px">
                                <label>تاريخ انتهاء المعاملة</label>
                                <VueCtkDateTimePicker :format="'YYYY-MM-DD H:mm'" :formatted="'H:mm , Y-M-D '" :default="Transaction.end_date" label="أختر التاريخ و الوقت" v-model="end_date" :disabled="true"></VueCtkDateTimePicker>
                            </div>
                        </div>
                        <!-- ./ Start / End Date  ------>
                        <!-- توزيع ساعات العمل  ------>
                        <div class="row" style="padding-top:15px;padding-bottom:15px">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="color: white;background-color: #00a65a;border-color:white">السكرتير</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">الميدانى</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المراجع الفنى</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المدقق</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">مدير المراجعة</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المدير التنفيذي</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">الشريك</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المساعد</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            <input type="text" class="form-control" v-model="Transaction.secretary_time" disabled>
                                        </td>
                                        <td><input type="text" class="form-control" v-model="Transaction.fieldDelegate_time" disabled></td>
                                        <td><input type="text" class="form-control" v-model="Transaction.reviser_time" disabled></td>
                                        <td><input type="text" class="form-control" v-model="Transaction.auditor_time" disabled></td>
                                        <td><input type="text" class="form-control" v-model="Transaction.revisingManager_time" disabled></td>
                                        <td><input type="text" class="form-control" v-model="Transaction.executiveDirector_time" disabled></td>
                                        <td><input type="text" class="form-control" v-model="Transaction.Managing_partner_time" disabled></td>
                                        <td><input type="text" class="form-control" v-model="Transaction.helper_time" disabled></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- توزيع ساعات العمل/.  ------>
                        <!-- اختيرا المندوب الميدانى و المدقق  ------>
                        <div class="row">
                            <div class="col-md-4" style="padding-top: 15px">
                                <label> المندوب الميداني</label>
                                <input v-if="Transaction.field_delegate" class="form-control" v-model="Transaction.field_delegate.name" disabled>
                            </div>
                        </div>

                        <!-- اختيرا المندوب الميدانى و المدقق/.  ------>

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
        <div class="tab-pane fade in show" v-if="ActivePane=='الشريك الأداري'">
            <div class="container box" style="margin-top: 20px">
                <div v-if="LoadingSpinner" class="overlay">
                    <i class="fa fa-refresh fa-spin">
                    </i>
                </div>
                <v-card>
                    <v-continaer>
                        <v-card-title>
                            {{$t('managinePartner')}}
                        </v-card-title>
                        <v-form id="AddPartnerForm" @submit.prevent="UpdatePartner()">
                            <v-row>
                                <v-col cols="6">
                                    <v-autocomplete v-model="ChoosenPartner" :items="Partners" :label="$t('chooseManaginPartner')" outlined item-text="label" item-value="code">

                                    </v-autocomplete>
                                </v-col>
                            </v-row>
                            <v-card-actions>

                                <v-btn type="submit" v-if="!Transaction.partner" form="AddPartnerForm" color="primary" dark>
                                    {{$t('save')}}
                                </v-btn>
                                <v-btn type="submit" v-else form="AddPartnerForm" color="primary" dark>
                                    {{$t('edit')}}
                                </v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-continaer>
                </v-card>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="text-center">
            <button @click="UpdateTransactionStatus('managing_partner')" class="btn btn-success btn-lg">إرسال إلى الشريك الإداري</button>
        </div>
    </div>
</div>
</template>

<script>
export default {

    name: "RevisingManagerEditTransaction.vue",
    props: {
        'Transaction': '',

    },
    data() {
        return {
            LoadingSpinner: '',

            ActivePane: 'بيانات المعاملة',
            Partners: [],
            ChoosenPartner: '',
        }
    },
    created() {
        this.GetPartners(route('employee.type', 'شريك اداري'));
    },
    mounted() {
        if (this.Transaction.partner) {
            this.ChoosenPartner = {
                'label': this.Transaction.partner.name,
                'code': this.Transaction.partner.id
            }
        }
    },
    methods: {
        GetPartners(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    data.employees.forEach((partner) => {
                        this.Partners.push({
                            'label': partner.name,
                            'code': partner.id
                        });
                    });
                });
        },
        UpdateTransactionStatus(status) {
            let formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('status', status);
            axios.post(route('Transactions.update', this.Transaction.id), formData)
                .then((res) => {
                    this.$toast.success('.', 'تم اعتماد المعاملة', {
                        timeout: 3000
                    });
                }).catch((error) => {
                    this.$toast.error('.', 'خطأ, برجاء المحاولة مرة أخرى', {
                        timeout: 3000
                    });
                })
        },
        UpdatePartner() {
            if (this.ChoosenPartner == null) {
                this.$toast.error('.', 'برجاء تحديد الشريك', {
                    timeout: 3000
                });
            }
            let formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('partner_id', this.ChoosenPartner.code);
            axios.post(route('Transactions.update', this.Transaction.id), formData)
                .then((res) => {
                    this.$toast.success('.', 'تم تحديد الشريك بنجاح', {
                        timout: 3000
                    });
                }).catch((error) => {
                    this.$toast.error('.', 'خطأ, برجاء المحاولة مرة أخرى', {
                        timeout: 3000
                    });
                })
        }
    }

}
</script>

<style scoped>

</style>
