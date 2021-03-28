<template>
<div>
    <v-card-title>
        {{$t('dropdowns')}}
    </v-card-title>
    <!-- First Level -->
    <v-expansion-panels focusable>
        <v-expansion-panel v-for="(FirstLVLAccount,first_level_index) in LVL1_AccountCharts" :key="FirstLVLAccount.code">
            <v-expansion-panel-header hide-actions>
                {{FirstLVLAccount.code}} - {{FirstLVLAccount.name}}
            </v-expansion-panel-header>
            <v-btn absolute @click="ShowEditAccountChartModal(FirstLVLAccount, 1)" class="floatLeftAction2" fab dark x-small color="primary">
                <v-icon dark>
                    mdi-pencil
                </v-icon>
            </v-btn>
            <v-btn absolute class="floatLeftAction" @click="destroy(LVL1_AccountCharts,first_level_index,FirstLVLAccount.id,1)" fab dark x-small color="error">
                <v-icon dark>
                    mdi-delete
                </v-icon>
            </v-btn>
            <v-expansion-panel-content>
                <!-- Second Level  -->
                <v-expansion-panels focusable>
                    <v-expansion-panel v-for="(SecondLVLAccount,second_index) in FirstLVLAccount.second_level_accounts" :key="SecondLVLAccount.code">
                        <v-expansion-panel-header hide-actions>
                            {{SecondLVLAccount.code}} - {{SecondLVLAccount.name}}
                        </v-expansion-panel-header>
                        <v-btn absolute @click="ShowEditAccountChartModal(SecondLVLAccount,2)" class="floatLeftAction2" fab dark x-small color="primary">
                            <v-icon dark>
                                mdi-pencil
                            </v-icon>
                        </v-btn>
                        <v-btn absolute class="floatLeftAction" @click="destroy(FirstLVLAccount.second_level_accounts,second_index,SecondLVLAccount.id,2)" fab dark x-small color="error">
                            <v-icon dark>
                                mdi-delete
                            </v-icon>
                        </v-btn>
                        <v-expansion-panel-content>
                            <!-- Third Level -->
                            <v-expansion-panels focusable>
                                <v-expansion-panel v-for="(ThirdLVLAccount,third_level_index) in SecondLVLAccount.third_level_accounts" :key="ThirdLVLAccount.code">
                                    <v-expansion-panel-header hide-actions>
                                        {{ThirdLVLAccount.code}} - {{ThirdLVLAccount.name}}
                                    </v-expansion-panel-header>
                                    <v-btn absolute @click="ShowEditAccountChartModal(ThirdLVLAccount,3)" class="floatLeftAction2" fab dark x-small color="primary">
                                        <v-icon dark>
                                            mdi-pencil
                                        </v-icon>
                                    </v-btn>
                                    <v-btn absolute class="floatLeftAction" @click="destroy(SecondLVLAccount.third_level_accounts,third_level_index,ThirdLVLAccount.id,3)" fab dark x-small color="error">
                                        <v-icon dark>
                                            mdi-delete
                                        </v-icon>
                                    </v-btn>
                                    <v-expansion-panel-content>
                                        <!-- Fourth Level -->
                                        <v-expansion-panels focusable>
                                            <v-expansion-panel v-for="(FourthLVLAccount,fourth_level_index) in ThirdLVLAccount.fourth_level_accounts" :key="FourthLVLAccount.code">
                                                <v-expansion-panel-header hide-actions>
                                                    {{FourthLVLAccount.code}} - {{FourthLVLAccount.name}}
                                                </v-expansion-panel-header>
                                                <v-btn absolute @click="ShowEditAccountChartModal(FourthLVLAccount,4)" class="floatLeftAction2" fab dark x-small color="primary">
                                                    <v-icon dark>
                                                        mdi-pencil
                                                    </v-icon>
                                                </v-btn>
                                                <v-btn absolute class="floatLeftAction" @click="destroy(ThirdLVLAccount.fourth_level_accounts,fourth_level_index,FourthLVLAccount.id,4)" fab dark x-small color="error">
                                                    <v-icon dark>
                                                        mdi-delete
                                                    </v-icon>
                                                </v-btn>
                                                <v-expansion-panel-content>

                                                </v-expansion-panel-content>
                                            </v-expansion-panel>
                                        </v-expansion-panels>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn color="primary" class="mt-4" @click="ShowAddAccountChartModal(FirstLVLAccount.second_level_accounts,0,0,FirstLVLAccount,2)" dark>
                                                <v-icon>mdi-plus</v-icon> {{$t('newAccountFourthBranch')}}
                                            </v-btn>
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                    </v-expansion-panel-content>
                                </v-expansion-panel>
                            </v-expansion-panels>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" class="mt-4" @click="ShowAddAccountChartModal(FirstLVLAccount.second_level_accounts,0,0,FirstLVLAccount,2)" dark>
                                    <v-icon>mdi-plus</v-icon> {{$t('newAccountThirdBranch')}}
                                </v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" class="mt-4" @click="ShowAddAccountChartModal(FirstLVLAccount.second_level_accounts,0,0,FirstLVLAccount,2)" dark>
                        <v-icon>mdi-plus</v-icon> {{$t('newAccountSecondBranch')}}
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>
    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" class="mt-4" @click="ShowAddAccountChartModal(LVL1_AccountCharts,0,0,null,1)" dark>
            <v-icon>mdi-plus</v-icon> {{$t('newAccount')}}
        </v-btn>
        <v-spacer></v-spacer>
    </v-card-actions>
    <v-dialog v-model="dialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('editAccount')}}
                </v-card-title>
                <v-form @submit.prevent="EditAccountChart()">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="temp_account.code" outlined disabled :label="$t('accountNumber')"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="temp_account.name" outlined :label="$t('accountName')"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <label>اجرائات المراجعة</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.procedures" id="CkEditor1"></vue-editor>
                        </v-col>
                        <v-col cols="12">
                            <label>السياسات</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.policies" id="CkEditor2"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>المعيار الدولي</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.international_measurement"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>التعريف المحاسبي</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.accounting_term"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>لفت الانتباه</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.considerations"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>الدراسة</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.study"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>الدراسة الثانية</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="temp_account.second_study"></vue-editor>

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
    </v-dialog>
    <v-dialog v-model="newAccountDialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('editAccount')}}
                </v-card-title>
                <v-form @submit.prevent="AddNewAccountChart()">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="Added_Account.code" outlined disabled :label="$t('accountNumber')"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="Added_Account.name" outlined :label="$t('accountName')"></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if=" Added_Account.level !=1">
                            <v-checkbox v-model="Added_Account.is_related_party" outlined :label="$t('isRelated')" />
                        </v-col>
                        <v-col cols="12">
                            <label>اجرائات المراجعة</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.procedures" id="CkEditor1"></vue-editor>
                        </v-col>
                        <v-col cols="12">
                            <label>المعيار الدولي</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.international_measurement"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>التعريف المحاسبي</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.accounting_term"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>لفت الانتباه</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.considerations"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>الدراسة</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.study"></vue-editor>

                        </v-col>
                        <v-col cols="12">
                            <label>الدراسة الثانية</label>
                            <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.second_study"></vue-editor>

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
    </v-dialog>
</div>
</template>

<script>
export default {
    name: "AccountsCharts.vue",

    props: {
        AccountCharts: Array,
    },
    created() {
        this.fetch(route('system.AccountCharts.index'));
    },
    data() {
        return {
            LVL1_AccountCharts: [],

            ValidationErrors: '',
            LoadingSpinner: false,
            dialog: false,
            newAccountDialog: false,
            NumberOfFixedPoints: '',
            ParentAccountArray: [],
            Added_Account: {
                'id': null,
                'code': null,
                'name': null,
                'procedures': '',
                'policies': '',
                'international_measurement': '',
                'accounting_term': '',
                'considerations': '',
                'study': '',
                'second_study': '',

                'oldest_parent_id': null,
                'top_parent_id': null,
                'parent_id': null,
                'level': null,

                'is_related_party': '',
            },
            Edit_Account: {
                'id': null,
                'code': null,
                'name': null,
                'level': null,
                'procedures': '',
                'policies': '',
                'international_measurement': '',
                'accounting_term': '',
                'considerations': '',
                'study': '',
                'second_study': '',
                'is_related_party': '',

            },
            temp_account: {
                'id': null,
                'code': null,
                'name': null,
                'level': null,
                'procedures': '',
                'policies': '',
                'international_measurement': '',
                'accounting_term': '',
                'considerations': '',
                'study': '',
                'second_study': '',

            },
            PaginationData: {
                'current_page': '',
                'last_page': '',
                'next_page_url': '',
                'prev_page_url': '',
            },
            customToolbar: [
                [{
                    header: [false, 1, 2, 3, 4, 5, 6]
                }],

                [{
                    size: ["small", false, "large", "huge"]
                }],

                ["bold", "italic", "underline", "strike"],
                [{
                        align: ""
                    },
                    {
                        align: "center"
                    },
                    {
                        align: "right"
                    },
                    {
                        align: "justify"
                    }
                ],

                ["blockquote", "code-block"],

                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }, {
                    list: "check"
                }],

                [{
                    color: []
                }, {
                    background: []
                }],

                ["link"],

                [{
                    direction: "rtl"
                }],
                ["clean"]
            ],

        }
    },
    methods: {
        fetch(endpoint) {
            this.LoadingSpinner = true;
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    this.LVL1_AccountCharts = [];
                    this.LVL1_AccountCharts.push(...data.AccountChartsWithChildren.data);
                    this.PaginationData.current_page = data.AccountChartsWithChildren.current_page;
                    this.PaginationData.last_page = data.AccountChartsWithChildren.last_page;
                    this.PaginationData.next_page_url = data.AccountChartsWithChildren.next_page_url;
                    this.PaginationData.prev_page_url = data.AccountChartsWithChildren.prev_page_url;
                    this.LoadingSpinner = false;

                })
        },
        ShowAddAccountChartModal(parentAccountArray, oldest_parent_id, top_parent_id, Parent, level) {
                this.newAccountDialog = true;

            if (oldest_parent_id != 0) {
                this.Added_Account.oldest_parent_id = oldest_parent_id;
            }
            if (top_parent_id != 0) {
                this.Added_Account.top_parent_id = top_parent_id;
            }
            if (Parent !== null) {
                this.Added_Account.parent_id = Parent.id;
                this.Added_Account.is_related_party = Parent.is_related_party;
            }

            this.Added_Account.level = level;
            this.ParentAccountArray = parentAccountArray;
            if (Parent == null && !this.ParentAccountArray.length) {
                this.Added_Account.code = 1;

            } else if (!this.ParentAccountArray.length) {
                this.Added_Account.code = Parent.code;
            } else {

                let LastItemCode = this.ParentAccountArray[this.ParentAccountArray.length - 1].code;
                LastItemCode = LastItemCode.toString();

                let NewItemLastChar = parseInt(LastItemCode[LastItemCode.length - 1]) + 1;

                let NewItemLastCode = LastItemCode.substring(0, LastItemCode.length - 1) + NewItemLastChar;

                this.Added_Account.code = NewItemLastCode;
            }
        },
        CloseDetermineFixedPointsModalOpenAddModal() {

            this.Added_Account.code = this.Added_Account.code + this.NumberOfFixedPoints + (this.ParentAccountArray.length + 1);

            this.$refs.CloseDetermineFixedPointsModal.click();
            this.$refs.AddModalButton.click();
        },
        ShowEditAccountChartModal(account, level) {
            this.dialog = true;
            this.Edit_Account = account;
            this.temp_account.id = account.id;
            this.temp_account.code = account.code;
            this.temp_account.name = account.name;
            this.temp_account.level = level;
            this.temp_account.procedures = account.procedures;
            this.temp_account.policies = account.policies;
            this.temp_account.international_measurement = account.international_measurement;
            this.temp_account.accounting_term = account.accounting_term;
            this.temp_account.considerations = account.considerations;
            this.temp_account.study = account.study;
            this.temp_account.second_study = account.second_study;
        },
        AddNewAccountChart() {

            let formData = new FormData();

            formData.append('code', this.Added_Account.code);
            formData.append('name', this.Added_Account.name);
            formData.append('level', this.Added_Account.level);
            formData.append('procedures', this.Added_Account.procedures);
            formData.append('policies', this.Added_Account.policies);
            formData.append('international_measurement', this.Added_Account.international_measurement);
            formData.append('accounting_term', this.Added_Account.accounting_term);
            formData.append('considerations', this.Added_Account.considerations);
            formData.append('study', this.Added_Account.study);
            formData.append('second_study', this.Added_Account.second_study);

            formData.append('is_related_party', this.Added_Account.is_related_party ? 1 : 0);

            if (this.Added_Account.oldest_parent_id) {
                formData.append('oldest_parent_id', this.Added_Account.oldest_parent_id);
            }
            if (this.Added_Account.top_parent_id) {
                formData.append('top_parent_id', this.Added_Account.top_parent_id);
            }
            if (this.Added_Account.parent_id) {
                formData.append('parent_id', this.Added_Account.parent_id);
            }

            axios.post(route('system.AccountCharts.store'), formData)
                .then(({
                    data
                }) => {
                    if (this.Added_Account.level == 1) {
                        this.ParentAccountArray.push({
                            'id': data.id,
                            'code': this.Added_Account.code,
                            'name': this.Added_Account.name,
                            'procedures': this.Added_Account.procedures,
                            'policies': this.Added_Account.policies,
                            'international_measurement': this.Added_Account.international_measurement,
                            'accounting_term': this.Added_Account.accounting_term,
                            'considerations': this.Added_Account.considerations,
                            'study': this.Added_Account.study,
                            'second_study': this.Added_Account.second_study,
                            'is_related_party': this.Added_Account.is_related_party,
                            'second_level_accounts': [],
                        });
                    } else if (this.Added_Account.level == 2) {
                        this.ParentAccountArray.push({
                            'id': data.id,
                            'code': this.Added_Account.code,
                            'name': this.Added_Account.name,
                            'procedures': this.Added_Account.procedures,
                            'policies': this.Added_Account.policies,
                            'international_measurement': this.Added_Account.international_measurement,
                            'accounting_term': this.Added_Account.accounting_term,
                            'considerations': this.Added_Account.considerations,
                            'study': this.Added_Account.study,
                            'second_study': this.Added_Account.second_study,
                            'is_related_party': this.Added_Account.is_related_party,
                            'parent_id': this.Added_Account.parent_id,
                            'third_level_accounts': [],
                        });
                    } else if (this.Added_Account.level == 3) {

                        this.ParentAccountArray.push({
                            'id': data.id,
                            'code': this.Added_Account.code,
                            'name': this.Added_Account.name,
                            'procedures': this.Added_Account.procedures,
                            'policies': this.Added_Account.policies,
                            'international_measurement': this.Added_Account.international_measurement,
                            'accounting_term': this.Added_Account.accounting_term,
                            'considerations': this.Added_Account.considerations,
                            'study': this.Added_Account.study,
                            'second_study': this.Added_Account.second_study,
                            'is_related_party': this.Added_Account.is_related_party,
                            'top_parent_id': this.Added_Account.top_parent_id,
                            'parent_id': this.Added_Account.parent_id,
                            'fourth_level_accounts': [],

                        });
                    } else if (this.Added_Account.level == 4) {
                        this.ParentAccountArray.push({
                            'id': data.id,
                            'code': this.Added_Account.code,
                            'name': this.Added_Account.name,
                            'procedures': this.Added_Account.procedures,
                            'policies': this.Added_Account.policies,
                            'international_measurement': this.Added_Account.international_measurement,
                            'accounting_term': this.Added_Account.accounting_term,
                            'considerations': this.Added_Account.considerations,
                            'study': this.Added_Account.study,
                            'second_study': this.Added_Account.second_study,
                            'is_related_party': this.Added_Account.is_related_party,
                            'oldest_parent_id': this.Added_Account.oldest_parent_id,
                            'top_parent_id': this.Added_Account.top_parent_id,
                            'parent_id': this.Added_Account.parent_id
                        });
                    };
                    this.$refs.CloseAddAccountModal.click();
                    this.ParentAccountArray = [];
                    this.Added_Account.id = null;
                    this.Added_Account.code = null;
                    this.Added_Account.name = null;
                    this.Added_Account.level = null;
                    this.Added_Account.procedures = null;
                    this.Added_Account.policies = null;
                    this.Added_Account.international_measurement = null;
                    this.Added_Account.accounting_term = null;
                    this.Added_Account.considerations = null;
                    this.Added_Account.study = null;
                    this.Added_Account.second_study = null;
                    this.Added_Account.is_related_party = null;
                    this.Added_Account.oldest_parent_id = 0;
                    this.Added_Account.top_parent_id = 0;
                    this.Added_Account.parent_id = 0;
                    this.$toast.success('.', 'تمت اضافة بيانات الحساب بنجاح', {
                        timout: 2000
                    });
                })
                .catch((error) => {
                    console.log(error);
                    this.$refs.CloseAddAccountModal.click();

                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });
                });

        },
        destroy(ParentArray, index, id, level) {
            this.$toast.question('.', 'تأكيد حذف الحساب', {
                timeout: 40000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                position: 'center',
                buttons: [
                    ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                        axios.delete(route('system.AccountCharts.delete', {
                                id,
                                level
                            }))
                            .then((res) => {
                                ParentArray.splice(index, 1);
                                this.$toast.success('.', 'قد تم حذف الحساب بنجاح', {
                                    timout: 2000
                                });
                            }).catch((error) => {
                                this.$toast.error('خطأ', 'خطأ اثناء الحذف', {
                                    timout: 2000
                                });
                            })
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                ],
            });
        },
        EditAccountChart() {
            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('level', this.temp_account.level);
            formData.append('id', this.temp_account.id);
            formData.append('code', this.temp_account.code);
            formData.append('name', this.temp_account.name);
            formData.append('policies', this.temp_account.policies);
            formData.append('procedures', this.temp_account.procedures);

            formData.append('international_measurement', this.temp_account.procedures);
            formData.append('accounting_term', this.temp_account.procedures);

            formData.append('considerations', this.temp_account.considerations);
            formData.append('study', this.temp_account.study);
            formData.append('second_study', this.temp_account.second_study);

            axios.post(route('system.AccountCharts.update'), formData)
                .then((res) => {
                    this.Edit_Account.id = this.temp_account.id;
                    this.Edit_Account.code = this.temp_account.code;
                    this.Edit_Account.name = this.temp_account.name;
                    this.Edit_Account.level = this.temp_account.level;
                    this.Edit_Account.procedures = this.temp_account.procedures;
                    this.Edit_Account.policies = this.temp_account.policies;
                    this.Edit_Account.international_measurement = this.temp_account.international_measurement;
                    this.Edit_Account.accounting_term = this.temp_account.accounting_term;
                    this.Edit_Account.considerations = this.temp_account.considerations;
                    this.Edit_Account.study = this.temp_account.study;
                    this.Edit_Account.second_study = this.temp_account.second_study;
                    this.$toast.success('.', 'تم تعديل الحساب بنجاح', {
                        timout: 2000
                    });
                }).catch((error) => {
                    this.$toast.error('خطأ', 'خطأ اثناء التعديل', {
                        timout: 2000
                    });
                })
            this.$refs.CloseEditAccountModal.click();

        }
    }
}
</script>

<style scoped>
.floatLeftAction {
    top: 5px;
    left: 10px;
}

.floatLeftAction2 {
    top: 5px;
    left: 50px;
}
</style>
