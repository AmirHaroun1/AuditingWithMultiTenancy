<template>
<div id="PaymentSection">
    <v-form v-model="valid" @submit.prevent="submitPaymentData()">
        <v-card>
            <v-card-title>
                {{$t('payment')}}
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete v-model="measurement_standard_determinants" outlined :items="measurement_standard_determinantsOptions" item-text="value" item-value="value" :label="$t('measurmentStandardDetemine')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete v-model="measurement_standard" outlined :items="measurement_standardOptions" item-text="value" item-value="value" :label="$t('measurmentStandrad')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @input="CheckTotal_value()" v-model="agreed_contract_value" outlined :rules="numbersRules" autocomplete="MainTradeRegister" :label="$t('mainTradeNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="secretary_notes" outlined :label="$t('notes')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @input="CheckTotal_value()" v-model="value_added_tax_percentage" :rules="required" persistent-hint :hint="value_added_tax_amount + $t('ryal')" outlined :label="$t('addedValue')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @input="CheckTotal_value()" v-model="zakat_deposit_fees" :rules="numbersRules" outlined :label="$t('zakahDeposit')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @input="CheckTotal_value()" v-model="zakat_deposit_fees" :rules="numbersRules" outlined :label="$t('zakahDeposit')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @input="CheckTotal_value()" v-model="offer_value" :rules="numbersRules" outlined :label="$t('discountValue')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="total_value" disabled outlined :label="$t('total')" />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @input="CheckFinal_Payment()" v-model="down_payment" :rules="numbersRules" outlined :label="$t('prePaid')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="final_payment" outlined disabled :label="$t('finalPatch')" />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="this.$parent.Institution.id" outlined disabled :label="$t('clientCode')" />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete @change="changeStatus" v-model="status" outlined :items="statusOptions" :label="$t('transactionStatus')" required />
                        </v-col>
                        <v-col v-if="status == 'rejected'" cols="12" sm="6" md="6">
                            <v-text-field v-model="rejection_reason" :rules="required" outlined :label="$t('rejectionReason')" required />
                        </v-col>

                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn type="submit" color="primary" dark>
                    {{$t('save')}}
                </v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-form>
    <v-form>
        <v-card>
            <v-card-title>
                {{$t('printSalary')}}
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="ReviserCompanyName" outlined :label="$t('ReviserCompanyName')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete v-model="PaymentType" outlined :items="PaymentTypeOptions" :label="$t('paymentType')" required />
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn link :href="PrintLink" target="_blank" color="primary" dark>
                    {{$t('printSalaryContract')}}
                </v-btn>
                <v-btn link :href="EngagementLetterLink" target="_blank" color="primary" dark>
                    {{$t('printEngagment')}}
                </v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-form>
</div>
</template>

<script>
export default {
    props: {
        'Transaction': Object,
    },
    data() {
        return {
            LoadingSpinner: '',
            ValidationErrors: '',
            secretary_notes: '',
            valid: false,
            startingDate: new Date(),
            measurement_standard_determinantsOptions: [],
            measurement_standardOptions: [],

            measurement_standard_determinants: this.Transaction.measurement_standard_determinants,
            measurement_standard: this.Transaction.measurement_standard,

            agreed_contract_value: this.Transaction.agreed_contract_value,

            down_payment: this.Transaction.down_payment,
            final_payment: this.Transaction.final_payment,
            total_value: this.Transaction.total_value,

            value_added_tax_percentage: '15' + '%',
            value_added_tax_amount: this.Transaction.value_added_tax,
            zakat_deposit_fees: this.Transaction.zakat_deposit_fees,
            offer_value: this.Transaction.offer_value,
            status: this.Transaction.status,
            rejection_reason: this.Transaction.rejection_reason,

            ReviserCompanyName: 'مكتوب مسعود الرفيدى',
            PaymentType: 'مقدم أتعاب',
            PaymentValue: '',
            financial_year: this.Transaction.financial_year,
            statusOptions: [{
                    text: this.$t('withdrawn'),
                    value: 'withdrawn'
                },
                {
                    text: this.$t('sentToReviser'),
                    value: 'reviser'
                },
                {
                    text: this.$t('rejected'),
                    value: 'rejected'
                },
            ],
            PaymentTypeOptions: [
                "مقدم أتعاب", "مقدم أتعاب نهائية"
            ],
            numbersRules: [
                v => !!v || this.$t('requiredField'),
                v => /^\d+$/.test(v) || this.$t('numbersOnly'),
            ],
            emailRules: [
                v => !!v || this.$t('requiredField'),
                v => /.+@.+/.test(v) || this.$t('emailNotValid'),
            ],
            required: [
                v => !!v || this.$t('requiredField'),
            ],

        }

    },

    created() {
        this.GetDropDowns(route('system.DropDowns.retrieve.option'));

    },
    methods: {
        GetDropDowns(endpoint) {
            this.LoadingSpinner = true;
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    data.DropDownsOptions.forEach((option, index) => {

                        if (option.name == 'محددات معيار القياس') {
                            this.measurement_standard_determinantsOptions.push(option);
                        } else if (option.name == 'معيار القياس') {
                            this.measurement_standardOptions.push(option);
                        }
                    })
                })
            this.LoadingSpinner = false;
        },
        submitPaymentData() {
            this.LoadingSpinner = true;
            let formData = new FormData();
            const date = new Date();
            const diffTime = Math.abs(this.startingDate - date);
            const diffHours = Math.ceil(diffTime / (1000 * 60 * 60));
            const diffMinutes = Math.ceil(diffTime / (1000 * 60));
            const actual_time = parseFloat(diffHours + '.' + diffMinutes);

            formData.append('_method', 'PATCH');
            formData.append('measurement_standard_determinants', this.measurement_standard_determinants);
            formData.append('measurement_standard', this.measurement_standard);
            formData.append('secretary_notes', this.secretary_notes);
            formData.append('secretary_actualTime', actual_time);

            formData.append('agreed_contract_value', this.agreed_contract_value);
            formData.append('value_added_tax', this.value_added_tax_amount);
            formData.append('zakat_deposit_fees', this.zakat_deposit_fees);
            formData.append('offer_value', this.offer_value);

            formData.append('down_payment', this.down_payment);
            formData.append('final_payment', this.final_payment);
            formData.append('total_value', this.total_value);
            formData.append('status', this.status);
            axios.post(route('Transactions.update', this.Transaction.id), formData)
                .then((res) => {
                    this.LoadingSpinner = false;

                    this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                        'قد تم تسجيل البيانات بنجاح ', {
                            timout: 2000
                        });

                }).catch((error) => {
                    this.LoadingSpinner = false;

                    this.ValidationErrors = error.response.data.errors;

                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });
                })
        },
        CheckTotal_value() {
            this.value_added_tax_amount = parseFloat(this.agreed_contract_value) * (parseFloat(this.value_added_tax_percentage.replace('%', '')) / 100);
            return this.total_value = (parseFloat(this.agreed_contract_value) + parseFloat(this.zakat_deposit_fees) + this.value_added_tax_amount) - parseInt(this.offer_value);
        },
        CheckFinal_Payment() {
            return this.final_payment = parseFloat(this.total_value) - parseFloat(this.down_payment);
        },
        changeStatus() {
            let formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('status', this.status);
            axios.post(route('Transactions.update', this.Transaction.id), formData).then(res => {
                console.log('res', res)
            }).catch(err => {
                console.log('err', err)
            })
        }
    },
    computed: {
        PrintLink() {
            if (this.PaymentType == 'دفعة أتعاب نهائية') {
                this.PaymentValue = this.final_payment;
            } else {
                this.PaymentValue = this.down_payment;
            }

            return route('Print.ReceiptVoucher', {
                TransactionYear: this.financial_year,
                CompanyName: this.$parent.Institution.name,
                PaymentType: this.PaymentType,
                PaymentValue: this.PaymentValue,
                ReviserCompanyName: this.ReviserCompanyName
            });
        },
        EngagementLetterLink() {
            return route('Print.EngagementLetter', [this.$parent.Institution, this.Transaction]);
        }

    },

    name: "PaymentDetailsForm.vue",

}
</script>

<style scoped>

</style>
