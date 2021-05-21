<template>
<div>
    <div v-if="LoadingSpinner" class="overlay">
        <i class="fa fa-refresh fa-spin">
        </i>
    </div>
    <v-card-title>
        {{$t('finanicialGroupsList')}}
    </v-card-title>
    <v-expansion-panels>
        <v-expansion-panel v-for="(FinancialGroup,index) in FinancialGroupsArray" :key="FinancialGroup.id">
            <v-expansion-panel-header hide-actions>
                {{FinancialGroup.name}}
            </v-expansion-panel-header>
            <v-btn icon outlined absolute @click="ShowEditFinancialGroupModal(FinancialGroup)" class="floatLeftAction2" fab dark x-small color="primary">
                <v-icon dark>
                    mdi-pencil
                </v-icon>
            </v-btn>
            <v-btn icon outlined absolute class="floatLeftAction" @click="destroy(FinancialGroup.id,index)" fab dark x-small color="error">
                <v-icon dark>
                    mdi-delete
                </v-icon>
            </v-btn>
            <v-expansion-panel-content>
                <!-- inside pannel  -->
                <v-expansion-panels readonly>
                    <v-expansion-panel v-for="(account,AccountIndex) in FinancialGroup.accounts" :key="account.id">
                        <v-expansion-panel-header hide-actions>
                            {{account.name}}
                        </v-expansion-panel-header>
                        <v-btn icon outlined absolute class="floatLeftAction" @click="UnLinkAccount(account,FinancialGroup,AccountIndex)" fab dark x-small color="error">
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
                    <v-btn color="primary" class="mt-4" @click="ShowAddAccountToFinancialGroupModal(FinancialGroup)" dark>
                        <v-icon>mdi-plus</v-icon> {{$t('addTo')}} {{FinancialGroup.name}}
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>
    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" class="mt-4" @click="ShowAddFinancialGroupModal()" dark>
            <v-icon>mdi-plus</v-icon> {{$t('addNewGroup')}}
        </v-btn>
        <v-spacer></v-spacer>
    </v-card-actions>
    <!------------ Add Financial Group Hidden Modal  ---------->
    <v-dialog v-model="newGroupDialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('addNewGroup')}}
                </v-card-title>
                <v-form @submit.prevent="AddNewFinancialGroup()">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="NewFinancialGroup.name" outlined :label="$t('groupName')"></v-text-field>
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
    <!------------ /. Add Financial Group Hidden Modal  ---------->

    <!------------ Add FinancialGroupAccount Hidden Modal  ---------->
    <v-dialog v-model="newGroupToDialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('addTo')}} {{ParentFinancialGroup.name}}
                </v-card-title>
                <v-form @submit.prevent="LinkNewAccountToFinancialGroups()">
                    <v-row>
                        <v-col cols="12">
                            <v-autocomplete v-model="ChosenAccount" :items="AccountVSelect" item-text="label" item-value="code" outlined :label="$t('accountName')"></v-autocomplete>
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
    <!------------ /. Add FinancialGroupAccount Hidden Modal  ---------->

    <!------------ Edit Financial Group Hidden Modal  ---------->
    <h4 type="button" ref="EditModalButton" data-toggle="modal" data-target="#EditFinancialGroupModal" style="display: none">
        تعديل مجموعة جديدة
    </h4>
    <div class="modal  fade" id="EditFinancialGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> تعديل مجموعة جديدة
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form @submit.prevent="UpdateFinancialGroup()">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>أسم المجموعة</label>
                                    <input v-model="TempFinancialGroup.name" class="form-control" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px">حفظ</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button ref="CloseAddFinancialGroupModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                </div>
            </div>
        </div>
    </div>
    <v-dialog v-model="editGroupDialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('editGroup')}}
                </v-card-title>
                <v-form @submit.prevent="UpdateFinancialGroup()">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="TempFinancialGroup.name" outlined :label="$t('groupName')"></v-text-field>
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
    <!------------ /. Edit Financial Group Hidden Modal  ---------->
</div>
</template>

<script>
export default {
    name: "FinancialGroupsManagement",

    props: {
        'FinancialGroups': Array,
        'FirstLvlAccounts': Array,
    },

    data() {
        return {
            FinancialGroupsArray: this.FinancialGroups,
            LoadingSpinner: false,
            newGroupDialog: false,
            newGroupToDialog: false,
            editGroupDialog: false,
            NewFinancialGroup: {
                'id': '',
                'name': ''
            },
            TempFinancialGroup: {
                'id': '',
                'name': ''
            },
            EditedFinancialGroup: {
                'id': '',
                'name': ''
            },

            // Linking New Account To FinancialGroup
            AccountVSelect: [],
            ParentFinancialGroup: {
                'id': '',
                'name': ''
            },
            ChosenAccount: null,
        }
    },
    created() {
        this.PrepareAccountVSelect();
    },
    methods: {

        PrepareAccountVSelect() {
            this.LoadingSpinner = true;
            this.FirstLvlAccounts.forEach(item => {

                this.AccountVSelect.push({
                    'id': item.id,
                    'label': (item.code_alias ? item.code_alias : item.code) + ' - ' + (item.name_alias ? item.name_alias : item.name),
                    'code': (item.code_alias ? item.code_alias : item.code)
                });

            })
            this.LoadingSpinner = false;
        },

        ShowAddFinancialGroupModal() {

            this.NewFinancialGroup.id = '';
            this.NewFinancialGroup.name = '';
            this.newGroupDialog = true;

        },
        AddNewFinancialGroup() {
            this.LoadingSpinner = true;
            let formData = new FormData();

            formData.append('name', this.NewFinancialGroup.name);

            axios.post(route('FinancialGroups.store.admin'), formData)
                .then(({
                    data
                }) => {
                    console.log(data.NewFinancialGroup.name);
                    this.FinancialGroupsArray.push({
                        'id': data.NewFinancialGroup.id,
                        'name': data.NewFinancialGroup.name
                    });
                    this.$toast.success('.', 'تم أضافة مجموعة جديدة بنجاح', {
                        timout: 2000
                    });
                    this.LoadingSpinner = false;

                }).catch((error) => {
                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });
                    this.LoadingSpinner = false;

                })
            this.$refs.CloseAddFinancialGroupModal.click();

        },
        ShowEditFinancialGroupModal(FinancialGroup) {
            this.TempFinancialGroup.id = FinancialGroup.id;
            this.TempFinancialGroup.name = FinancialGroup.name;
            this.EditedFinancialGroup = FinancialGroup;
            this.editGroupDialog = true;

        },
        UpdateFinancialGroup() {
            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('name', this.TempFinancialGroup.name);

            axios.post(route('FinancialGroups.update.admin', this.TempFinancialGroup.id), formData)
                .then((res) => {
                    this.EditedFinancialGroup.name = this.TempFinancialGroup.name;

                    this.$toast.success('.', 'تم تعديل مجموعة بنجاح', {
                        timout: 2000
                    });
                }).catch((error) => {
                    this.$toast.error('خطأ', 'خطأ اثناء التعديل', {
                        timout: 2000
                    });
                })
            this.$refs.CloseAddFinancialGroupModal.click();
        },
        destroy(id, index) {
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

                        axios.delete(route('FinancialGroups.destroy.admin', id))
                            .then((res) => {
                                this.FinancialGroupsArray.splice(index, 1);
                                this.$toast.success('.', 'قد تم حذف مجموعة بنجاح', {
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
        ShowAddAccountToFinancialGroupModal(FinancialGroup) {
            this.ParentFinancialGroup = FinancialGroup;
            this.newGroupToDialog = true;
        },
        LinkNewAccountToFinancialGroups() {
            this.LoadingSpinner = true;

            let formData = new FormData();
            formData.append('account_id', this.ChosenAccount.id);

            axios.post(route('FinancialGroupsAccounts.store.admin', this.ParentFinancialGroup.id), formData)
                .then(({
                    data
                }) => {
                    this.ParentFinancialGroup.accounts.push({
                        'id': this.ChosenAccount.id,
                        'name': this.ChosenAccount.label
                    });
                    this.$toast.success('.', 'تم الأضافة الي المجموعة بنجاح', {
                        timout: 2000
                    });
                    this.LoadingSpinner = false;

                }).catch((error) => {
                    console.log(error);
                    this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                        timout: 2000
                    });
                    this.LoadingSpinner = false;

                })
            this.$refs.CloseAddFinancialGroupAccountsModal.click();
        },
        UnLinkAccount(Account, ParentFinancialGroup, index) {

            this.$toast.question('.', 'تأكيد حذف الحساب من المجموعة', {
                timeout: 40000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                position: 'center',
                buttons: [
                    ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                        axios.delete(route('FinancialGroupsAccounts.destroy.admin', Account.id))
                            .then((res) => {
                                ParentFinancialGroup.accounts.splice(index, 1);
                                this.$toast.success('.', 'قد تم حذف الحساب من المجموعة بنجاح', {
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
