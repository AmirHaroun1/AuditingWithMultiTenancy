<template>
    <div class="container box" style="margin-top: 20px">
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="row">

            <div class="box-header">
                <h2>ميزان المراجعة</h2>
            </div>
            <div class="box-body">

                <div v-if="Stage == 1" id="UploadScale">
                    <form @submit.prevent="GetExcelHeaders()">
                        <div class="col-md-3">
                            <input ref="UploadedAccountsExcel" type="file" class="form-control" accept=".xls,.xlsx,.xlsb,.xltx,.xlsm" required>
                            <br>
                            <button  class="btn  btn-info btn-lg">رفع ميزان المراجعة <i class="fa fa-cloud-upload"></i></button>
                        </div>

                    </form>
                </div>
                <!--------- Choosing Columns ---------->
                <div v-else-if="Stage == 2" id="IntegrateScale">
                    <button @click="Stage=1" type="submit" class="btn btn-block btn-info btn-lg" style="padding: 15px;width:230px;float:left !important" >
                        <i class="fa  fa-angle-double-right"></i>
                        السابقة
                    </button>
                    <form @submit.prevent="GetAllAccounts()">
                        <div class="row">
                            <div class="col-md-3">
                                <h4> عمود أسم الحساب</h4>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" v-model="ChoosenColumns.AccNameColumn" required>
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="padding-top:20px">
                            <div class="col-md-3">
                                <h4> عمود رقم الحساب</h4>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" v-model="ChoosenColumns.AccNumberColumn" required>
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>
                        </div>
                        <!-------- Current Year-------------->
                        <div class="row" style="padding-top:20px">
                            <div class="col-md-3">
                                <h4>رصيد العام الحالي</h4>
                            </div>
                            <div class="col-md-3">
                                <label>النوع</label>

                                <select class="form-control" v-model="ChoosenColumns.CurrentYearType">
                                    <option value="1">1 عمود</option>
                                    <option value="2">2 عمود</option>
                                </select>
                            </div>
                            <div v-if="ChoosenColumns.CurrentYearType == 1" class="col-md-3">
                                <label>السنة</label>
                                <select class="form-control" v-model="ChoosenColumns.CurrentYearColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>
                            <div v-if="ChoosenColumns.CurrentYearType == 2" class="col-md-3">
                                <label>مدين</label>
                                <select class="form-control" v-model="ChoosenColumns.CurrentYearDebitColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>
                            <div v-if="ChoosenColumns.CurrentYearType == 2" class="col-md-3">
                                <label>دائن</label>

                                <select class="form-control" v-model="ChoosenColumns.CurrentYearCreditColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>
                        </div>
                        <!--------/. Current Year-------------->
                        <!-------- First Year-------------->
                        <div class="row" style="padding-top:20px">
                            <div class="col-md-3">
                                <h4>رصيد العام السابق 1</h4>
                            </div>

                            <div class="col-md-3">
                                <label>السنة</label>

                                <select class="form-control" v-model="ChoosenColumns.FirstYearColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>

                        </div>
                        <!-------- /.First Year-------------->
                        <!-------- Second Year-------------->
                        <div class="row" style="padding-top:20px">
                            <div class="col-md-3">
                                <h4>رصيد العام السابق 2</h4>
                            </div>

                            <div  class="col-md-3">
                                <label>السنة</label>

                                <select class="form-control" v-model="ChoosenColumns.SecondYearColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>

                            </div>
                        </div>
                        <!-------- /.Second Year-------------->
                        <!-------- Third Year-------------->
                        <div class="row" style="padding-top:20px">
                            <div class="col-md-3">
                                <h4>رصيد العام السابق 3</h4>
                            </div>
                            <div v-if="ChoosenColumns.ThirdYearType == 1" class="col-md-3">
                                <label>السنة</label>

                                <select class="form-control" v-model="ChoosenColumns.ThirdYearColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>
                        </div>
                        <!-------- /.Third Year-------------->

                        <!-------- Fourth Year-------------->
                        <div class="row" style="padding-top:20px">
                            <div class="col-md-3">
                                <h4>رصيد العام السابق 4</h4>
                            </div>
                            <div  class="col-md-3">
                                <label>السنة</label>

                                <select class="form-control" v-model="ChoosenColumns.FourthYearColumn">
                                    <option v-for="header in Headers">{{header}}</option>
                                </select>
                            </div>

                        </div>
                        <!-------- /.Fourth Year-------------->
                        <hr>
                        <button type="submit" class="btn btn-block btn-success btn-lg" style="padding: 15px;width:230px" >التالي</button>
                    </form>
                </div>
                <!--------- /.Choosing Columns ---------->
                <div v-else-if="Stage == 3" id="LinkingAccounts">
                    <button @click="Stage=2" type="submit" class="btn btn-block btn-info btn-lg" style="padding: 15px;width:230px;float:left !important;margin-bottom:20px" >
                        <i class="fa  fa-angle-double-right"></i>
                        السابقة
                    </button>
                    <table class="table table-condensed" >
                        <tbody><tr>
                            <th>نوع الحساب</th>
                            <th>رقم الحساب</th>
                            <th>أسم الحساب</th>
                            <th v-if="ChoosenColumns.CurrentYearType == 1">رصيد العام الحالي</th>
                            <th v-if="ChoosenColumns.CurrentYearType == 2">مدين العام الحالي</th>
                            <th v-if="ChoosenColumns.CurrentYearType == 2">دائن العام الحالي</th>

                            <th v-if="ChoosenColumns.FirstYearColumn">رصيد العام  السابق 1</th>

                            <th v-if="ChoosenColumns.SecondYearColumn ">رصيد العام  السابق 2</th>

                            <th v-if="ChoosenColumns.ThirdYearColumn">رصيد العام  السابق 3</th>

                            <th v-if="ChoosenColumns.FourthYearColumn">رصيد العام  السابق 4</th>

                            <th>تعليق</th>
                        </tr>
                        <tr v-for="Account in Accounts">
                            <!-------- link account ---------->
                            <td><v-select v-model="Account.LinkedAccount" :options="SystemAccounts"></v-select></td>
                            <!---------- Account Number / Name --------->
                            <td><input class="form-control" type="text" v-model="Account[ChoosenColumns.AccNumberColumn]"></td>
                            <td><input class="form-control" type="text" v-model="Account[ChoosenColumns.AccNameColumn]"></td>


                            <!--------- Current --------->
                            <td v-if="ChoosenColumns.CurrentYearType == 1">
                                {{Account[ChoosenColumns.CurrentYearColumn]}}
                            </td>
                            <td v-if="ChoosenColumns.CurrentYearType == 2">
                                {{Account[ChoosenColumns.CurrentYearDebitColumn]}}
                            </td>
                            <td v-if="ChoosenColumns.CurrentYearType == 2">
                                {{Account[ChoosenColumns.CurrentYearCreditColumn]}}
                            </td>
                            <!--------- First --------->
                            <td v-if="ChoosenColumns.FirstYearColumn">
                                {{Account[ChoosenColumns.FirstYearColumn]}}
                            </td>

                            <!--------- Second --------->
                            <td v-if="ChoosenColumns.SecondYearColumn">
                                {{Account[ChoosenColumns.SecondYearColumn]}}
                            </td>

                            <!--------- Third --------->
                            <td v-if="ChoosenColumns.ThirdYearColumn">
                                {{Account[ChoosenColumns.ThirdYearColumn]}}
                            </td>

                            <!--------- Fourth --------->
                            <td v-if="ChoosenColumns.FourthYearColumn">
                                {{Account[ChoosenColumns.FourthYearColumn]}}
                            </td>

                            <td><textarea v-model="Account.comment" class="form-control"></textarea></td>
                            <td><button v-if="!Account.added" @click=" Account.type == 'Account' ? StoreNewAccountStatement(Account) : StoreNewBranchedStatement(Account)" class="btn btn-success btn-md">ربط</button></td>
                            <td><button v-if="Account.added" @click=" Account.type == 'Account' ? DeleteAccountStatement(Account) : DeleteBranchedStatement(Account)" class="btn btn-danger btn-md">حذف</button></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "UploadExcelAccounts",
        props :{
            'Transaction' : Object,
        },
        data(){
            return{
                Headers:[],
                LoadingSpinner:'',
                Stage:1,
                ChoosenColumns:{
                    AccNameColumn:'',
                    AccNumberColumn:'',

                    CurrentYearType:'',
                    CurrentYearColumn:0,
                    CurrentYearDebitColumn:0,
                    CurrentYearCreditColumn:0,

                    FirstYearColumn:0,

                    SecondYearColumn:0,

                    ThirdYearColumn:0,

                    FourthYearColumn:0,
                },
                Accounts:[],

                SystemAccounts:[],
            }
        },
        methods:{
            GetExcelHeaders(){
                this.LoadingSpinner = true;
                let formData = new FormData();
                formData.append('AccountExcelFile', this.$refs.UploadedAccountsExcel.files[0]);
                axios.post(route('AccountExcel.Header'),formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                }).then(({data})=>{
                    this.Headers = [];
                    this.Accounts = [];
                    data.headers[0].forEach((header)=>{
                        header.forEach((head)=>{
                            this.Headers.push(head);
                        })
                        this.LoadingSpinner = false;
                    });
                    this.LoadingSpinner = true;

                    data.rows.forEach((row)=>{
                        this.$set(row,'added',false);
                        this.$set(row,'Branched',false);
                        this.$set(row,'comment','');
                        this.$set(row,'LinkedAccount',null);
                        this.Accounts.push(row);
                    });
                    this.LoadingSpinner = false;
                    this.Stage = 2;
                    this.$toast.success('.','تم الرفع بنجاح',{timeout:3000});

                }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','خطأ اثناء الرفع',{timeout:3000});

                })
            },
            GetAllAccounts(){
                this.LoadingSpinner = true;
                this.Stage = 3;
                axios.get((route('Excel.AvailableAccounts',this.Transaction.id)))
                    .then(({data})=>{
                        data.forEach((SysAccount)=>{
                            this.SystemAccounts.push( {'label' : '#'+SysAccount.code+' '+ SysAccount.name, 'code' :SysAccount.id,'level':SysAccount.level,'id':SysAccount.id,'type':'Account'}  );

                            if(SysAccount.transactions && SysAccount.transactions.length){
                                SysAccount.transactions.forEach((AccountStatement) => {
                                    this.SystemAccounts.push( {'label' : '#'+AccountStatement.pivot.code+' '+ AccountStatement.pivot.name, 'code' :AccountStatement.pivot.id,'level':AccountStatement.pivot.level,'id':AccountStatement.pivot.id,'type':'Statement'}  );
                                })
                            }
                        });
                        this.LoadingSpinner = false;

                    })
                    .catch((error)=>{
                        console.log(error);
                        this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                    })
            },
            StoreNewAccountStatement(account){
                if(account.LinkedAccount == null){
                    this.$toast.error('.','برجاء ربط الحساب',{timout:300});
                    return;
                }
                this.LoadingSpinner = true;
                let formData = new FormData();
                formData.append('transaction_id',this.Transaction.id);

                if(account.LinkedAccount.level == 1 ){
                    formData.append('first_level_account_id',account.LinkedAccount.code);
                }else if(account.LinkedAccount.level == 2 ){
                    formData.append('second_level_account_id',account.LinkedAccount.code);
                }else if(account.LinkedAccount.level == 3 ){
                    formData.append('third_level_account_id',account.LinkedAccount.code);
                }else if(account.LinkedAccount.level == 4 ){
                    formData.append('fourth_level_account_id',account.LinkedAccount.code);
                }
                formData.append('level',account.LinkedAccount.level);
                formData.append('name',account[this.ChoosenColumns.AccNameColumn]);
                formData.append('code',account[this.ChoosenColumns.AccNumberColumn]);

                // first year
                if (this.ChoosenColumns.CurrentYearType == 1){
                    formData.append('current_year',account[this.ChoosenColumns.CurrentYearColumn]);
                }
                if (this.ChoosenColumns.CurrentYearType == 2){

                    formData.append('current_year', ( account[this.ChoosenColumns.CurrentYearCreditColumn] - account[this.ChoosenColumns.CurrentYearDebitColumn]) );

                    formData.append('current_year_creditor',account[this.ChoosenColumns.CurrentYearCreditColumn]);
                    formData.append('current_year_debtor',account[this.ChoosenColumns.CurrentYearDebitColumn]);

                }
                // first year
                if (this.ChoosenColumns.FirstYearColumn){
                    formData.append('first_past_year',account[this.ChoosenColumns.FirstYearColumn]);
                }

                // second year
                if (this.ChoosenColumns.SecondYearColumn ){
                    formData.append('second_past_year',account[this.ChoosenColumns.SecondYearColumn]);
                }

                // third year
                if (this.ChoosenColumns.ThirdYearColumn ){
                    formData.append('third_past_year',account[this.ChoosenColumns.ThirdYearColumn]);
                }
                // fourth year
                if (this.ChoosenColumns.FourthYearColumn ){
                    formData.append('fourth_past_year',account[this.ChoosenColumns.FourthYearColumn]);
                }
                formData.append('comment',account.comment);
                formData.append('ReadDataOnly',0);

                axios.post(route('accounts.transactions.store',this.Transaction.id),formData)
                    .then((res) => {
                        console.log(res.data);
                        this.$set(account,'DeleteID',res.data);
                        this.LoadingSpinner = false;
                        account.added = true;
                        this.$toast.success('.','تم الربط بنجاح',{timout:3000});

                    })
                    .catch((error)=>{
                        this.LoadingSpinner = false;
                        this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                    })
            },
            DeleteAccountStatement(account){
                axios.delete(route('accounts.transactions.delete',account.DeleteID))
                    .then((res)=>{
                        this.$toast.success('.','تم الحذف بنجاح',{timout:3000});
                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                })
                account.added = false;
            },
            StoreNewBranchedStatement(account){
                this.LoadingSpinner = true;
                let formData = new FormData();
                console.log(account.LinkedAccount);
                formData.append('parent_id',account.LinkedAccount.id);


                formData.append('name',account[this.ChoosenColumns.AccNameColumn]);
                formData.append('code',account[this.ChoosenColumns.AccNumberColumn]);

                // first year
                if (this.ChoosenColumns.CurrentYearType == 1){
                    formData.append('current_year',account[this.ChoosenColumns.CurrentYearColumn]);
                }
                if (this.ChoosenColumns.CurrentYearType == 2){
                    formData.append('current_year', ( account[this.ChoosenColumns.CurrentYearCreditColumn] - account[this.ChoosenColumns.CurrentYearDebitColumn]) );
                    formData.append('current_year_creditor',account[this.ChoosenColumns.CurrentYearCreditColumn]);
                    formData.append('current_year_debtor',account[this.ChoosenColumns.CurrentYearDebitColumn]);
                }
                if (this.ChoosenColumns.FirstYearColumn){
                    formData.append('first_past_year',account[this.ChoosenColumns.FirstYearColumn]);
                }
                if (this.ChoosenColumns.SecondYearColumn ){
                    formData.append('second_past_year',account[this.ChoosenColumns.SecondYearColumn]);
                }

                if (this.ChoosenColumns.ThirdYearColumn ){
                    formData.append('third_past_year',account[this.ChoosenColumns.ThirdYearColumn]);
                }
                if (this.ChoosenColumns.FourthYearColumn ){
                    formData.append('fourth_past_year',account[this.ChoosenColumns.FourthYearColumn]);
                }
                formData.append('comment',account.comment);
                formData.append('ReadDataOnly',0);

                axios.post(route('Excel.BranchedStatement.store'),formData)
                    .then((res) => {
                        console.log(res.data);
                        this.$set(account,'DeleteID',res.data);
                        this.LoadingSpinner = false;
                        account.added = true;
                        this.$toast.success('.','تم الربط بنجاح',{timout:3000});

                    })
                    .catch((error)=>{
                        this.LoadingSpinner = false;
                        this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                    })
            },
            DeleteBranchedStatement(account){
                axios.delete(route('accounts.transactions.delete',[account.DeleteID,account.LinkedAccount.id]))
                    .then((res)=>{
                        this.$toast.success('.','تم الحذف بنجاح',{timout:3000});
                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                })
                account.added = false;
            }

        },
    }
</script>

<style scoped>

</style>
