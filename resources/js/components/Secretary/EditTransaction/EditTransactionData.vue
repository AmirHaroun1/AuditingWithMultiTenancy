<template>
<div>
    <v-form v-model="valid" @submit.prevent="UpdateMainRegister()">
        <v-card>
            <v-card-title>
                {{$t('transactionInfo')}}
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field v-model="MainTradeRegister.number" outlined :rules="numbersRules" autocomplete="MainTradeRegister" :label="$t('mainTradeNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="MainTradeRegister.date" name="national_id_date" :label="$t('mainTradeDate')" prepend-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="MainTradeRegister.date" @input="menu2 = false"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field v-model="MainTradeRegister.production_place" outlined :rules="required" autocomplete="MainTradeRegisterPlace" :label="$t('mainTradePlace')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field v-model="MainTradeRegister.production_place" outlined :rules="required" autocomplete="MainTradeRegisterPlace" :label="$t('mainTradePlace')" required />
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-divider></v-divider>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="Institution.name" :rules="required" outlined autocomplete="companyName" :label="$t('copmanyName')" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="Institution.number" type="number" outlined :rules="numbersRules" autocomplete="companyNumber" :label="$t('compnayNumber')" required></v-text-field>
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete v-model="Institution.legal_entity" outlined :items="legal_entityOptions" item-text="value" item-value="value" :label="$t('lawyalFoundation')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete v-model="Institution.angel_interests" outlined :items="angel_interestsOptions" item-text="value" item-value="value" :label="$t('ownersPrefrences')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete v-model="Institution.nature" outlined :items="natureOptions" item-text="value" item-value="value" :label="$t('ownersNature')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete v-model="Institution.date_type" outlined :items="[$t('christian'), $t('hijri')]" :label="$t('copmanyDateFormat')" required />
                        </v-col>
                        <v-col cols="12" sm="9" md="9">
                            <v-textarea v-model="Institution.business_activity" :rules="required" outlined autocomplete="business_activity" :label="$t('companyActivity')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-autocomplete v-model="City" outlined :rules="required" :items="cityOptions" item-text="value" item-value="value" :label="$t('addressCity')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-autocomplete v-model="District" outlined :rules="required" :items="districtOptions" item-text="value" item-value="value" :label="$t('addressDistrict')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field v-model="RestOfAddress" outlined :rules="required" :label="$t('addressComplete')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field v-model="Institution.charity_num" outlined :rules="numbersRules" :label="$t('zakahSpecialNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="4">
                            <v-text-field v-model="Institution.extra_tax_num" outlined :rules="numbersRules" :label="$t('extraTaxesNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-divider></v-divider>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="MainTradeRegister.EndDate" :label="$t('tradeEndDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="MainTradeRegister.EndDate"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field @change="SetFinancialDates()" v-model="Transaction.financial_year" outlined :rules="numbersRules" :label="$t('finaincialYear')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete @change="SetFinancialDates()" v-model="Transaction.financial_period" outlined :rules="required" :items="[$t('finaincialYear2'), $t('shortPeriod'), $t('longPeriod')]" item-text="value" item-value="value" :label="$t('finaincialPeriod')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="Transaction.start_financial_year" :label="$t('finaincialYearStart')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="Transaction.start_financial_year"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="Transaction.end_financial_year" :label="$t('finaincialYearEnd')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="Transaction.end_financial_year"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-divider></v-divider>
                        </v-col>
                        <v-col cols="12">
                            <v-card>
                                <v-card-title>
                                    <span class="mr-3 ml-3">{{$t('branchesTrades')}}</span>
                                    <v-spacer></v-spacer>
                                    <v-dialog v-model="addDialog" max-width="600px">
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn color="primary" class="mt-4" dark v-bind="attrs" v-on="on">
                                                <v-icon>mdi-plus</v-icon> {{$t('addBranchTrade')}}
                                            </v-btn>
                                        </template>
                                        <v-card>
                                            <v-card-title>
                                                {{$t('addBranchTrade')}}
                                            </v-card-title>
                                            <v-form id="BranchRegisterForm" @submit.prevent="AddBranchedRegister(); addDialog = false">
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field v-model="NewBranchedRegister.number" outlined :rules="numbersRules" :label="$t('tradeNumber')" required />
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-text-field v-model="NewBranchedRegister.production_place" outlined :rules="required" :label="$t('tradePlace')" required />
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                                        <template v-slot:activator="{ on, attrs2 }">
                                                            <v-text-field outlined v-model="NewBranchedRegister.date" :label="$t('tradeDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                                        </template>
                                                        <v-date-picker v-model="NewBranchedRegister.date"></v-date-picker>
                                                    </v-menu>
                                                </v-col>
                                                <v-col cols="12" sm="6" md="6">
                                                    <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                                        <template v-slot:activator="{ on, attrs2 }">
                                                            <v-text-field outlined v-model="NewBranchedRegister.EndDate" :label="$t('tradeEndDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                                        </template>
                                                        <v-date-picker v-model="NewBranchedRegister.EndDate"></v-date-picker>
                                                    </v-menu>
                                                </v-col>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn type="submit" form="BranchRegisterForm" color="primary" dark>
                                                        {{$t('save')}}
                                                    </v-btn>
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-form>
                                        </v-card>
                                    </v-dialog>
                                </v-card-title>

                                <v-data-table :headers="headers" :items="BranchedTradeRegisters">
                                    <template v-slot:item.action="{ item }">
                                        <v-dialog v-model="editDialog" max-width="600px">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-icon small class="mr-2" @click="editDialog = true;" v-on="on" v-bind="attrs">
                                                    mdi-pencil
                                                </v-icon>
                                            </template>
                                            <v-card>
                                                <v-card-title>
                                                    {{$t('editBranchTrade')}}
                                                </v-card-title>
                                                <v-form id="BranchRegisterFormEdit" @submit.prevent="UpdateRegister(item); editDialog = false;">
                                                    <v-col cols="12" sm="6" md="6">
                                                        <v-text-field v-model="item.number" outlined :rules="numbersRules" :label="$t('tradeNumber')" required />
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="6">
                                                        <v-text-field v-model="item.production_place" outlined :rules="required" :label="$t('tradePlace')" required />
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="6">
                                                        <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                                            <template v-slot:activator="{ on, attrs2 }">
                                                                <v-text-field outlined v-model="item.date" :label="$t('tradeDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                                            </template>
                                                            <v-date-picker v-model="item.date"></v-date-picker>
                                                        </v-menu>
                                                    </v-col>
                                                    <v-col cols="12" sm="6" md="6">
                                                        <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                                            <template v-slot:activator="{ on, attrs2 }">
                                                                <v-text-field outlined v-model="item.EndDate" :label="$t('tradeEndDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                                            </template>
                                                            <v-date-picker v-model="item.EndDate"></v-date-picker>
                                                        </v-menu>
                                                    </v-col>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn type="submit" form="BranchRegisterFormEdit" color="primary" dark>
                                                            {{$t('save')}}
                                                        </v-btn>
                                                        <v-spacer></v-spacer>
                                                    </v-card-actions>
                                                </v-form>
                                            </v-card>
                                        </v-dialog>
                                        <v-icon small @click="DeleteRegister(item)">
                                            mdi-delete
                                        </v-icon>
                                    </template>
                                </v-data-table>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete  v-model="ChoosenReviser" outlined :rules="required" :items="revisers" item-text="label" item-value="code" :label="$t('reviser')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete  v-model="ChoosenRevisingManager" outlined :rules="required" :items="revisingManagers" item-text="label" item-value="code" :label="$t('revisingManager')" required />
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
    <div v-if="LoadingSpinner" class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>
</template>

<script>
export default {
    name: "EditTransactionData.vue",

    data() {
        return {
            ValidationErrors: '',
            CompanyError: '',
            LoadingSpinner: false,
            addDialog: false,
            menu2: false,
            valid: false,
            editDialog: false,
            selectedItem: null,
            Transaction: this.$parent.Transaction,
            MainTradeRegister: this.$parent.MainTradeRegister,
            BranchedTradeRegisters: this.$parent.BranchedTradeRegisters,
            Institution: this.$parent.Institution,
            headers: [{
                    text: this.$t('tradeNumber'),
                    align: 'start',
                    value: 'number',
                },
                {
                    text: this.$t('tradePlace'),
                    value: 'production_place',
                },
                {
                    text: this.$t('tradeDate'),
                    value: 'date',
                },
                {
                    text: this.$t('tradeEndDate'),
                    value: 'EndDate',
                },
                {
                    text: this.$t('action'),
                    value: 'action',
                },
            ],
            NewBranchedRegister: {
                id: '',
                number: '',
                date: '',
                EndDate: '',
                production_place: '',
                type: 'فرعي'
            },
            revisers: [],
            revisingManagers: [],
            ChoosenReviser: this.$parent.reviser,
            ChoosenRevisingManager: this.$parent.revisingManager,

            legal_entityOptions: [],
            angel_interestsOptions: [],
            natureOptions: [],
            cityOptions: [],
            districtOptions: [],

            City: '',
            District: '',
            RestOfAddress: '',
            MainRegisterIS_UPDATED: false,
            InstitutionIS_UPDATED: false,
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
        this.GetRevisers(route('employee.type', 'مراجع فني'));
        this.GetRevisingManagers(route('employee.type', 'مدير مراجعة'));;

        this.GetDropDowns(route('system.DropDowns.retrieve.option'));

        this.City = this.Institution.address.split(',')[0];
        this.District = this.Institution.address.split(',')[1];
        this.RestOfAddress = this.Institution.address.split(',')[2];
    },
    methods: {
        GetRevisers(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    data.employees.forEach((reviser) => {
                        this.revisers.push({
                            'label':

                                'الكود : ' +
                                reviser.id

                                +
                                ' , ' +
                                'الأسم : ' +
                                reviser.name

                                ,
                            'code': reviser.id
                        });

                    });
                })
        },
        // get all the RevisingManagers in the system and put them in the array
        GetRevisingManagers(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    data.employees.forEach((revisingManager) => {
                        this.revisingManagers.push({
                            'label':

                                'الكود : ' +
                                revisingManager.id +
                                ' , ' +
                                'الأسم : ' +
                                revisingManager.name

                                ,
                            'code': revisingManager.id
                        });
                    });
                })
        },
        // get DropDowns
        GetDropDowns(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    data.DropDownsOptions.forEach((option, index) => {

                        if (option.name == 'الكيان القانونى') {
                            this.legal_entityOptions.push(option);
                        } else if (option.name == 'اهتمامات الملاك') {
                            this.angel_interestsOptions.push(option);
                        } else if (option.name == 'طبيعة ملكية المنشأة وكيفية تمويلها') {
                            this.natureOptions.push(option);
                        } else if (option.name == 'المدينة') {
                            this.cityOptions.push(option);
                        } else if (option.name == 'الحي') {
                            this.districtOptions.push(option);
                        }

                    })
                })
        },

        SetFinancialDates() {
            if (this.Transaction.financial_period == 'سنة مالية') {
                this.Transaction.start_financial_year = this.Transaction.financial_year + "-01-01";
                this.Transaction.end_financial_year = this.Transaction.financial_year + "-12-31";
            }
        },

        UpdateMainRegister() {

                this.LoadingSpinner = true;
                var formData = new FormData();
                formData.append('_method', 'PATCH');
                formData.append('number', this.MainTradeRegister.number);
                formData.append('date', this.MainTradeRegister.date);
                formData.append('production_place', this.MainTradeRegister.production_place);
                formData.append('EndDate', this.MainTradeRegister.EndDate);
                formData.append('type', 'رئيسي');
                axios.post(route('TradeRegister.update', this.MainTradeRegister.id), formData)
                    .then(({
                        data
                    }) => {
                        this.LoadingSpinner = false;
                        this.ValidationErrors = '';
                        this.MainRegisterIS_UPDATED = true;
                        this.UpdateInstitution();
                    })
                    .catch((error) => {
                        this.LoadingSpinner = false;
                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ', register.number + 'يرجى اعادة مراجعة بيانات سجل فرعي رقم ', {
                            timout: 2000
                        });
                    })


        },

        UpdateInstitution() {
                this.LoadingSpinner = true;

                var formData = new FormData();

                formData.append('_method', 'PATCH');
                formData.append('address', this.getAddress);
                formData.append('business_activity', this.Institution.business_activity);
                formData.append('name', this.Institution.name);
                formData.append('number', this.Institution.number);
                formData.append('legal_entity', this.Institution.legal_entity);
                formData.append('angel_interests', this.Institution.angel_interests);
                formData.append('date_type', this.Institution.date_type);
                formData.append('nature', this.Institution.nature);
                formData.append('charity_num', this.Institution.charity_num);
                formData.append('extra_tax_num', this.Institution.extra_tax_num);
                axios.post(route('Institution.update', this.Institution.id),
                    formData
                ).then((res) => {
                    this.LoadingSpinner = false;
                    this.CompanyError = false;
                    this.InstitutionIS_UPDATED = true;
                    this.UpdateTransaction();
                }).catch((error) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = error.response.data.errors;

                    this.CompanyError = true;
                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });
                });


        },

        UpdateTransaction() {
            this.LoadingSpinner = true;

            var formData = new FormData();

            formData.append('_method', 'PATCH');
            formData.append('financial_year', this.Transaction.financial_year);
            formData.append('start_financial_year', this.Transaction.start_financial_year);
            formData.append('end_financial_year', this.Transaction.end_financial_year);
            formData.append('financial_period', this.Transaction.financial_period);
            formData.append('MainTradeRegisterNumber', this.MainTradeRegister.number);
            formData.append('reviser_id', (this.ChoosenReviser.hasOwnProperty('id') ? this.ChoosenReviser.id : this.ChoosenReviser));
            formData.append('revisingManager_id', (this.ChoosenRevisingManager.hasOwnProperty('id') ? this.ChoosenRevisingManager.id : this.ChoosenRevisingManager));
            axios.post(route('Transactions.update', this.Transaction.id), formData)
                .then((res) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = '';
                    this.$toast.success('.',
                        'قد تم تعديل بيانات المعاملة بنجاح', {
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

        UpdateRegister(register) {
            this.LoadingSpinner = true;
            let formData = new FormData();

            formData.append('_method', 'PATCH');
            formData.append('number', register.number);
            formData.append('date', register.date);
            formData.append('EndDate', register.EndDate);
            formData.append('production_place', register.production_place);
            formData.append('type', register.type);

            axios.post(route('TradeRegister.update', register.id), formData)
                .then(({
                    data
                }) => {
                    this.LoadingSpinner = false;
                    this.$toast.success('.',
                        'قد تم تعديل  بيانات السجل بنجاح ', {
                            timout: 2000
                        });
                    this.ValidationErrors = '';
                })
                .catch((error) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ', register.number + 'يرجى اعادة مراجعة بيانات سجل فرعي رقم ', {
                        timout: 2000
                    });
                })
        },

        DeleteRegister(register) {
            this.LoadingSpinner = true;

            let formDate = new FormData();

            formDate.append('_method', 'DELETE');

            axios.post(route('TradeRegister.delete', register.id), formDate)
                .then(res => {
                    this.LoadingSpinner = false;

                    this.$toast.success('.',
                        'قد تم حذف  بيانات السجل بنجاح ', {
                            timout: 2000
                        });
                    this.BranchedTradeRegisters.splice(this.BranchedTradeRegisters.indexOf(register), 1);
                    this.ValidationErrors = '';

                })
                .catch(error => {
                    this.LoadingSpinner = false;

                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ', 'خطأ اثناء الحذف حاول مرة أخرى ', {
                        timout: 2000
                    });
                })
        },

        AddBranchedRegister() {
            this.LoadingSpinner = true;

            let formData = new FormData();

            formData.append('number', this.NewBranchedRegister.number);
            formData.append('date', this.NewBranchedRegister.date);
            formData.append('EndDate', this.NewBranchedRegister.EndDate);
            formData.append('production_place', this.NewBranchedRegister.production_place);
            formData.append('type', this.NewBranchedRegister.type);

            axios.post(route('TradeRegister.store', this.Institution), formData)
                .then(({
                    data
                }) => {
                    this.LoadingSpinner = false;

                    this.$toast.success('.',
                        'قد تم اضافة السجل بنجاح ', {
                            timout: 2000
                        });
                    this.ValidationErrors = '';
                    this.BranchedTradeRegisters.push({
                        'id': data.id,
                        'number': data.number,
                        'date': data.date,
                        'EndDate': data.EndDate,
                        'production_place': data.production_place,
                    })
                    this.clearNewBranchInput();
                })
                .catch((error) => {
                    this.LoadingSpinner = false;

                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ', register.number + 'يرجى اعادة مراجعة بيانات سجل فرعي رقم ', {
                        timout: 2000
                    });
                })

        },
        clearNewBranchInput() {
            this.NewBranchedRegister.number = '';
            this.NewBranchedRegister.date = '';
            this.NewBranchedRegister.production_place = '';
        },

    },
    computed: {

        getAddress() {
            return this.City + ' , ' + this.District + ',' + this.RestOfAddress;
        },

    },
}
</script>

<style scoped>

</style>
