<template>
    <div class="container box mt-20">
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="row">
            <div class="box-header">
                <h2>العينة</h2>
                <hr>
            </div>
            <div class="box-body" id="printHeading">
                <div v-for="AccountStatement in AccountsStatements">
                    <div  @click="" data-toggle="collapse" :data-target="'#'+'collapse'+AccountStatement.id" aria-expanded="true" :aria-controls="AccountStatement.id" class="col-md-12  mt-20 cursor-pointer mb-20 content-between" style="border: 2px #00a65a dashed;">
                        <h3 class="cursor-pointer">

                            {{AccountStatement.name}}

                        </h3>
                    </div>
                    <div :id="'collapse'+AccountStatement.id" class="collapse fade">
                        <!--------------- if the statement belongs to fourth level account--------->
                        <div v-if="AccountStatement.fourth_level_account_id !== null" >
                            <table class="mt-20 table table-bordered" >
                                <thead>
                                <tr>
                                    <th rowspan="2" colspan="1">
                                        الأسم
                                    </th>
                                    <th rowspan="2" colspan="1">
                                        رصيد
                                        {{Transaction.end_financial_year}}
                                    </th>
                                    <th rowspan="2" colspan="1">
                                        رصيد
                                        {{Transaction.FirstPastYearDate}}
                                    </th>
                                    <th class="text-center"  rowspan="1" colspan="2">
                                        عينة تفصيلية
                                        <br>
                                        من كشف حساب
                                        <br>
                                        {{AccountStatement.name}}
                                    </th>

                                    <th class="text-center" rowspan="1" colspan="2" >
                                        عينة تجميعية
                                        <br>
                                        من كشف حساب
                                        <br>
                                        بنود اخري
                                    </th>
                                    <th class="text-center" rowspan="1" colspan="4">
                                        نوع المستند
                                    </th>
                                    <th rowspan="2" colspan="1">
                                        الكود المقابل
                                    </th>
                                </tr>
                                <tr>
                                    <th  class="text-center">مدين</th>
                                    <th  class="text-center">دائن</th>

                                    <th class="text-center">مدين</th>
                                    <th  class="text-center">دائن</th>


                                    <th  class="text-center">رقم المستند</th>
                                    <th  class="text-center">تاريخ المستند</th>
                                    <th class="text-center">قبض
                                        <br>
                                        اشعار إضافة</th>
                                    <th  class="text-center">صرف
                                        <br>
                                        اشعار خصم</th>
                                </tr>

                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{AccountStatement.name}}</td>
                                    <td><p v-text="formatValue(AccountStatement.current_year)"></p></td>
                                    <td><p v-text="formatValue(AccountStatement.first_past_year)"></p></td>

                                    <td><p v-text="formatValue(AccountStatement.detailed_debit)"></p></td>
                                    <td><p v-text="formatValue(AccountStatement.detailed_credit)"></p></td>

                                    <td><p v-text="formatValue(AccountStatement.aggregated_debit)"></p></td>
                                    <td><p v-text="formatValue(AccountStatement.aggregated_credit)"></p></td>

                                    <td>-</td>
                                    <td>-</td>


                                    <td><p v-if="AccountStatement.aggregated_debit != 0">debit</p></td>
                                    <td><p v-if="AccountStatement.aggregated_credit != 0">credit</p></td>
                                    <td>-</td>

                                </tr>
                                <tr v-for="(AccountInKind,index) in AccountStatement.accounts_in_kind">
                                    <td   colspan="3"><a class="cursor-pointer" @click="OpenEditInKindModal(AccountStatement,AccountInKind,index)">{{AccountInKind.name}}</a></td>

                                    <td><p v-text="formatValue(AccountInKind.detailed_debit)"></p></td>
                                    <td><p v-text="formatValue(AccountInKind.detailed_credit)"></p></td>

                                    <td><p v-text="formatValue(AccountInKind.aggregated_debit)"></p></td>
                                    <td><p v-text="formatValue(AccountInKind.aggregated_credit)"></p></td>

                                    <td >{{AccountInKind.serial}}</td>
                                    <td >{{AccountInKind.date}}</td>


                                    <td><p v-if="AccountInKind.aggregated_debit != 0">debit</p></td>
                                    <td><p v-if="AccountInKind.aggregated_credit != 0">credit</p></td>

                                    <td>{{AccountInKind.corresponding_statement_code}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div  @click="OpenAddModalOfInKind(AccountStatement)" class="col-md-12 text-center mt-20 cursor-pointer" style="border: 1px #00a65a dashed;">
                                <h4>
                                    أضافة
                                    <i class="fa fa-plus" style="margin-right:5px"></i>
                                </h4>
                            </div>
                        </div>
                        <!--------------- ./if the statement belongs to fourth level account--------->
                        <div v-else class="mt-20">
                            <div v-if="AccountStatement.branched_statements.length" v-for="BranchedStatements in AccountStatement.branched_statements">
                                <div class="mt-20">
                                    <table class=" table table-bordered" >
                                        <thead>
                                        <tr>
                                            <th rowspan="2" colspan="1">
                                                الأسم
                                            </th>
                                            <th rowspan="2" colspan="1">
                                                رصيد
                                                {{Transaction.end_financial_year}}
                                            </th>
                                            <th rowspan="2" colspan="1">
                                                رصيد
                                                {{Transaction.FirstPastYearDate}}
                                            </th>
                                            <th class="text-center"  rowspan="1" colspan="2">
                                                عينة تفصيلية
                                                <br>
                                                من كشف حساب
                                                <br>
                                                {{AccountStatement.name}}
                                            </th>
                                            <th class="text-center" rowspan="1" colspan="2" >
                                                عينة تجميعية
                                                <br>
                                                من كشف حساب
                                                <br>
                                                بنود اخري
                                            </th>
                                            <th class="text-center" rowspan="1" colspan="4">
                                                نوع المستند
                                            </th>
                                            <th rowspan="2" colspan="1">
                                                الكود المقابل
                                            </th>
                                        </tr>
                                        <tr>
                                            <th  class="text-center">مدين</th>
                                            <th  class="text-center">دائن</th>

                                            <th class="text-center">مدين</th>
                                            <th  class="text-center">دائن</th>


                                            <th  class="text-center">رقم المستند</th>
                                            <th  class="text-center">تاريخ المستند</th>
                                            <th class="text-center">قبض
                                                <br>
                                                اشعار إضافة</th>
                                            <th  class="text-center">صرف
                                                <br>
                                                اشعار خصم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{BranchedStatements.name}}</td>
                                            <td><p v-text="formatValue(BranchedStatements.current_year)"></p></td>
                                            <td><p v-text="formatValue(BranchedStatements.first_past_year)"></p></td>

                                            <td><p v-text="formatValue(BranchedStatements.detailed_debit)"></p></td>
                                            <td><p v-text="formatValue(BranchedStatements.detailed_credit)"></p></td>

                                            <td><p v-text="formatValue(BranchedStatements.aggregated_debit)"></p></td>
                                            <td><p v-text="formatValue(BranchedStatements.aggregated_credit)"></p></td>

                                            <td>-</td>
                                            <td>-</td>

                                            <td><p v-if="BranchedStatements.aggregated_debit != 0">debit</p></td>
                                            <td><p v-if="BranchedStatements.aggregated_credit != 0">credit</p></td>
                                            <td>-</td>

                                        </tr>
                                        <tr v-for="(AccountInKind,index) in BranchedStatements.accounts_in_kind">
                                            <td   colspan="3"><a class="cursor-pointer" @click="OpenEditInKindModal(BranchedStatements,AccountInKind,index)">{{AccountInKind.name}}</a></td>

                                            <td><p v-text="formatValue(AccountInKind.detailed_debit)"></p></td>
                                            <td><p v-text="formatValue(AccountInKind.detailed_credit)"></p></td>

                                            <td><p v-text="formatValue(AccountInKind.aggregated_debit)"></p></td>
                                            <td><p v-text="formatValue(AccountInKind.aggregated_credit)"></p></td>

                                            <td >{{AccountInKind.serial}}</td>
                                            <td >{{AccountInKind.date}}</td>


                                            <td><p v-if="AccountInKind.aggregated_debit != 0">debit</p></td>
                                            <td><p v-if="AccountInKind.aggregated_credit != 0">credit</p></td>

                                            <td>{{AccountInKind.corresponding_statement_code}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div  @click="OpenAddModalOfInKind(BranchedStatements)" class="col-md-12 text-center mt-20 cursor-pointer" style="border: 1px #00a65a dashed;margin-bottom:20px">
                                        <h4>
                                            أضافة
                                            <i class="fa fa-plus" style="margin-right:5px"></i>
                                        </h4>
                                    </div>
                                    <hr>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!------------ Add Inkind Hidden Modal  ---------->
                <h4 type="button" ref="AddModalButton" data-toggle="modal" data-target="#AddInKindModal" style="display: none">
                    أضافة حساب
                </h4>
                <div class="modal  fade" id="AddInKindModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">أضافة</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form @submit.prevent="StoreNewInKind()">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>الاسم</label>
                                                <input v-model="AddedInKind.name" class="form-control" :default="0" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>تفصيلية - مدين</label>
                                                <input v-model="AddedInKind.detailed_debit" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>تفصيلية - دائن</label>
                                                <input v-model="AddedInKind.detailed_credit" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>رقم المستند</label>
                                                <input v-model="AddedInKind.serial" class="form-control" :default="0" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>تاريخ المستند</label>
                                                <input v-model="AddedInKind.date" class="form-control" type="date" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>الكود المقابل</label>
                                                <v-select :options="V_SelectOptions" v-model="AddedInKind.CorrespCode" :required="true"></v-select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button ref="CloseAddAccountModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------ /. Add Inkind Hidden Modal  ---------->
                <!------------ Edit Inkind Hidden Modal  ---------->
                <h4 type="button" ref="EditModalButton" data-toggle="modal" data-target="#EditInKindModal" style="display: none">
                    تعديل حساب
                </h4>
                <div class="modal  fade" id="EditInKindModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">أضافة</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form @submit.prevent="EditInKind()">
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>الاسم</label>
                                                <input v-model="tempInKind.name" class="form-control" :default="0" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label>تفصيلية - مدين</label>
                                                <input v-model="tempInKind.detailed_debit" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label>تفصيلية - دائن</label>
                                                <input v-model="tempInKind.detailed_credit" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>رقم المستند</label>
                                                <input v-model="tempInKind.serial" class="form-control" :default="0" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>تاريخ المستند</label>
                                                <input v-model="tempInKind.date" class="form-control" type="date" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 form-group">
                                                <label>الكود المقابل</label>
                                                <v-select :options="V_SelectOptions" v-model="tempInKind.VSelectValues" :required="true"></v-select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                                        </div>
                                    </form>
                                    <div class="col-md-6">
                                        <button @click="DeleteInKind()" type="submit" class="btn btn-block btn-danger btn-lg pull-left" style="width:130px;height:50px" >حذف</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button ref="CloseEditInKindModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!------------ /. Edit Inkind Hidden Modal  ---------->

                <div class="pagination text-center">
                    <button class="btn btn-default" @click="GetAccountsInKind(current_page-1)" :disabled="prev_page_url == null">السابق</button>
                    <span>صفحة
                    {{current_page}}
                    من
                    {{last_page}}
                </span>
                    <button class="btn btn-default" @click="GetAccountsInKind(current_page+1)" :disabled="next_page_url == null">التالي</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TransactionAccountStatementsSample",
        props: {
            'Transaction': '',
        },
        data() {
            return {
                LoadingSpinner: '',
                AccountsStatements:[],
                current_page : 1,
                last_page : '',
                next_page_url : '',
                prev_page_url : '',
                ArabicMonths:[{'Number':1,'Name':'يناير'},{'Number':2,'Name':'فبراير'},{'Number':3,'Name':'مارس'},{'Number':4,'Name':'أبريل'},{'Number':5,'Name':'مايو'},{'Number':6,'Name':'يونيو'},{'Number':7,'Name':'يوليو'},{'Number':8,'Name':'أغسطس'},{'Number':9,'Name':'سبتمبر'},{'Number':10,'Name':'أكتوبر'},{'Number':11,'Name':'نوفمبر'},{'Number':12,'Name':'ديسمبر'}],
                AddedInKind: {},
                ParentAccountArray:[],
                V_SelectOptions:[],
                tempInKind:{},
                EditedInKind:{},
            }
        },
        created() {
            this.GetAccountsInKind();
            this.GetEndDateOfTransactionInArabic();
        },
        methods: {
            GetAccountsInKind(page) {
                this.LoadingSpinner = true;
               axios.get(route('AccountsInKind.index',{TransactionID:this.Transaction.id, page}))
                   .then(({data}) => {
                       console.log(data);
                       this.current_page = data.current_page;
                       this.last_page = data.last_page;
                       this.next_page_url = data.next_page_url;
                       this.prev_page_url = data.prev_page_url;
                       this.AccountsStatements.push(...data.data);

                       this.AccountsStatements.forEach(AccountStatement => {

                            this.V_SelectOptions.push({'label':AccountStatement.code + ' ' + '# ' +AccountStatement.name,'code':AccountStatement.code,'id':AccountStatement.id});

                           if(AccountStatement.branched_statements.length){
                               AccountStatement.branched_statements.forEach(BranchedStatement => {
                                   this.V_SelectOptions.push({'label':BranchedStatement.code + ' ' + '# ' +BranchedStatement.name,'id':BranchedStatement.id});
                               })
                           }

                       })

                       this.LoadingSpinner = false;

                   })
                   .catch( error => {
                       console.log(error);
                       this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                       this.LoadingSpinner = false;
                   })
            },
            GetEndDateOfTransactionInArabic(){
                var splitedDate = this.Transaction.end_financial_year.split('-');
                splitedDate[1] = this.ArabicMonths.find(Month => {
                    if (Month.Number == splitedDate[1]){
                        return Month;
                    }
                });
                if(splitedDate[1]){

                    this.Transaction.end_financial_year = splitedDate[2]+' / '+splitedDate[1].Name+' / '+ splitedDate[0];
                    this.Transaction.FirstPastYearDate = splitedDate[2]+ ' / ' +splitedDate[1].Name + ' / ' + (parseInt(splitedDate[0])-1);
                    this.Transaction.SecondPastYearDate = splitedDate[2] + ' / ' +splitedDate[1].Name+' / '+ (parseInt(splitedDate[0])-2);
                    this.Transaction.ThirdPastYearDate = splitedDate[2] + ' / ' +splitedDate[1].Name+' / '+ (parseInt(splitedDate[0])-3);
                    this.Transaction.FourthPastYearDate = splitedDate[2] + ' / ' +splitedDate[1].Name+' / '+ (parseInt(splitedDate[0])-4);
                }

            },
            formatValue(value) {
                if(value == null || value == 0 ){
                    return 0;
                }
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            OpenAddModalOfInKind(ParentStatement){
                this.ParentStatement = ParentStatement;
                this.AddedInKind.statement_id =  ParentStatement.id;
                this.$refs.AddModalButton.click();
            },
            StoreNewInKind(){

                let formData = new FormData();

                formData.append('name',this.AddedInKind.name);
                formData.append('detailed_credit',this.AddedInKind.detailed_credit);
                formData.append('detailed_debit',this.AddedInKind.detailed_debit);
                formData.append('serial',this.AddedInKind.serial);
                formData.append('date',this.AddedInKind.date);

                this.AddedInKind.corresponding_statement_code = this.AddedInKind.CorrespCode.code;
                formData.append('corresponding_statement_code',this.AddedInKind.corresponding_statement_code);
                formData.append('corresponding_statement_id',this.AddedInKind.CorrespCode.id);

                formData.append('statement_id',this.ParentStatement.id);

                axios.post(route('AccountsInKind.store'),formData)
                    .then(({data})=>{
                        this.AddedInKind.id = data.id;

                        this.ParentStatement.accounts_in_kind.push({...this.AddedInKind});
                        console.log(data);
                        this.$toast.success('.','تمت اضافة بيانات الحساب بنجاح',{timout:2000});

                    }).catch(error => {
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    console.log(error);
                })


                this.$refs.CloseAddAccountModal.click();
            },
            OpenEditInKindModal(ParentStatement,InKind,index){
                this.ParentStatement = ParentStatement;

                this.tempInKind = {...InKind};

                this.tempInKind.index = index;

                this.EditedInKind = InKind;
                this.$refs.EditModalButton.click();
            },
            EditInKind(){

                let formData = new FormData();

                formData.append('_method',"PATCH");

                formData.append('name',this.tempInKind.name);
                formData.append('detailed_credit',this.tempInKind.detailed_credit);
                formData.append('detailed_debit',this.tempInKind.detailed_debit);
                formData.append('serial',this.tempInKind.serial);
                formData.append('date',this.tempInKind.date);

                if( this.tempInKind.VSelectValues && this.tempInKind.VSelectValues.hasOwnProperty('code') ){

                    this.tempInKind.corresponding_statement_code = this.tempInKind.VSelectValues.code;
                    formData.append('corresponding_statement_code',this.tempInKind.corresponding_statement_code);
                    formData.append('corresponding_statement_id',this.tempInKind.VSelectValues.id);
                }

                formData.append('statement_id',this.ParentStatement.id);

                axios.post(route('AccountsInKind.update',this.tempInKind.id),formData)
                    .then(({data})=>{

                        for (const property in this.tempInKind){
                            this.EditedInKind[property] = this.tempInKind[property];
                        }

                            console.log(data);
                        this.$toast.success('.','تم التعديل بنجاح',{timout:2000});

                    }).catch(error => {
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    console.log(error);
                })


                this.$refs.CloseEditInKindModal.click();
            },
            DeleteInKind(){

                axios.delete(route('AccountsInKind.destroy',[this.EditedInKind.id,this.ParentStatement.id]))
                    .then(res => {
                        this.$toast.success('.','تم الحذف بنجاح',{timout:2000});

                        this.ParentStatement.accounts_in_kind.splice(this.tempInKind.index,1);
                    }).catch(error => {
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});

                })
                this.$refs.CloseEditInKindModal.click();

            }
        }
    }
</script>

<style scoped>

</style>
