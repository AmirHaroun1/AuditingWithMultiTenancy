<template>
    <div style="margin-top: 20px">
        <div class=" box">
            <div v-if="LoadingSpinner" class="overlay">
                <i class="fa fa-refresh fa-spin">
                </i>
            </div>
            <div class="">
                <div class="box-header">
                    <h2>الحسابات الخاصة بالمراجعة</h2>
                </div>
                <div class="box-body">
                    <!-------------- Nested accounts List -------------->
                    <div class="col-md-3 col-sm-12">
                        <ul class="list-group ">
                            <!------------- first level --------->
                            <li v-for="(LVL1Account,FirstLVLIndex) in LVL1_AccountCharts">
                                <h4 @click="LVL1Account.second_level_accounts.length ? '':GetAccountStatement(LVL1Account)" data-toggle="collapse" :data-target="'#'+LVL1Account.id" aria-expanded="true" :aria-controls="LVL1Account.id" style="padding:10px" class="shadow cursor-pointer nestedAccounts">{{LVL1Account.name}}</h4>
                                <!------------- second level --------->
                                <ul :id="LVL1Account.id"  class="list-group collapse fade" style="margin-right:15px">

                                    <li v-for="(LVL2Account,SecondLVLIndex) in LVL1Account.second_level_accounts">
                                        <h4 @click="LVL2Account.third_level_accounts.length ? '' : GetAccountStatement(LVL2Account)" data-toggle="collapse" :data-target="'#'+LVL2Account.id" aria-expanded="true" :aria-controls="LVL2Account.id" style="padding:10px;background-color: #12c998" class="shadow cursor-pointer nestedAccounts">{{LVL2Account.name}}</h4>

                                        <!------------- third level --------->
                                        <ul :id="LVL2Account.id"  class="list-group collapse fade" style="margin-right:30px">
                                            <li  v-for="(LVL3Account,ThirdLVLIndex) in LVL2Account.third_level_accounts">
                                                <h4 @click="LVL3Account.fourth_level_accounts.length ? '':GetAccountStatement(LVL3Account)" data-toggle="collapse" :data-target="'#'+LVL3Account.id" aria-expanded="true" :aria-controls="LVL3Account.id"  style="padding:10px;background-color: #14a098" class="shadow cursor-pointer nestedAccounts">{{LVL3Account.name}}</h4>

                                                    <!------------- Fourth level --------->
                                                    <ul :id="LVL3Account.id"  class="list-group collapse fade" style="margin-right:35px">
                                                        <li v-for="LVL4Account in LVL3Account.fourth_level_accounts">
                                                            <h4 @click="GetAccountStatement(LVL4Account)" style="padding:10px;background-color: #026670" class="shadow cursor-pointer nestedAccounts">{{LVL4Account.name}}</h4>
                                                        </li>
                                                    </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="pagination">
                            <button class="btn btn-default " @click="fetchSystemAccounts(NestedAccountsPaginationData.prev_page_url)" :disabled="!NestedAccountsPaginationData.prev_page_url">السابق</button>
                            <span>صفحة
                                {{NestedAccountsPaginationData.current_page}}
                                من
                                {{NestedAccountsPaginationData.last_page}}
                            </span>
                            <button class="btn btn-default" @click="fetchSystemAccounts(NestedAccountsPaginationData.next_page_url)" :disabled="!NestedAccountsPaginationData.next_page_url">التالي</button>

                        </div>
                    </div>
                    <!-------------- /.Nested accounts List -------------->

                    <div v-if="ParentStatement === null && SelectedAccount && SelectedAccount.statements" class="col-md-9 col-sm-12 text-center">
                        <!-------------- If Account is Fourth LevelAccount -------------->
                        <div  v-if="SelectedAccount.level == 4" >

                            <h4 >{{SelectedAccount.name}}</h4>
                            <table v-if="SelectedAccount.statements.length" class="table  table-bordered">

                                <thead class="text-white bg-green" >
                                <tr>
                                    <th style="font-size:12px">رقم <br>الحساب</th>
                                    <th style="font-size:12px" >اسم<br>الحساب</th>
                                    <th style="font-size:12px" v-if="SelectedAccount.is_related_party">الفرع</th>
                                    <th style="font-size:12px" v-if="SelectedAccount.is_related_party">نوع و<br>طبيعة العلاقة</th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year}}</th>
                                    <th style="font-size:12px">مدين <br>{{Transaction.financial_year}} </th>
                                    <th style="font-size:12px">دائن <br>{{Transaction.financial_year}} </th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year - 1}}</th>

                                    <th style="font-size:12px">رصيد<br> {{Transaction.financial_year - 2}}</th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year - 3}}</th>

                                    <th style="font-size:12px">رصيد<br>{{Transaction.financial_year - 4}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(statement,index) in SelectedAccount.statements">
                                    <td style="font-size:12px" ><a @click="OpenEditDeleteModal(statement,index)" class="cursor-pointer">{{statement.code}}</a></td>
                                    <td style="font-size:12px"><a @click="OpenEditDeleteModal(statement,index)" class="cursor-pointer">{{statement.name}}</a></td>
                                    <td style="font-size:12px" v-if="SelectedAccount.is_related_party" v-text="statement.related_party_branch"></td>
                                    <td style="font-size:12px" v-if="SelectedAccount.is_related_party" v-text="statement.related_party_type"></td>
                                    <td style="font-size:12px" v-text="formatValue(statement.current_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.current_year_debtor)"></td>
                                    <td style="font-size:12px" v-text="formatValue(statement.current_year_creditor)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.first_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.second_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.third_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.fourth_past_year)"></td>

                                </tr>

                                </tbody>
                            </table>
                            <div v-else>لا يوجد بيان مسجل</div>
                            <div @click="OpenAddStatementModal()" v-if="SelectedAccount" class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <div  class="col-md-12 text-center" style="border: 4px #00a65a dashed;cursor:pointer;color: #00a65a">
                                    <h4>
                                        أضافة بيان
                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-------------- /.If Account is Fourth LevelAccount -------------->

                        <!-------------- If Account isn't Fourth LevelAccount -------------->
                        <div  v-else-if=" SelectedAccount.level !=4 " >

                            <h4 >{{SelectedAccount.name}}</h4>
                            <table v-if="SelectedAccount.statements.length" class="table  table-bordered">

                                <thead class="text-white bg-green" >
                                <tr>
                                    <th style="font-size:12px">رقم <br>الحساب</th>
                                    <th style="font-size:12px">اسم <br>الحساب</th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year}}</th>
                                    <th style="font-size:12px">مدين <br>{{Transaction.financial_year}} </th>
                                    <th style="font-size:12px">دائن <br>{{Transaction.financial_year}} </th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year - 1}}</th>

                                    <th style="font-size:12px">رصيد<br> {{Transaction.financial_year - 2}}</th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year - 3}}</th>

                                    <th style="font-size:12px">رصيد<br>{{Transaction.financial_year - 4}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(statement,index) in SelectedAccount.statements">
                                    <td style="font-size:12px"><a @click="GetParentStatementBranches(statement)" class="cursor-pointer">{{statement.code}}</a></td>
                                    <td style="font-size:12px"><a @click="GetParentStatementBranches(statement)" class="cursor-pointer">{{statement.name}}</a></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.current_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.current_year_debtor)"></td>
                                    <td style="font-size:12px" v-text="formatValue(statement.current_year_creditor)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.first_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.second_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.third_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.fourth_past_year)"></td>


                                <td style="font-size:12px" ><i @click="OpenEditDeleteModal(statement,index)" class="fa fa-pencil cursor-pointer text-green"></i> </td>

                                </tr>

                                </tbody>
                            </table>
                            <div v-else>لا يوجد حسابات مسجلة</div>
                            <div @click="OpenAddStatementModal()" v-if="SelectedAccount" class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <div  class="col-md-12 text-center" style="border: 4px #00a65a dashed;cursor:pointer;color: #00a65a">
                                    <h4>
                                        أضافة بيان
                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <!-------------- /.If Account isn't Fourth LevelAccount -------------->

                    </div>
                    <div v-else-if="ParentStatement" class="col-md-9 col-sm-12 text-center">

                        <h3 class="pull-right cursor-pointer" @click="ExitAndUpdateParentStatement()"><i class="fa fa-times"></i> </h3>

                        <div >

                            <h4>{{ParentStatement.name}}</h4>
                            <table v-if="ParentStatement.BranchedStatements.length " class="table  table-bordered">

                                <thead class="text-white bg-green" >
                                <tr>
                                    <th style="font-size:12px">رقم <br>الحساب</th>
                                    <th style="font-size:12px">اسم <br>الحساب</th>
                                    <th style="font-size:12px" v-if="ParentStatement.is_related_party">الفرع</th>
                                    <th style="font-size:12px" v-if="ParentStatement.is_related_party">نوع و طبيعة العلاقة</th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year}}</th>
                                    <th style="font-size:12px">مدين <br>{{Transaction.financial_year}} </th>
                                    <th style="font-size:12px">دائن <br>{{Transaction.financial_year}} </th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year - 1}}</th>

                                    <th style="font-size:12px">رصيد<br> {{Transaction.financial_year - 2}}</th>

                                    <th style="font-size:12px">رصيد <br>{{Transaction.financial_year - 3}}</th>

                                    <th style="font-size:12px">رصيد<br>{{Transaction.financial_year - 4}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(statement,index) in ParentStatement.BranchedStatements">
                                    <td style="font-size:12px"><a @click="OpenEditDeleteModal(statement,index)" class="cursor-pointer">{{statement.code}}</a></td>
                                    <td style="font-size:12px"><a @click="OpenEditDeleteModal(statement,index)" class="cursor-pointer">{{statement.name}}</a></td>
                                    <td style="font-size:12px" v-if="ParentStatement.is_related_party" v-text="statement.related_party_branch"></td>
                                    <td style="font-size:12px" v-if="ParentStatement.is_related_party" v-text="statement.related_party_type"></td>
                                    <td style="font-size:12px" v-text="formatValue(statement.current_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.current_year_debtor)"></td>
                                    <td style="font-size:12px" v-text="formatValue(statement.current_year_creditor)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.first_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.second_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.third_past_year)"></td>

                                    <td style="font-size:12px" v-text="formatValue(statement.fourth_past_year)"></td>

                                </tr>

                                </tbody>
                            </table>
                            <div v-else>لا يوجد بيان مسجل</div>
                            <div @click="OpenAddChildStatementModal()" v-if="ParentStatement" class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-top: 10px;margin-bottom: 10px;">
                                <div  class="col-md-12 text-center" style="border: 4px #00a65a dashed;cursor:pointer;color: #00a65a">
                                    <h4>
                                        أضافة حساب
                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!------------ Edit Account Hidden Modal  ---------->
            <h4 type="button" ref="EditModalButton" data-toggle="modal" data-target="#EditAccountModal" style="display: none">
                تعديل حساب
            </h4>
            <div class="modal fade" id="EditAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تعديل حساب </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form @submit.prevent="ParentStatement == null ? EditTransactionAccountStatement() : EditTransactionAccountBranchedStatement()">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رقم الحساب</label>
                                            <input disabled v-model="temp_statement.code" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 form-group ">
                                        <div class="col-md-12" >
                                            <label>اسم الحساب</label>
                                            <input type="text" class="form-control" v-model="temp_statement.name" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 form-group " v-if="temp_statement.ShowRelatedFields"   >
                                        <div class="col-md-12" >
                                            <label>الفرع</label>
                                            <input type="text" class="form-control" v-model="temp_statement.related_party_branch" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 form-group " v-if="temp_statement.ShowRelatedFields" >
                                        <div class="col-md-12" >
                                            <label>نوع و طبيعة العلاقة</label>
                                            <input type="text" class="form-control" v-model="temp_statement.related_party_type" required>
                                        </div>
                                    </div>
                                    <div v-if="temp_statement.ShowDebitCreditValues" class="row">
                                        <div class="col-md-6 form-group">
                                            <label>مدين{{Transaction.financial_year}}</label>
                                            <input v-model="temp_statement.current_year_debtor" class="form-control">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>دائن{{Transaction.financial_year}}</label>
                                            <input v-model="temp_statement.current_year_creditor" class="form-control">
                                        </div>
                                    </div>
                                    <div v-if="temp_statement.ShowDebitCreditValues" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-1}}</label>
                                            <input v-model="temp_statement.first_past_year" class="form-control">
                                        </div>

                                    </div>
                                    <div v-if="temp_statement.ShowDebitCreditValues" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-2}}</label>
                                            <input v-model="temp_statement.second_past_year" class="form-control">
                                        </div>

                                    </div>
                                    <div v-if="temp_statement.ShowDebitCreditValues" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-3}}</label>
                                            <input v-model="temp_statement.third_past_year" class="form-control">
                                        </div>

                                    </div>
                                    <div v-if="temp_statement.ShowDebitCreditValues" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-4}}</label>
                                            <input v-model="temp_statement.fourth_past_year" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >تعديل</button>
                                    </div>

                                </form>
                                <div class="col-md-6">
                                    <button @click="ParentStatement == null ? DeleteStatement() : DeleteBranchedStatement()" type="submit" class="btn btn-block btn-danger btn-lg pull-left" style="width:130px;height:50px" >حذف</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button ref="CloseEditAccountModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ /. Edit Account Hidden Modal  ---------->
            <!------------ determine fixed points Hidden Modal  ---------->
            <h4 type="button" ref="DetermineFixedPointsButton" data-toggle="modal" data-target="#DetermineFixedPointsModal" style="display: none">
                أضافة حساب
            </h4>
            <div class="modal  fade" id="DetermineFixedPointsModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تحديد عدد الخانات</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <label>عدد الخانات</label>

                                <select v-model="NumberOfFixedPoints" class="form-control">
                                    <option value="">1</option>
                                    <option value="0" selected="selected">2</option>
                                    <option value="00">3</option>
                                    <option value="000">4</option>
                                    <option value="0000">5</option>
                                </select>

                                <button @click="CloseDetermineFixedPointsModalOpenAddModal()" type="submit" class="btn btn-block btn-success btn-lg mt-20" style="width:130px;height:50px" >حفظ</button>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button ref="CloseDetermineFixedPointsModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ /.determine fixed points Hidden Modal  ---------->

            <!------------ Add Account Hidden Modal ---------->
            <h4 type="button" ref="AddModalButton" data-toggle="modal" data-target="#AddAccountModal" style="display: none">
                انشاء حساب
            </h4>
            <div class="modal  fade" id="AddAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">انشاء حساب </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form @submit.prevent="SelectedAccount.level == 4 ? StoreNewFourthLevelStatement() : StoreNewParentStatement()">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <label>نوع الحساب</label>
                                            <input disabled class="form-control" v-model="AddedStatement.LinkedAccount.label">
                                        </div>
                                    </div>
                                    <div class="row pt-10 ">
                                        <div class="col-md-12">
                                            <label>رقم الحساب</label>
                                            <input disabled type="text" class="form-control" v-model="AddedStatement.code" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 " >
                                        <div class="col-md-12" >
                                            <label>اسم الحساب</label>
                                            <input type="text" class="form-control" v-model="AddedStatement.name" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 " v-if="AddedStatement.is_related_party && SelectedAccount.level == 4" >
                                        <div class="col-md-12" >
                                            <label>الفرع</label>
                                            <input type="text" class="form-control" v-model="AddedStatement.related_party_branch" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 " v-if="AddedStatement.is_related_party && SelectedAccount.level == 4" >
                                        <div class="col-md-12" >
                                            <label>نوع و طبيعة العلاقة</label>
                                            <input type="text" class="form-control" v-model="AddedStatement.related_party_type" required>
                                        </div>
                                    </div>

                                    <div v-if="SelectedAccount&&SelectedAccount.level == 4" class="row  pt-10" >

                                        <div class="col-md-6 form-group">
                                            <label>مدين{{Transaction.financial_year}}</label>
                                            <input v-model="AddedStatement.current_year_debtor" class="form-control" >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>دائن{{Transaction.financial_year}}</label>
                                            <input v-model="AddedStatement.current_year_creditor" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="SelectedAccount&&SelectedAccount.level == 4" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-1}}</label>
                                            <input v-model="AddedStatement.first_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="SelectedAccount&&SelectedAccount.level == 4" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-2}}</label>
                                            <input v-model="AddedStatement.second_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="SelectedAccount&&SelectedAccount.level == 4" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-3}}</label>
                                            <input v-model="AddedStatement.third_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="SelectedAccount&&SelectedAccount.level == 4" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-4}}</label>
                                            <input v-model="AddedStatement.fourth_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px;margin-top:15px" >أضافة</button>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button ref="CloseAddAccountModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ /.Add Account Hidden Modal ---------->


            <!------------ Add ChildStatement Hidden Modal ---------->
            <h4 type="button" ref="AddChildStatementModalButton" data-toggle="modal" data-target="#AddChildStatementModal" style="display: none">
                انشاء حساب
            </h4>
            <div class="modal  fade" id="AddChildStatementModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">انشاء حساب </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form @submit.prevent="StoreNewChildStatement()" v-if="ParentStatement">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <label>نوع الحساب</label>
                                            <input disabled class="form-control" :value="'#'+ParentStatement.code+' - '+ ParentStatement.name">
                                        </div>
                                    </div>
                                    <div class="row pt-10 ">
                                        <div class="col-md-12">
                                            <label>رقم الحساب</label>
                                            <input disabled type="text" class="form-control" v-model="AddedChildStatement.code" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 ">
                                        <div class="col-md-12">
                                            <label>اسم الحساب</label>
                                            <input type="text" class="form-control" v-model="AddedChildStatement.name" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 " v-if="AddedChildStatement.is_related_party" >
                                        <div class="col-md-12" >
                                            <label>الفرع</label>
                                            <input type="text" class="form-control" v-model="AddedChildStatement.related_party_branch" required>
                                        </div>
                                    </div>
                                    <div class="row pt-10 " v-if="AddedChildStatement.is_related_party" >
                                        <div class="col-md-12" >
                                            <label>نوع و طبيعة العلاقة</label>
                                            <input type="text" class="form-control" v-model="AddedChildStatement.related_party_type" required>
                                        </div>
                                    </div>
                                    <div  class="row  pt-10" >

                                        <div class="col-md-6 form-group">
                                            <label>مدين{{Transaction.financial_year}}</label>
                                            <input v-model="AddedChildStatement.current_year_debtor" class="form-control" >
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>دائن{{Transaction.financial_year}}</label>
                                            <input v-model="AddedChildStatement.current_year_creditor" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="AddedChildStatement" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-1}}</label>
                                            <input v-model="AddedChildStatement.first_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="AddedChildStatement" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-2}}</label>
                                            <input v-model="AddedChildStatement.second_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="AddedChildStatement" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-3}}</label>
                                            <input v-model="AddedChildStatement.third_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <div v-if="AddedChildStatement" class="row">
                                        <div class="col-md-12 form-group">
                                            <label>رصيد{{Transaction.financial_year-4}}</label>
                                            <input v-model="AddedChildStatement.fourth_past_year" class="form-control" >
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px;margin-top:15px" >أضافة</button>

                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button ref="CloseAddChildStatementModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ /.Add ChildStatement Hidden Modal ---------->

            <!------------ determine fixed points For ChildStatement Hidden Modal  ---------->
            <h4 type="button" ref="DetermineFixedPointsForChildStatementsButton" data-toggle="modal" data-target="#DetermineFixedPointsForChildStatements" style="display: none">
                أضافة حساب
            </h4>
            <div class="modal  fade" id="DetermineFixedPointsForChildStatements" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تحديد عدد الخانات</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <label>عدد الخانات</label>

                                <select v-model="NumberOfFixedPoints" class="form-control">
                                    <option value="">1</option>
                                    <option value="0" selected="selected">2</option>
                                    <option value="00">3</option>
                                    <option value="000">4</option>
                                    <option value="0000">5</option>
                                </select>

                                <button @click="CloseDetermineFixedPointsModalOpenAddChildStatementModal()" type="submit" class="btn btn-block btn-success btn-lg mt-20" style="width:130px;height:50px" >حفظ</button>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button ref="CloseDetermineFixedPointsModalForChildStatements" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                        </div>
                    </div>
                </div>
            </div>
            <!------------ ./determine fixed points For ChildStatement Hidden Modal  ---------->

        </div>

    </div>

</template>

<script>
    export default {
        name: "TransactionAccounts",
        props:{'Transaction':''},
        data(){
            return{
                LoadingSpinner:'',
                LVL1_AccountCharts:[],
                NestedAccountsPaginationData:{
                    'current_page':'',
                    'last_page':'',
                    'next_page_url':'',
                    'prev_page_url':'',
                },
                SelectedAccount:null,

                temp_statement:{
                    'id':'',
                    'code':'',
                    'name':'',
                    'current_year':0,
                    'current_year_creditor':0,
                    'current_year_debtor':0,

                    'first_past_year':0,

                    'second_past_year':0,

                    'third_past_year':0,

                    'fourth_past_year':0,
                    'account_level':'',

                    'is_related_party':false,
                    'related_party_type':'',
                    'related_party_branch':'',
                },
                NumberOfFixedPoints:'',
                AddedStatement:{
                  'id':'',
                  'code':'',
                  'name':'',
                  'current_year':0,
                  'current_year_creditor':0,
                  'current_year_debtor':0,

                  'first_past_year':0,

                  'second_past_year':0,

                  'third_past_year':0,

                  'fourth_past_year':0,

                  'type_id':'',
                  'type_level':'',
                   'LinkedAccount':{'label':'','code':'','level':''},
                    'is_related_party':false,
                    'related_party_type':'',
                    'related_party_branch':'',

                },

                edited_deleted_account:'',

                deleteIndex:'',
                SystemAccounts:[],

                ParentStatement:null,
                AddedChildStatement:{
                    'id':'',
                    'code':'',
                    'name':'',
                    'current_year':0,
                    'current_year_creditor':0,
                    'current_year_debtor':0,

                    'first_past_year':0,

                    'second_past_year':0,

                    'third_past_year':0,

                    'fourth_past_year':0,
                    'is_related_party':false,
                    'related_party_type':'',
                    'related_party_branch':'',
                },
            }
        },
        created() {
            this.fetchSystemAccounts(route('system.AccountCharts.index'));
        },
        methods:{
            fetchSystemAccounts(endpoint){
                this.LoadingSpinner = true;
                axios.get(endpoint)
                .then(({data})=>{
                    console.log(data);
                    this.LoadingSpinner = false;
                    this.LVL1_AccountCharts =[];
                    this.LVL1_AccountCharts.push(...data.AccountChartsWithChildren.data);
                    this.NestedAccountsPaginationData.current_page = data.AccountChartsWithChildren.current_page;
                    this.NestedAccountsPaginationData.last_page = data.AccountChartsWithChildren.last_page;
                    this.NestedAccountsPaginationData.next_page_url = data.AccountChartsWithChildren.next_page_url;
                    this.NestedAccountsPaginationData.prev_page_url = data.AccountChartsWithChildren.prev_page_url;


                    this.LoadingSpinner = false;
                }).catch((error)=>{
                    this.$toast.error('.','خطأ اثناء تحميل الحسابات',{timeout:3000});
                })
            },

            GetAccountStatement(Account){

                if(!Account.statements){
                    this.LoadingSpinner = true;
                    axios.get(route('accounts.statements.index',[Account.id,this.Transaction.id,Account.level,true]))
                        .then(({data})=>{

                            this.$set(Account,'statements',data.statements);
                            this.LoadingSpinner = false;

                        }).catch((error)=>{
                            console.log(error);
                        this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                        this.LoadingSpinner = false;

                    });
                }
                this.SelectedAccount = Account;
            },
            OpenEditDeleteModal(account,index){
                this.deleteIndex = index;
                this.$set(account,'ShowDebitCreditValues',false);
                if( this.SelectedAccount.level == 4 || (account.hasOwnProperty('parent_id') && account.parent_id !== null )  ){
                    this.$set(account,'ShowDebitCreditValues',true);
                }
                if( (account.is_related_party && this.SelectedAccount.level == 4) || (account.is_related_party && account.hasOwnProperty('parent_id') && account.parent_id !== null) ){
                    this.$set(account,'ShowRelatedFields',true);
                }
                this.temp_statement = {...account};

                this.edited_deleted_account = account;
                this.$refs.EditModalButton.click();
            },
            OpenAddStatementModal(){
                this.AddedStatement.name ='';
                this.AddedStatement.is_related_party = this.SelectedAccount.is_related_party;
                this.AddedStatement.current_year =0;
                this.AddedStatement.current_year_creditor =0;
                this.AddedStatement.current_year_debtor =0;

                this.AddedStatement.first_past_year =0;
                this.AddedStatement.second_past_year =0;
                this.AddedStatement.third_past_year =0;
                this.AddedStatement.fourth_past_year =0;

                this.AddedStatement.type_id = this.SelectedAccount.id;
                this.AddedStatement.type_level = this.SelectedAccount.level;

                this.AddedStatement.LinkedAccount.label =  '#'+this.SelectedAccount.code + ' - ' +this.SelectedAccount.name;
                this.AddedStatement.LinkedAccount.code =  this.SelectedAccount.id;
                this.AddedStatement.LinkedAccount.level =  this.SelectedAccount.level;

                this.AddedStatement.is_related_party =  this.SelectedAccount.is_related_party;


                if (!this.SelectedAccount.statements.length){
                    this.AddedStatement.code = this.SelectedAccount.code;
                    this.$refs.DetermineFixedPointsButton.click();
                }else{
                    let LastItemCode = this.SelectedAccount.statements[this.SelectedAccount.statements.length-1].code;
                    LastItemCode =  LastItemCode.toString();

                    let NewItemLastChar = parseInt(LastItemCode[LastItemCode.length-1])+1;

                    let NewItemLastCode  = LastItemCode.substring(0,LastItemCode.length-1) + NewItemLastChar ;


                    this.AddedStatement.code = NewItemLastCode;

                    this.$refs.AddModalButton.click();

                }
            },
            OpenAddChildStatementModal(){

                this.AddedChildStatement.name ='';
                this.AddedChildStatement.is_related_party = this.ParentStatement.is_related_party;
                this.AddedChildStatement.related_party_type ='';
                this.AddedChildStatement.related_party_branch ='';
                this.AddedChildStatement.name ='';

                this.AddedChildStatement.current_year =0;
                this.AddedChildStatement.current_year_creditor =0;
                this.AddedChildStatement.current_year_debtor =0;

                this.AddedChildStatement.first_past_year =0;
                this.AddedChildStatement.second_past_year =0;
                this.AddedChildStatement.third_past_year =0;
                this.AddedChildStatement.fourth_past_year =0;

                if (!this.ParentStatement.BranchedStatements.length){
                    this.AddedChildStatement.code = this.ParentStatement.code;


                    this.$refs.DetermineFixedPointsForChildStatementsButton.click();
                }else{
                    let LastItemCode = this.ParentStatement.BranchedStatements[this.ParentStatement.BranchedStatements.length-1].code;
                    LastItemCode =  LastItemCode.toString();

                    let NewItemLastChar = parseInt(LastItemCode[LastItemCode.length-1])+1;

                    let NewItemLastCode  = LastItemCode.substring(0,LastItemCode.length-1) + NewItemLastChar ;


                    this.AddedChildStatement.code = NewItemLastCode;

                    this.$refs.AddChildStatementModalButton.click();

                }
            },
            CloseDetermineFixedPointsModalOpenAddModal(){

                this.AddedStatement.code = this.AddedStatement.code+this.NumberOfFixedPoints+(this.SelectedAccount.statements.length+1);

                this.$refs.CloseDetermineFixedPointsModal.click();
                this.$refs.AddModalButton.click();
            },
            CloseDetermineFixedPointsModalOpenAddChildStatementModal(){

                this.AddedChildStatement.code = this.AddedChildStatement.code+this.NumberOfFixedPoints+(this.ParentStatement.BranchedStatements.length+1);

                this.$refs.CloseDetermineFixedPointsModalForChildStatements.click();
                this.$refs.AddChildStatementModalButton.click();
            },
            EditTransactionAccountStatement(){
                this.LoadingSpinner = true;
                this.$refs.CloseEditAccountModal.click();

                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('code',this.temp_statement.code);
                formData.append('name',this.temp_statement.name);
                if(this.temp_statement.is_related_party){
                    formData.append('is_related_party',this.temp_statement.is_related_party);
                    formData.append('related_party_type',this.temp_statement.related_party_type);
                    formData.append('related_party_branch',this.temp_statement.related_party_branch);
                }

                this.temp_statement.current_year = this.temp_statement.current_year_creditor - this.temp_statement.current_year_debtor;

                formData.append('current_year',this.temp_statement.current_year ? this.temp_statement.current_year : 0);

                formData.append('current_year_creditor',this.temp_statement.current_year_creditor !== null ? this.temp_statement.current_year_creditor : 0);

                formData.append('current_year_debtor',this.temp_statement.current_year_debtor !== null ? this.temp_statement.current_year_debtor : 0);

                formData.append('first_past_year',this.temp_statement.first_past_year !== null ? this.temp_statement.first_past_year : 0);

                formData.append('second_past_year',this.temp_statement.second_past_year !== null ? this.temp_statement.second_past_year : 0 );

                formData.append('third_past_year',this.temp_statement.third_past_year !== null ? this.temp_statement.third_past_year : 0);

                formData.append('fourth_past_year',this.temp_statement.fourth_past_year !== null ? this.temp_statement.fourth_past_year : 0);

                axios.post( route('accounts.statements.update',this.temp_statement.id) ,formData)
                    .then((res)=>{
                        this.$toast.success('.','تم التعديل بنجاح');
                        console.log(res);

                        this.$refs.CloseEditAccountModal.click();


                        this.SetTempAccountDataToEditAccountData();
                        this.LoadingSpinner = false;

                    }).catch((error)=>{
                        console.log(error);
                    this.$toast.error('خطأ','يرجى اعادة المحاولة',{timout:2000});
                    this.LoadingSpinner = false;
                });

            },
            EditTransactionAccountBranchedStatement(){
                this.LoadingSpinner = true;
                this.$refs.CloseEditAccountModal.click();

                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('code',this.temp_statement.code);
                formData.append('name',this.temp_statement.name);
                if(this.temp_statement.is_related_party){
                    formData.append('is_related_party',this.temp_statement.is_related_party);
                    formData.append('related_party_type',this.temp_statement.related_party_type);
                    formData.append('related_party_branch',this.temp_statement.related_party_branch);
                }
                this.temp_statement.current_year = this.temp_statement.current_year_creditor - this.temp_statement.current_year_debtor;

                formData.append('current_year',this.temp_statement.current_year ? this.temp_statement.current_year : 0);

                formData.append('current_year_creditor',this.temp_statement.current_year_creditor ? this.temp_statement.current_year_creditor : 0);

                formData.append('current_year_debtor',this.temp_statement.current_year_debtor ? this.temp_statement.current_year_debtor : 0);

                formData.append('first_past_year',this.temp_statement.first_past_year !== null ? this.temp_statement.first_past_year : 0);

                formData.append('second_past_year',this.temp_statement.second_past_year !== null ? this.temp_statement.second_past_year : 0 );

                formData.append('third_past_year',this.temp_statement.third_past_year !== null ? this.temp_statement.third_past_year : 0);

                formData.append('fourth_past_year',this.temp_statement.fourth_past_year !== null ? this.temp_statement.fourth_past_year : 0);

                axios.post( route('accounts.statements.update',this.temp_statement.id) ,formData)
                    .then((res)=>{
                        this.$toast.success('.','تم التعديل بنجاح');
                        console.log(res);
                        this.SetTempAccountDataToEditAccountData();
                        this.ReCalculateTheParentStatementData();
                        this.LoadingSpinner = false;
                    }).catch((error)=>{

                    console.log(error);
                    this.$toast.error('خطأ','يرجى اعادة المحاولة',{timout:2000});
                    this.LoadingSpinner = false;
                });

                this.$refs.CloseEditAccountModal.click();
            },
            SetTempAccountDataToEditAccountData(){
                this.edited_deleted_account.id = this.temp_statement.id;
                this.edited_deleted_account.code = this.temp_statement.code;
                this.edited_deleted_account.name = this.temp_statement.name;
                if(this.temp_statement.is_related_party){
                    this.edited_deleted_account.related_party_branch = this.temp_statement.related_party_branch;
                    this.edited_deleted_account.related_party_type = this.temp_statement.related_party_type;
                }
                this.edited_deleted_account.current_year = this.temp_statement.current_year_creditor - this.temp_statement.current_year_debtor ;
                this.edited_deleted_account.current_year_creditor = this.temp_statement.current_year_creditor;
                this.edited_deleted_account.current_year_debtor = this.temp_statement.current_year_debtor;
                this.edited_deleted_account.first_past_year = this.temp_statement.first_past_year;
                this.edited_deleted_account.second_past_year = this.temp_statement.second_past_year;
                this.edited_deleted_account.third_past_year = this.temp_statement.third_past_year;
                this.edited_deleted_account.fourth_past_year = this.temp_statement.fourth_past_year;

            },
            ReCalculateTheParentStatementData(){
                this.ParentStatement.current_year = 0;
                this.ParentStatement.current_year_debtor = 0;
                this.ParentStatement.current_year_creditor = 0;

                this.ParentStatement.first_past_year = 0;
                this.ParentStatement.second_past_year = 0;
                this.ParentStatement.third_past_year = 0;
                this.ParentStatement.fourth_past_year = 0;

                this.ParentStatement.BranchedStatements.forEach( BranchedStatement => {

                    this.ParentStatement.current_year += parseInt(BranchedStatement.current_year);
                    this.ParentStatement.current_year_debtor += parseInt(BranchedStatement.current_year_debtor);
                    this.ParentStatement.current_year_creditor += parseInt(BranchedStatement.current_year_creditor);

                    this.ParentStatement.first_past_year += parseInt(BranchedStatement.first_past_year);
                    this.ParentStatement.second_past_year += parseInt(BranchedStatement.second_past_year);
                    this.ParentStatement.third_past_year += parseInt(BranchedStatement.third_past_year);
                    this.ParentStatement.fourth_past_year += parseInt(BranchedStatement.fourth_past_year);
                } )
            },
            DeleteStatement(){
                this.LoadingSpinner = true;
                axios.delete(route('accounts.statements.delete',this.edited_deleted_account.id))
                    .then((res)=>{
                        this.SelectedAccount.statements.splice(this.deleteIndex,1);
                        this.$toast.success('.','تم الحذف بنجاح',{timout:3000});
                        this.LoadingSpinner = false;

                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                    this.LoadingSpinner = false;

                })
                this.$refs.CloseEditAccountModal.click();
                this.edited_deleted_account = null;
            },
            DeleteBranchedStatement(){
                this.LoadingSpinner = true;
                axios.delete(route('accounts.statements.delete',this.edited_deleted_account.id))
                    .then((res)=>{
                        this.ParentStatement.BranchedStatements.splice(this.deleteIndex,1);
                        this.$toast.success('.','تم الحذف بنجاح',{timout:3000});
                        this.ReCalculateTheParentStatementData();
                        this.LoadingSpinner = false;

                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                    this.LoadingSpinner = false;

                })
                this.$refs.CloseEditAccountModal.click();
                this.edited_deleted_account = null;
            },


            StoreNewFourthLevelStatement() {
                if (this.AddedStatement.LinkedAccount == null) {
                    this.$toast.error('.', 'برجاء ربط الحساب', {timout: 300});
                }
                this.$refs.CloseAddAccountModal.click();

                this.LoadingSpinner = true;
                let formData = new FormData();
                formData.append('transaction_id', this.Transaction.id);
                if (this.AddedStatement.LinkedAccount.level == 1) {
                    formData.append('first_level_account_id', this.AddedStatement.LinkedAccount.code);
                } else if (this.AddedStatement.LinkedAccount.level == 2) {
                    formData.append('second_level_account_id', this.AddedStatement.LinkedAccount.code);
                } else if (this.AddedStatement.LinkedAccount.level == 3) {
                    formData.append('third_level_account_id', this.AddedStatement.LinkedAccount.code);
                } else if (this.AddedStatement.LinkedAccount.level == 4) {
                    formData.append('fourth_level_account_id', this.AddedStatement.LinkedAccount.code);
                }
                formData.append('account_level', this.AddedStatement.LinkedAccount.level);
                formData.append('code', this.AddedStatement.code);
                formData.append('name', this.AddedStatement.name);
                if(this.AddedStatement.is_related_party){
                    formData.append('is_related_party',1);
                    formData.append('related_party_type',this.AddedStatement.related_party_type);
                    formData.append('related_party_branch',this.AddedStatement.related_party_branch);
                }else{
                    formData.append('is_related_party',0);
                }
                this.AddedStatement.current_year = this.AddedStatement.current_year_creditor - this.AddedStatement.current_year_debtor ;
                formData.append('current_year',this.AddedStatement.current_year_creditor - this.AddedStatement.current_year_debtor);

                formData.append('current_year_creditor',this.AddedStatement.current_year_creditor );

                formData.append('current_year_debtor',this.AddedStatement.current_year_debtor);

                formData.append('first_past_year',this.AddedStatement.first_past_year !== null ? this.AddedStatement.first_past_year : 0);

                formData.append('second_past_year',this.AddedStatement.second_past_year !== null ? this.AddedStatement.second_past_year : 0 );

                formData.append('third_past_year',this.AddedStatement.third_past_year !== null ? this.AddedStatement.third_past_year : 0);

                formData.append('fourth_past_year',this.AddedStatement.fourth_past_year !== null ? this.AddedStatement.fourth_past_year : 0);

                formData.append('ReadDataOnly',0);
                axios.post(route('accounts.statements.store',this.Transaction.id),formData)
                    .then((res) => {
                        console.log(res);
                        this.AddedStatement.id = res.data.id;
                        this.$toast.success('.','تم الربط بنجاح',{timout:3000});
                        this.SelectedAccount.statements.push( {...this.AddedStatement}  );
                        this.LoadingSpinner = false;
                    })
                    .catch((error)=>{
                        console.log(error);
                        this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                        this.LoadingSpinner = false;

                    });

            },


            StoreNewParentStatement(){
                this.$refs.CloseAddAccountModal.click();
                if(this.AddedStatement.LinkedAccount == null){
                    this.$toast.error('.','برجاء ربط الحساب',{timout:300});
                }
                this.LoadingSpinner = true;
                let formData = new FormData();
                formData.append('transaction_id',this.Transaction.id);
                if(this.AddedStatement.LinkedAccount.level == 1 ){
                    formData.append('first_level_account_id',this.AddedStatement.LinkedAccount.code);
                }else if(this.AddedStatement.LinkedAccount.level == 2 ){
                    formData.append('second_level_account_id',this.AddedStatement.LinkedAccount.code);
                }else if(this.AddedStatement.LinkedAccount.level == 3 ){
                    formData.append('third_level_account_id',this.AddedStatement.LinkedAccount.code);
                }else if(this.AddedStatement.LinkedAccount.level == 4 ){
                    formData.append('fourth_level_account_id',this.AddedStatement.LinkedAccount.code);
                }

                formData.append('account_level',this.AddedStatement.LinkedAccount.level);
                formData.append('code',this.AddedStatement.code);
                formData.append('name',this.AddedStatement.name);
                if(this.AddedStatement.is_related_party){
                    formData.append('is_related_party',1);
                    formData.append('related_party_type',this.AddedStatement.related_party_type);
                    formData.append('related_party_branch',this.AddedStatement.related_party_branch);
                }else{
                    formData.append('is_related_party',0);
                }
                this.AddedStatement.current_year = this.AddedStatement.current_year_creditor - this.AddedStatement.current_year_debtor ;

                formData.append('current_year',0);

                formData.append('current_year_creditor',0);

                formData.append('current_year_debtor',0);

                formData.append('first_past_year',0);

                formData.append('second_past_year',0);

                formData.append('third_past_year', 0);

                formData.append('fourth_past_year',0);

                formData.append('ReadDataOnly',0);

                axios.post(route('accounts.statements.store',this.Transaction.id),formData)
                    .then((res) => {
                        console.log(res);
                        this.AddedStatement.id = res.data.id;
                        this.$toast.success('.','تم الربط بنجاح',{timout:3000});
                        this.SelectedAccount.statements.push( {...this.AddedStatement}  );
                        this.LoadingSpinner = false;

                    })
                    .catch((error)=>{
                        console.log(error);
                        this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                        this.LoadingSpinner = false;

                    });

            },
            StoreNewChildStatement(){
                this.LoadingSpinner = true;
                this.$refs.CloseAddChildStatementModal.click();
                let formData = new FormData();
                formData.append('name',this.AddedChildStatement.name);
                formData.append('code',this.AddedChildStatement.code);
                if(this.AddedChildStatement.is_related_party){
                    formData.append('is_related_party',this.AddedChildStatement.is_related_party);
                    formData.append('related_party_branch',this.AddedChildStatement.related_party_branch);
                    formData.append('related_party_type',this.AddedChildStatement.related_party_type);
                }
                this.AddedChildStatement.current_year = this.AddedChildStatement.current_year_creditor - this.AddedChildStatement.current_year_debtor ;

                formData.append('current_year',this.AddedChildStatement.current_year_creditor - this.AddedChildStatement.current_year_debtor);

                formData.append('current_year_creditor',this.AddedChildStatement.current_year_creditor );

                formData.append('current_year_debtor',this.AddedChildStatement.current_year_debtor);

                formData.append('first_past_year',this.AddedChildStatement.first_past_year !== null ? this.AddedChildStatement.first_past_year : 0);

                formData.append('second_past_year',this.AddedChildStatement.second_past_year !== null ? this.AddedChildStatement.second_past_year : 0 );

                formData.append('third_past_year',this.AddedChildStatement.third_past_year !== null ? this.AddedChildStatement.third_past_year : 0);

                formData.append('fourth_past_year',this.AddedChildStatement.fourth_past_year !== null ? this.AddedChildStatement.fourth_past_year : 0);

                this.AddedChildStatement.parent_id =      this.ParentStatement.id;
                formData.append('parent_id',this.AddedChildStatement.parent_id);

                formData.append('ReadDataOnly',0);
                axios.post(route('accounts.statements.branches.store'),formData)
                    .then(({data}) => {
                        console.log( data.BranchedStatementID);
                        this.AddedChildStatement.id = data.BranchedStatementID;
                        this.$toast.success('.','تم الربط بنجاح',{timout:3000});
                        this.ParentStatement.BranchedStatements.push( {...this.AddedChildStatement}  );

                        this.ReCalculateTheParentStatementData();

                        this.LoadingSpinner = false;

                    })
                    .catch((error)=>{
                        console.log(error);
                        this.$toast.error('.','خطأ, برجاء المحاولة مرة أخرى',{timeout:3000});
                        this.LoadingSpinner = false;

                    });

            },
            formatValue(value) {
                if(value == null || value == 0 ){
                    return 0;
                }
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            GetParentStatementBranches(ParentStatement){

                this.ParentStatement = ParentStatement;

                if(!this.ParentStatement.BranchedStatements){

                    this.LoadingSpinner = true;

                    this.$set(this.ParentStatement,'BranchedStatements',[]);

                    axios.get(route('accounts.statements.branches.index',this.ParentStatement.id))

                        .then(({data} )=>{
                            data.BranchedStatements.forEach(BS =>{
                                this.ParentStatement.BranchedStatements.push({...BS});
                            })
                            this.LoadingSpinner = false;
                        }).catch((error)=>{

                            console.log(error);
                        this.LoadingSpinner = false;

                    })

                }

            },

            ExitAndUpdateParentStatement(){
                this.LoadingSpinner = true;

                let formData = new FormData();

                formData.append('_method',"PATCH");

                formData.append('current_year', this.ParentStatement.current_year ? this.ParentStatement.current_year  : 0);

                formData.append('current_year_creditor',this.ParentStatement.current_year_creditor ? this.ParentStatement.current_year_creditor : 0);

                formData.append('current_year_debtor',this.ParentStatement.current_year_debtor ? this.ParentStatement.current_year_debtor : 0);

                formData.append('first_past_year',this.ParentStatement.first_past_year !== null ? this.ParentStatement.first_past_year : 0);

                formData.append('second_past_year',this.ParentStatement.second_past_year !== null ? this.ParentStatement.second_past_year : 0 );

                formData.append('third_past_year',this.ParentStatement.third_past_year !== null ? this.ParentStatement.third_past_year : 0);

                formData.append('fourth_past_year',this.ParentStatement.fourth_past_year !== null ? this.ParentStatement.fourth_past_year : 0);

                axios.post(route('accounts.statements.update',this.ParentStatement.id),formData)
                    .then((res)=>{

                        this.LoadingSpinner = false;

                        this.ParentStatement = null;

                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('خطأ','يرجى اعادة المحاولة',{timout:2000});
                    this.LoadingSpinner = false;
                });
                this.$refs.CloseEditAccountModal.click();

            }
        },
        computed:{

        }
    }
</script>

<style scoped>

</style>
