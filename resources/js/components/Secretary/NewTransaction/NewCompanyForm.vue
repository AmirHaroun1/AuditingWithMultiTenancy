<template>
<div>
    <v-form v-model="valid" @submit.prevent="createInstitution()">
        <v-card>
            <v-card-title>
                {{$t('transactionInfo')}}
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field disabled v-model="MainTradeRegister.number" outlined :rules="numbersRules" autocomplete="MainTradeRegister" :label="$t('mainTradeNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field v-model="institution.number700" outlined autocomplete="number 700" :label="$t('number700')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="MainTradeRegister.date" name="national_id_date" :label="$t('mainTradeDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="MainTradeRegister.date" @input="menu2 = false"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-autocomplete v-model="InstitutionType" :rules="required" outlined :items="InstitutionTypes" :label="$t('InstitutionType')" required />
                        </v-col>
                        <div v-if="InstitutionType=='organization'" class="row" id="NewOrganizationInformation">
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.name" :rules="required" outlined autocomplete="organizationName" :label="$t('organizationName')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-autocomplete v-model="institution.city" outlined :rules="required" :items="cityOptions" item-text="value" item-value="value" :label="$t('addressCity')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-autocomplete v-model="institution.district" outlined :rules="required" :items="districtOptions" item-text="value" item-value="value" :label="$t('addressDistrict')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="institution.restofadress" outlined :rules="required" :label="$t('addressComplete')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="institution.postal_box" outlined :rules="required" :label="$t('postal_box')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="2">
                                <v-text-field v-model="institution.postal_code" outlined :rules="required" :label="$t('postal_code')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.phone" outlined :rules="numbersRules" autocomplete="phone" :label="$t('phone')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.fax" outlined :rules="required" autocomplete="fax" :label="$t('fax')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.merchant_name" outlined :rules="required" autocomplete="merchant_name" :label="$t('merchant_name')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.merchant_nationality" outlined :rules="required" autocomplete="merchant_nationality" :label="$t('merchant_nationality')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-menu v-model="menu3" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                    <template v-slot:activator="{ on, attrs2 }">
                                        <v-text-field outlined v-model="institution.merchant_birth_date" name="national_id_date" :label="$t('merchant_birth_date')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                    </template>
                                    <v-date-picker v-model="institution.merchant_birth_date" @input="menu3 = false"></v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-textarea v-model="institution.business_activity" outlined :rules="required" autocomplete="business_activity" :label="$t('business_activity')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="institution.capital" outlined :rules="required" autocomplete="capital" :label="$t('capital')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="ManagerTemp.name" outlined :rules="required" autocomplete="managerName" :label="$t('ManagerTempName')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="institution.manager_authorities" outlined :rules="required" autocomplete="manager_authorities" :label="$t('manager_authorities')" required />
                            </v-col>
                        </div>
                        <div v-if="InstitutionType == 'company' " class="row" id="NewCompanyInformation">
                            <v-col cols="12" sm="6" md="4">
                                <v-autocomplete v-model="institution.legal_entity" :rules="required" outlined item-text="name" item-value="value" :items="legal_entityOptions" :label="$t('legal_entity')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="institution.company_nationality" :rules="required" outlined autocomplete="company_nationality" :label="$t('company_nationality')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="institution.company_period" :rules="required" outlined autocomplete="company_period" :label="$t('company_period')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-menu v-model="menu4" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                    <template v-slot:activator="{ on, attrs2 }">
                                        <v-text-field outlined v-model="institution.company_start_period" name="company_start_period" :label="$t('company_start_period')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                    </template>
                                    <v-date-picker v-model="institution.company_start_period" @input="menu4 = false"></v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-menu v-model="menu5" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                    <template v-slot:activator="{ on, attrs2 }">
                                        <v-text-field outlined v-model="institution.company_end_period" name="company_end_period" :label="$t('company_end_period')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                    </template>
                                    <v-date-picker v-model="institution.company_end_period" @input="menu5 = false"></v-date-picker>
                                </v-menu>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-autocomplete v-model="institution.city" outlined :rules="required" :items="cityOptions" item-text="value" item-value="value" :label="$t('addressCity')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-autocomplete v-model="institution.district" outlined :rules="required" :items="districtOptions" item-text="value" item-value="value" :label="$t('addressDistrict')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field v-model="institution.restofadress" outlined :rules="required" :label="$t('addressComplete')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.postal_box" outlined :rules="required" :label="$t('postal_box')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.postal_code" outlined :rules="required" :label="$t('postal_code')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.phone" outlined :rules="numbersRules" autocomplete="phone" :label="$t('phone')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.fax" outlined :rules="required" autocomplete="fax" :label="$t('fax')" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="3">
                                <v-text-field v-model="institution.capital" outlined :rules="required" autocomplete="capital" :label="$t('capital')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-textarea v-model="institution.business_activity" outlined :rules="required" autocomplete="business_activity" :label="$t('business_activity')" required />
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field v-model="ManagerTemp.name" outlined :rules="required" autocomplete="managerName" :label="$t('ManagerTempName')" required />
                                <v-btn @click="AddManagerToList()" dark color="success">
                                    {{$t('addManager')}}
                                </v-btn>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-list v-if="institution.managers.length" two-line>
                                    <v-alert type="primary" outlined>
                                        <v-subheader inset>{{$t('managers')}}</v-subheader>

                                        <v-list-item v-for="(manager,index) in institution.managers" :key="manager">
                                            <v-list-item-avatar>
                                                <v-icon class="grey lighten-1" dark>
                                                    mdi-account
                                                </v-icon>
                                            </v-list-item-avatar>

                                            <v-list-item-content>
                                                <v-list-item-title v-text="manager"></v-list-item-title>
                                            </v-list-item-content>

                                            <v-list-item-action>
                                                <v-btn @click="RemoveManagerFromList(index)" icon>
                                                    <v-icon color="grey lighten-1">mdi-delete</v-icon>
                                                </v-btn>
                                            </v-list-item-action>
                                        </v-list-item>

                                    </v-alert>
                                </v-list>
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <v-text-field v-model="institution.manager_authorities" outlined :rules="required" autocomplete="manager_authorities" :label="$t('manager_authorities')" required />
                            </v-col>
                        </div>
                        <v-col cols="12" sm="6" md="2">
                            <v-menu v-model="menu6" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="MainTradeRegister.EndDate" name="national_id_date" :label="$t('mainTradeEndDate')" prepend-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="MainTradeRegister.EndDate" @input="menu6 = false"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="2">
                            <v-text-field v-model="institution.number300" outlined autocomplete="number 300" :label="$t('number300')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field v-model="institution.extra_tax_num" outlined :rules="numbersRules" :label="$t('extraTaxesNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="3">
                            <v-text-field @change="SetFinancialDates()" v-model="transaction.financial_year" outlined :rules="numbersRules" :label="$t('finaincialYear')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="2">
                            <v-autocomplete @change="SetFinancialDates()" v-model="transaction.financial_period" outlined :rules="required" :items="[$t('finaincialYear2'), $t('shortPeriod'), $t('longPeriod')]" item-text="value" item-value="value" :label="$t('finaincialPeriod')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="transaction.start_financial_year" :label="$t('finaincialYearStart')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="transaction.start_financial_year"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="transaction.end_financial_year" :label="$t('finaincialYearEnd')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="transaction.end_financial_year"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-card>
                                <v-alert type="primary" outlined>
                                    <v-card-title>
                                        {{$t('branchTrade')}}
                                    </v-card-title>
                                    <v-form id="BranchRegisterForm" @submit.prevent="AddRegisterToList()">
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field v-model="BranchedTradeRegister.number" outlined :rules="numbersRules" :label="$t('tradeNumber')" required />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-text-field v-model="BranchedTradeRegister.production_place" outlined :rules="required" :label="$t('tradePlace')" required />
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                                <template v-slot:activator="{ on, attrs2 }">
                                                    <v-text-field outlined v-model="BranchedTradeRegister.date" :label="$t('tradeDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                                </template>
                                                <v-date-picker v-model="BranchedTradeRegister.date"></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="3">
                                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                                <template v-slot:activator="{ on, attrs2 }">
                                                    <v-text-field outlined v-model="BranchedTradeRegister.EndDate" :label="$t('tradeEndDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                                </template>
                                                <v-date-picker v-model="BranchedTradeRegister.EndDate"></v-date-picker>
                                            </v-menu>
                                        </v-col>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn outlined type="submit" form="BranchRegisterForm" color="primary" dark>
                                                {{$t('save')}}
                                            </v-btn>
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                    </v-form>
                                </v-alert>
                            </v-card>
                        </v-col>
                        <v-col cols="12" v-if="AddedBranchedRegisters.length">
                            <v-alert type="primary" outlined>

                                <v-data-table :headers="headers" :items="AddedBranchedRegisters">
                                    <template v-slot:item.action="{ item }">
                                        <v-icon small @click="removeRegisterFromList(item)">
                                            mdi-delete
                                        </v-icon>
                                    </template>
                                </v-data-table>
                            </v-alert>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete v-model="ChoosenReviserID" outlined :rules="required" :items="revisers" item-text="name" item-value="code" :label="$t('reviser')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-autocomplete v-model="ChoosenRevisingManagerID" outlined :rules="required" :items="revisingManagers" item-text="name" item-value="code" :label="$t('revisingManager')" required />
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
    name: "NewCompanyForm.vue",
    data() {
        return {
            revisers: [],
            revisingManagers: [],
            InstitutionType: '',
            InstitutionTypes: [{
                    text: this.$t('organization'),
                    value: 'organization'
                },
                {
                    text: this.$t('company'),
                    value: 'company'
                },
                {
                    text: this.$t('project'),
                    value: 'project'
                },
                {
                    text: this.$t('other'),
                    value: 'other'
                },

            ],
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

            ChoosenReviserID: '',
            ChoosenRevisingManagerID: '',
            //////// Create-Institution DATA  //////
            institution: {
                name: '',
                company_number: '',
                //العوان يتكون من التالي
                city: '',
                district: '',
                restofadress: '',
                //باقى بيانات الشركة
                legal_entity: '',
                date_type: '',
                angel_interests: '',
                nature: '',
                business_activity: '',
                charity_num: '',
                extra_tax_num: '',
                number700: '',
                postal_box: '',
                postal_code: '',
                fax: '',
                number300: '',
                capital: '',
                managers: [],
                phone: '',
                merchant_name: '',
                merchant_birth_date: '',
                merchant_nationality: '',
                manager_authorities: '',
                company_nationality: '',
                company_period: '',
                company_start_period: '',
                company_end_period: '',

            },
            ManagerTemp: {
                'name': '',
            },
            legal_entityOptions: [],
            angel_interestsOptions: [],
            natureOptions: [],
            cityOptions: [],
            districtOptions: [],

            created_institution: Object,
            NewCompanyNot_ADDED: true,
            ///////// Create TradeRegister Data /////////
            MainTradeRegister: {
                number: this.$parent.$parent.$parent.TradeRegisterInput,
                date: '',
                EndDate: '',
                production_place: '',
                type: 'رئيسي',
            },
            BranchedTradeRegister: {
                number: '',
                date: '',
                EndDate: '',
                production_place: '',
                type: 'فرعي',
            },
            AddedBranchedRegisters: [],
            NewMainRegisterNot_ADDED: true,
            AllBranchedRegistersNot_Added: true,
            /////  create Transaction Data ///////////
            transaction: {

                financial_year: '',
                start_financial_year: '',
                end_financial_year: '',
                financial_period: '',

            },

            NewTransactionNot_ADDED: true,

            LoadingSpinner: false,
            valid: false,
            ValidationErrors: '',
            MainRegisterError: false,
            CompanyError: false,
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
        this.GetRevisingManagers(route('employee.type', 'مدير مراجعة'));
        this.GetDropDowns(route('system.DropDowns.retrieve.option'));
    },
    methods: {
        // get all the revisers in the system and put them in the array
        GetRevisers(endpoint) {
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    data.employees.forEach((reviser) => {
                        this.revisers.push(reviser);
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
                        this.revisingManagers.push(revisingManager);
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
        createInstitution() {
            if (this.NewCompanyNot_ADDED) {
                this.LoadingSpinner = true;

                var formData = new FormData();
                formData.append('name', this.institution.name);
                formData.append('type', this.InstitutionType);
                formData.append('address', this.getAddress);
                formData.append('postal_box', this.institution.postal_box);
                formData.append('postal_code', this.institution.postal_code);
                formData.append('phone', this.institution.phone);
                formData.append('fax', this.institution.fax);
                formData.append('business_activity', this.institution.business_activity);
                formData.append('capital', this.institution.capital);
                formData.append('manager_authorities', this.institution.manager_authorities);
                formData.append('extra_tax_num', this.institution.extra_tax_num);
                formData.append('number300', this.institution.number300);

                if (this.InstitutionType == 'organization') {
                    formData.append('number700', this.institution.number700);
                    formData.append('merchant_name', this.institution.merchant_name);
                    formData.append('merchant_nationality', this.institution.merchant_nationality);
                    formData.append('merchant_birth_date', this.institution.merchant_birth_date);
                    //manager
                    this.institution.managers = [];
                    let name = this.ManagerTemp.name;
                    this.institution.managers.push({
                        name
                    });
                    formData.append('managers', JSON.stringify(this.institution.managers));

                } else if (this.InstitutionType == 'company') {
                    formData.append('legal_entity', this.institution.legal_entity);
                    formData.append('company_nationality', this.institution.company_nationality);
                    formData.append('company_period', this.institution.company_period);
                    formData.append('company_start_period', this.institution.company_start_period);
                    formData.append('company_end_period', this.institution.company_end_period);
                    //managers needed to be implemented
                    formData.append('managers', JSON.stringify(this.institution.managers));

                }
                axios.post(route('Institution.store'),
                    formData
                ).then((res) => {

                    this.created_institution = res.data;

                    this.$parent.$parent.$parent.Institution = res.data;

                    this.ValidationErrors = '';

                    this.NewCompanyNot_ADDED = false;

                    this.CompanyError = false;

                    this.LoadingSpinner = false;

                    this.createMainTradeRegister();
                }).catch((error) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });
                    this.CompanyError = true;
                });
            } else if (!this.NewCompanyNot_ADDED) {
                this.LoadingSpinner = false;

                this.createMainTradeRegister();
            }

        },

        createMainTradeRegister() {
            if (this.NewMainRegisterNot_ADDED) {
                this.LoadingSpinner = true;

                var formData = new FormData();

                formData.append('number', this.MainTradeRegister.number);
                formData.append('date', this.MainTradeRegister.date);
                formData.append('EndDate', this.MainTradeRegister.EndDate);
                formData.append('production_place', this.MainTradeRegister.production_place);
                formData.append('type', this.MainTradeRegister.type);
                console.log('inst', this.$parent.$parent.$parent.Institution);
                axios.post(route('TradeRegister.store', this.$parent.$parent.$parent.Institution), formData)
                    .then((res) => {

                        this.NewMainRegisterNot_ADDED = false;
                        this.ValidationErrors = '';
                        this.MainRegisterError = false;
                        this.LoadingSpinner = false;

                        this.createTransaction();
                    }).catch((error) => {
                        this.LoadingSpinner = false;

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                            timout: 2000
                        });
                        this.MainRegisterError = true;

                    });
            } else if (!this.NewMainRegisterNot_ADDED) {
                this.LoadingSpinner = false;

                this.createTransaction();
            }

        },

        createTransaction() {

            if (this.NewTransactionNot_ADDED) {

                this.LoadingSpinner = true;

                var formData = new FormData();

                formData.append('financial_year', this.transaction.financial_year);
                formData.append('status', 'under_review');
                formData.append('start_financial_year', this.transaction.start_financial_year);
                formData.append('end_financial_year', this.transaction.end_financial_year);

                formData.append('financial_period', this.transaction.financial_period);

                formData.append('MainTradeRegisterNumber', this.MainTradeRegister.number);

                formData.append('revisingManager_id', this.ChoosenRevisingManagerID);

                axios.post(route('Transactions.store', [this.created_institution.id, this.ChoosenReviserID]), formData)
                    .then(({
                        data
                    }) => {

                        this.NewTransactionNot_ADDED = false;
                        this.$parent.$parent.$parent.Transaction = data[0];
                        this.ValidationErrors = '';
                        this.LoadingSpinner = false;

                        this.createBranchedRegisters();
                    }).catch((error) => {
                        this.LoadingSpinner = false;

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                            timout: 2000
                        });

                    });
            } else if (!this.NewTransactionNot_ADDED) {
                this.createBranchedRegisters();

            }

        },

        createBranchedRegisters() {

            if (this.AddedBranchedRegisters.length == 0) {
                this.LoadingSpinner = false;

                this.AllBranchedRegistersNot_Added = false;
                this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                    'قد تم تسجيل البيانات بنجاح ', {
                        timout: 2000
                    });
                this.$parent.$parent.$parent.SectionStage = 2;
            } else {
                this.AddedBranchedRegisters.forEach((register, index) => {
                    this.LoadingSpinner = true;

                    var formData = new FormData();

                    formData.append('number', register.number);
                    formData.append('date', register.date);
                    formData.append('EndDate', register.EndDate);
                    formData.append('production_place', register.production_place);
                    formData.append('type', register.type);

                    axios.post(route('TradeRegister.store', this.$parent.$parent.$parent.Institution), formData)
                        .then((res) => {

                            this.ValidationErrors = '';

                            this.AddedBranchedRegisters.splice(this.AddedBranchedRegisters.indexOf(register), 1);
                            console.log('size' + this.AddedBranchedRegisters.length);
                            if (this.AddedBranchedRegisters.length == 0) {
                                this.LoadingSpinner = false;

                                this.AllBranchedRegistersNot_Added = false;
                                this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                                    'قد تم تسجيل البيانات بنجاح ', {
                                        timout: 2000
                                    });
                                this.$parent.$parent.$parent.SectionStage = 2;
                            }
                        }).catch((error) => {
                            this.LoadingSpinner = false;

                            this.ValidationErrors = error.response.data.errors;
                            this.$toast.error('خطأ', register.number + 'يرجى اعادة مراجعة بيانات سجل فرعي رقم ', {
                                timout: 2000
                            });

                        });
                });
            }

        },
        AddRegisterToList() {

            this.AddedBranchedRegisters.push({
                number: this.BranchedTradeRegister.number,
                date: this.BranchedTradeRegister.date,
                EndDate: this.BranchedTradeRegister.EndDate,
                production_place: this.BranchedTradeRegister.production_place,
                type: this.BranchedTradeRegister.type,
            });
            this.ClearBranchedRegisterInput();
        },
        removeRegisterFromList(reg) {
            this.AddedBranchedRegisters.splice(this.AddedBranchedRegisters.indexOf(reg), 1);

        },
        ClearBranchedRegisterInput() {
            this.BranchedTradeRegister.number = '',
                this.BranchedTradeRegister.date = '',
                this.BranchedTradeRegister.EndDate = '',
                this.BranchedTradeRegister.production_place = ''
        },
        SetFinancialDates() {
            if (this.transaction.financial_period == 'سنة مالية') {
                this.transaction.start_financial_year = this.transaction.financial_year + "-01-01";
                this.transaction.end_financial_year = this.transaction.financial_year + "-12-31";
            }
        },
        AddManagerToList() {
            let name = this.ManagerTemp.name;
            this.institution.managers.push(name);
            this.ManagerTemp.name = '';
        },
        RemoveManagerFromList(index) {
            this.institution.managers.splice(index, 1);
        }
    },

    computed: {

        getAddress() {
            return this.institution.city + ' , ' + this.institution.district + ',' + this.institution.restofadress;
        },

    },

}
</script>

<style scoped>

</style>
