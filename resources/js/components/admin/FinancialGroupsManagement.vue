<template>
    <div class="container box" >
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="box-header">
            <h2 class="pb-3">مجموعات القوائم المالية</h2>
        </div>
        <div class="box-body">
            <div v-for="(FinancialGroup,index) in FinancialGroupsArray" class="row">

                <div   data-toggle="collapse" :href="'#'+FinancialGroup.id"  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-10 cursor-pointer" style="border: 2px #00a65a dashed;justify-content: space-between;display: flex;">
                    <h3><i class=" fa fa-angle-double-left"></i> {{FinancialGroup.name}}</h3>
                    <div style="justify-content: space-between;display: flex;">
                        <h3><i @click="ShowEditFinancialGroupModal(FinancialGroup)" class=" fa fa-edit" style="margin-left:15px;cursor:pointer" ></i></h3>
                        <h3><i @click="destroy(FinancialGroup.id,index)" class="fa fa-trash-o" style="cursor:pointer"></i></h3>
                    </div>
                </div>

                <div :id="FinancialGroup.id" class="list-group collapse fade " >

                    <div v-for="(account,AccountIndex) in FinancialGroup.accounts" class="mt-20 col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 cursor-pointer" style="border: 2px #00a65a dashed;justify-content: space-between;display: flex;">
                        <h3><i class=" fa fa-angle-double-left"></i> {{account.name}}</h3>
                        <div style="justify-content: space-between;display: flex;">
                            <h3><i @click="UnLinkAccount(account,FinancialGroup,AccountIndex)" class="fa fa-trash-o" style="cursor:pointer"></i></h3>
                        </div>
                    </div>
                    <div  @click="ShowAddAccountToFinancialGroupModal(FinancialGroup)" class="ol-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 cursor-pointer text-center mt-20" style="border: 4px #00a65a dashed;">
                        <h4>
                            أضافة إلي {{FinancialGroup.name}}
                            <i class="fa fa-plus" style="margin-right:5px"></i>
                        </h4>
                    </div>
                </div>



            </div>
            <div>
                <div  @click="ShowAddFinancialGroupModal()" class="col-md-12 text-center mt-20 cursor-pointer" style="border: 4px #00a65a dashed;">
                    <h4>
                        أضافة مجموعة جديدة
                        <i class="fa fa-plus" style="margin-right:5px"></i>
                    </h4>
                </div>
            </div>
        </div>
        <!------------ Add Financial Group Hidden Modal  ---------->
        <h4 type="button" ref="AddModalButton" data-toggle="modal" data-target="#AddFinancialGroupModal" style="display: none">
            أضافة مجموعة جديدة
        </h4>
        <div class="modal  fade" id="AddFinancialGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">            أضافة مجموعة جديدة
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form @submit.prevent="AddNewFinancialGroup()">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>أسم المجموعة</label>
                                        <input v-model="NewFinancialGroup.name" class="form-control" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ref="CloseAddFinancialGroupModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ /. Add Financial Group Hidden Modal  ---------->


        <!------------ Add FinancialGroupAccount Hidden Modal  ---------->
        <h4 type="button" ref="AddFinancialGroupAccountButton" data-toggle="modal" data-target="#FinancialGroupAccount" style="display: none">
            أضافة إلي  مجموعة
        </h4>
        <div class="modal  fade" id="FinancialGroupAccount" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">

                            أضافة إلي
                            {{ParentFinancialGroup.name}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form @submit.prevent="LinkNewAccountToFinancialGroups()">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>أسم الحساب</label>
                                        <v-select :options="AccountVSelect" v-model="ChosenAccount"  style="width: 100%" >
                                        </v-select>

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ref="CloseAddFinancialGroupAccountsModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ /. Add FinancialGroupAccount Hidden Modal  ---------->

        <!------------ Edit Financial Group Hidden Modal  ---------->
        <h4 type="button" ref="EditModalButton" data-toggle="modal" data-target="#EditFinancialGroupModal" style="display: none">
            تعديل مجموعة جديدة
        </h4>
        <div class="modal  fade" id="EditFinancialGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">            تعديل مجموعة جديدة
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

                                <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ref="CloseAddFinancialGroupModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ /. Edit Financial Group Hidden Modal  ---------->
    </div>
</template>

<script>
    export default {
        name: "FinancialGroupsManagement",

        props:{
            'FinancialGroups':Array,
            'FirstLvlAccounts':Array,
        },

        data() {
            return {
                FinancialGroupsArray : this.FinancialGroups,
                LoadingSpinner: false,
                NewFinancialGroup:{'id':'','name':''},
                TempFinancialGroup:{'id':'','name':''},
                EditedFinancialGroup:{'id':'','name':''},

                // Linking New Account To FinancialGroup
                AccountVSelect:[],
                ParentFinancialGroup : {'id':'','name':''},
                ChosenAccount:null,
            }
        },
        created () {
            this.PrepareAccountVSelect();
        },
        methods : {

            PrepareAccountVSelect(){
                this.LoadingSpinner = true;
                this.FirstLvlAccounts.forEach( item =>{

                    this.AccountVSelect.push({'id':item.id,'label': (item.code_alias ? item.code_alias : item.code) + ' - '+  (item.name_alias ? item.name_alias : item.name) , 'code':(item.code_alias ? item.code_alias : item.code) });

                })
                this.LoadingSpinner = false;
            },

            ShowAddFinancialGroupModal(){

                this.NewFinancialGroup.id = '';
                this.NewFinancialGroup.name = '';
                this.$refs.AddModalButton.click();

            },
            AddNewFinancialGroup(){
                this.LoadingSpinner = true;
                let formData = new FormData();

                formData.append('name',this.NewFinancialGroup.name);


                axios.post(route('FinancialGroups.store.admin'),formData)
                    .then(({data})=>{
                        console.log(data.NewFinancialGroup.name);
                        this.FinancialGroupsArray.push({'id':data.NewFinancialGroup.id,'name':data.NewFinancialGroup.name});
                        this.$toast.success('.','تم أضافة مجموعة جديدة بنجاح',{timout:2000});
                        this.LoadingSpinner = false;

                    }).catch((error)=>{
                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                    this.LoadingSpinner = false;

                })
                this.$refs.CloseAddFinancialGroupModal.click();

            },
            ShowEditFinancialGroupModal(FinancialGroup){
                this.TempFinancialGroup.id = FinancialGroup.id;
                this.TempFinancialGroup.name = FinancialGroup.name;
                this.EditedFinancialGroup = FinancialGroup;
                this.$refs.EditModalButton.click();

            },
            UpdateFinancialGroup(){
                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('name',this.TempFinancialGroup.name);

                axios.post(route('FinancialGroups.update.admin',this.TempFinancialGroup.id),formData)
                    .then((res)=>{
                        this.EditedFinancialGroup.name = this.TempFinancialGroup.name;

                        this.$toast.success('.','تم تعديل مجموعة بنجاح',{timout:2000});
                    }).catch((error)=>{
                    this.$toast.error('خطأ','خطأ اثناء التعديل',{timout:2000});
                })
                this.$refs.CloseAddFinancialGroupModal.click();
            },
            destroy(id,index){
                this.$toast.question('.','تأكيد حذف الحساب',{
                    timeout: 40000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                            axios.delete(route('FinancialGroups.destroy.admin',id))
                                .then((res)=>{
                                    this.FinancialGroupsArray.splice(index, 1);
                                    this.$toast.success('.','قد تم حذف مجموعة بنجاح',{timout:2000});
                                }).catch((error)=>{
                                this.$toast.error('خطأ','خطأ اثناء الحذف',{timout:2000});
                            })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });
            },
            ShowAddAccountToFinancialGroupModal(FinancialGroup){
                this.ParentFinancialGroup = FinancialGroup;
                this.$refs.AddFinancialGroupAccountButton.click();
            },
            LinkNewAccountToFinancialGroups(){
                this.LoadingSpinner = true;

                let formData = new FormData();
                formData.append('account_id',this.ChosenAccount.id);

                axios.post(route('FinancialGroupsAccounts.store.admin',this.ParentFinancialGroup.id),formData)
                    .then(({data})=>{
                        this.ParentFinancialGroup.accounts.push({'id':this.ChosenAccount.id,'name':this.ChosenAccount.label});
                        this.$toast.success('.','تم الأضافة الي المجموعة بنجاح',{timout:2000});
                        this.LoadingSpinner = false;

                    }).catch((error)=>{
                        console.log(error);
                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                    this.LoadingSpinner = false;

                })
                this.$refs.CloseAddFinancialGroupAccountsModal.click();
            },
            UnLinkAccount(Account,ParentFinancialGroup,index){

                this.$toast.question('.','تأكيد حذف الحساب من المجموعة',{
                    timeout: 40000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                            axios.delete(route('FinancialGroupsAccounts.destroy.admin',Account.id))
                                .then((res)=>{
                                    ParentFinancialGroup.accounts.splice(index, 1);
                                    this.$toast.success('.','قد تم حذف الحساب من المجموعة بنجاح',{timout:2000});
                                }).catch((error)=>{
                                this.$toast.error('خطأ','خطأ اثناء الحذف',{timout:2000});
                            })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });

            }
        }
    }
</script>

<style scoped>

</style>
