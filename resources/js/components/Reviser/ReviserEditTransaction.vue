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
    </v-tabs>

    <div class="tab-content">
        <div class="tab-pane fade in show" v-if="ActivePane=='عدد ساعات المعاملة'">
            <div class="container box" style="margin-top: 20px">
                <div v-if="LoadingSpinner" class="overlay">
                    <i class="fa fa-refresh fa-spin">
                    </i>
                </div>
                <div>
                    <v-form>
                        <v-card>
                            <v-container>
                                <v-card-title>
                                    {{$t('transactionInfoAndHours')}}
                                </v-card-title>
                                <v-form @submit.prevent="UpdateTransaction()">
                                    <!-- Start / End Date  ------>
                                    <div class="row form-group">
                                        <div class="col-md-6" style="padding-top: 15px">
                                            <label>تاريخ بداية المعاملة</label>
                                            <VueCtkDateTimePicker :format="'YYYY-MM-DD H:mm'" :formatted="'H:mm , Y-M-D '" label="أختر التاريخ و الوقت" v-model="start_date"></VueCtkDateTimePicker>

                                        </div>
                                        <div class="col-md-6" style="padding-top: 15px">
                                            <label>تاريخ انتهاء المعاملة</label>
                                            <VueCtkDateTimePicker :format="'YYYY-MM-DD H:mm'" :formatted="'H:mm , Y-M-D '" label="أختر التاريخ و الوقت" v-model="end_date"></VueCtkDateTimePicker>
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
                                    <v-row>
                                        <v-col md="6">
                                            <v-autocomplete v-model="ChoosenAuditor" :items="auditors" :label="$t('chooseAuditor')" outlined item-text="label" item-value="code">

                                            </v-autocomplete>
                                        </v-col>
                                        <v-col md="6">
                                            <v-autocomplete v-model="ChoosenFieldDelegate" :items="fieldDelegates" :label="$t('ChooseFieldDelegate')" outlined item-text="label" item-value="code">

                                            </v-autocomplete>
                                        </v-col>
                                    </v-row>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn type="submit" color="primary" dark>
                                            {{$t('save')}}
                                        </v-btn>
                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </v-form>
                            </v-container>
                        </v-card>
                    </v-form>
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
                <button @click="UpdateTransactionStatus('revising_manager')" class="btn btn-success btn-lg">إرسال الى مدير المراجعة</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="pull-left">
                <button @click="UpdateTransactionStatus('auditor')" class="btn btn-danger btn-lg">إرسال الى المدقق</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {

    name: "ReviserEditTransaction.vue",
    props: {
        'Transaction': '',

    },
    data() {
        return {
            LoadingSpinner: '',
            auditors: [],
            ChoosenAuditor: '',
            ActivePane: 'بيانات المعاملة',
            ChoosenFieldDelegate: '',
            fieldDelegates: [],
            start_date: this.Transaction.start_date,
            end_date: this.Transaction.end_date,
            secretary_time: this.Transaction.secretary_time,
            reviser_time: this.Transaction.reviser_time,
            auditor_time: this.Transaction.auditor_time,
            fieldDelegate_time: this.Transaction.fieldDelegate_time,
            revisingManager_time: this.Transaction.revisingManager_time,
            helper_time: this.Transaction.helper_time,
            executiveDirector_time: this.Transaction.executiveDirector_time,
            Managing_partner_time: this.Transaction.Managing_partner_time,
        }
    },
    mounted() {
        if (this.Transaction.auditor) {
            this.ChoosenAuditor = {
                'label': this.Transaction.auditor.name,
                'code': this.Transaction.auditor.id
            }
        }
        if (this.Transaction.field_delegate) {
            this.ChoosenFieldDelegate = {
                'label': this.Transaction.field_delegate.name,
                'code': this.Transaction.field_delegate.id
            }
        }
    },
    created() {
        this.GetAuditors(route('employee.type', 'مدقق'))

        this.GetFieldDelegates(route('employee.type', 'مندوب ميداني'))
    },
    methods: {
        UpdateTransactionStatus(status) {
            let formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('status', status);
            axios.post(route('Transactions.update', this.Transaction.id), formData)
                .then((res) => {
                    this.$toast.success('.', status, {
                        timout: 3000
                    });
                }).catch((error) => {
                    this.$toast.error('.', 'خطأ, برجاء المحاولة مرة أخرى', {
                        timeout: 3000
                    });
                })
        },
        UpdateTransaction() {

            var formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('Managing_partner_time', this.Managing_partner_time);
            formData.append('executiveDirector_time', this.executiveDirector_time);
            formData.append('helper_time', this.helper_time);
            formData.append('revisingManager_time', this.revisingManager_time);
            formData.append('fieldDelegate_time', this.fieldDelegate_time);
            formData.append('auditor_time', this.auditor_time);
            formData.append('reviser_time', this.reviser_time);
            formData.append('secretary_time', this.secretary_time);
            if (this.end_date) {
                formData.append('end_date', this.end_date);
            }
            if (this.start_date) {
                formData.append('start_date', this.start_date);
            }
            if (this.ChoosenFieldDelegate) {
                formData.append('fieldDelegate_id', this.ChoosenFieldDelegate.code);
            }
            if (this.ChoosenAuditor) {
                formData.append('auditor_id', this.ChoosenAuditor.code);
            }
            console.log(formData);
            axios.post(route('Transactions.update', this.Transaction.id), formData)
                .then((res) => {
                    console.log(res);
                    this.LoadingSpinner = false;
                    this.ValidationErrors = '';
                    this.$toast.success('.',
                        'قد تم اضافة بيانات المعاملة بنجاح', {
                            timout: 2000
                        })

                }).catch((error) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });

                });

        },
        GetAuditors(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    this.LoadingSpinner = true;
                    data.employees.forEach((auditor) => {
                        this.auditors.push({
                            'label': auditor.name,
                            'code': auditor.id
                        });
                    });
                    this.LoadingSpinner = false;

                });
        },
        GetFieldDelegates(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    this.LoadingSpinner = true;

                    data.employees.forEach((fieldDelegate) => {
                        this.fieldDelegates.push({
                            'label': fieldDelegate.name,
                            'code': fieldDelegate.id
                        });

                    });
                    this.LoadingSpinner = false;

                });
        },
    },

}
</script>

<style scoped>

</style>
