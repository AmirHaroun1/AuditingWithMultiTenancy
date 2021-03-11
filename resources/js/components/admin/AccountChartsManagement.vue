<template>
    <div class="container box" >
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="box-header">
            <h2 class="pb-3">الدليل المحاسبي</h2>
        </div>
        <div class="box-body">

            <!------------ first level list ---------->
            <div v-if="!LVL1_AccountCharts.length" >
                <div  @click="ShowAddAccountChartModal(LVL1_AccountCharts,0,0,null,1)" class="col-md-12 text-center mt-20 cursor-pointer" style="border: 4px #00a65a dashed;">
                    <h4>
                        أضافة حساب رئيسي
                        <i class="fa fa-plus" style="margin-right:5px"></i>
                    </h4>
                </div>
            </div>
                <div v-for="(FirstLVLAccount,first_level_index) in LVL1_AccountCharts" class="row">

                    <div   data-toggle="collapse" :href="'#'+FirstLVLAccount.id"  class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-10 cursor-pointer" style="border: 2px #00a65a dashed;justify-content: space-between;display: flex;">
                        <h3><i class=" fa fa-angle-double-left"></i> {{FirstLVLAccount.code}} - {{FirstLVLAccount.name}}</h3>
                        <div style="justify-content: space-between;display: flex;">
                            <h3><i @click="ShowEditAccountChartModal(FirstLVLAccount,1)" class=" fa fa-edit" style="margin-left:15px;cursor:pointer" ></i></h3>
                            <h3><i @click="destroy(LVL1_AccountCharts,first_level_index,FirstLVLAccount.id,1)" class="fa fa-trash-o" style="cursor:pointer"></i></h3>
                        </div>
                    </div>

                    <div class="collapse fade" :id="FirstLVLAccount.id">
                        <!------------ second level list ---------->
                            <div v-if="FirstLVLAccount.second_level_accounts && !FirstLVLAccount.second_level_accounts.length" class="col-md-11 col-sm-11 col-lg-11 col-xs-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-xs-offset-1 mt-10 mb-10">
                                <div  @click="ShowAddAccountChartModal(FirstLVLAccount.second_level_accounts,0,0,FirstLVLAccount,2)" class="col-md-12 text-center cursor-pointer" style="border: 4px #12c998 dashed;color: #12c998">
                                    <h4>
                                        أضافة حساب فرعي - مستوي ثاني
                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                    </h4>
                                </div>
                            </div>
                            <div v-for="(SecondLVLAccount,second_index) in FirstLVLAccount.second_level_accounts">

                            <div data-toggle="collapse" :href="'#'+SecondLVLAccount.id" class="col-md-11 col-sm-11 col-lg-11 col-xs-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-xs-offset-1 mt-10 cursor-pointer" style="border: 2px #12c998 dashed;justify-content: space-between;display: flex;">
                                <h3><i class=" fa fa-angle-double-left"></i> {{SecondLVLAccount.code}} - {{SecondLVLAccount.name}}</h3>
                                <div style="justify-content: space-between;display: flex;">
                                    <h3><i @click="ShowEditAccountChartModal(SecondLVLAccount,2)" class=" fa fa-edit cursor-pointer" style="margin-left:15px;" ></i></h3>
                                    <h3><i @click="destroy(FirstLVLAccount.second_level_accounts,second_index,SecondLVLAccount.id,2)" class="fa fa-trash-o cursor-pointer" ></i></h3>
                                </div>
                            </div>
                            <div class="collapse fade" :id="SecondLVLAccount.id">
                            <!------------ third level list ---------->
                            <div v-if="SecondLVLAccount.third_level_accounts && !SecondLVLAccount.third_level_accounts.length" class="col-md-10 col-sm-10 col-lg-10 col-xs-10 col-md-offset-2 col-sm-offset-2 col-lg-offset-2 col-xs-offset-2 mt-10 mb-10">
                                <div  @click="ShowAddAccountChartModal(SecondLVLAccount.third_level_accounts,0,SecondLVLAccount.parent_id,SecondLVLAccount,3)" class="col-md-12 text-center cursor-pointer" style="border: 4px #14a098 dashed;color: #14a098">
                                    <h4>
                                        أضافة حساب - مستوي ثالث
                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                    </h4>
                                </div>
                            </div>
                                <div v-for="(ThirdLVLAccount,third_level_index) in SecondLVLAccount.third_level_accounts">
                                    <div data-toggle="collapse" :href="'#'+ThirdLVLAccount.id" class="col-md-10 col-sm-10 col-lg-10 col-xs-10 col-md-offset-2 col-sm-offset-2 col-lg-offset-2 col-xs-offset-2 justify-content-between mt-10 cursor-pointer" style="border: 2px #14a098 dashed;justify-content: space-between;display: flex;">
                                            <h3><i class=" fa fa-angle-double-left"></i> {{ThirdLVLAccount.code}} - {{ThirdLVLAccount.name}}</h3>
                                        <div style="justify-content: space-between;display: flex;">
                                            <h3><i @click="ShowEditAccountChartModal(ThirdLVLAccount,3)" class=" fa fa-edit" style="margin-left:15px;cursor:pointer" ></i></h3>
                                            <h3><i @click="destroy(SecondLVLAccount.third_level_accounts,third_level_index,ThirdLVLAccount.id,3)" class="fa fa-trash-o" style="cursor:pointer"></i></h3>
                                        </div>
                                    </div>
                                    <!------------ fourth level list ---------->
                                    <div class="collapse fade" :id="ThirdLVLAccount.id">
                                        <div v-if="ThirdLVLAccount.fourth_level_accounts && !ThirdLVLAccount.fourth_level_accounts.length" class="col-md-9 col-sm-9 col-lg-9 col-xs-9 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-3 mt-10 mb-10">
                                            <div  @click="ShowAddAccountChartModal(ThirdLVLAccount.fourth_level_accounts,ThirdLVLAccount.top_parent_id,ThirdLVLAccount.parent_id,ThirdLVLAccount,4)" class="col-md-12 text-center cursor-pointer" style="border: 4px #026670 dashed;color: #026670">
                                                <h4>
                                                    أضافة حساب فرعي - مستوي رابع
                                                    <i class="fa fa-plus" style="margin-right:5px"></i>
                                                </h4>
                                            </div>
                                        </div>
                                        <div v-for="(FourthLVLAccount,fourth_level_index) in ThirdLVLAccount.fourth_level_accounts" class="col-md-9 col-sm-9 col-lg-9 col-xs-9 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-3 justify-content-between mt-10" style="border: 2px #026670 dashed;justify-content: space-between;display: flex;">
                                            <h3>{{FourthLVLAccount.code}} - {{FourthLVLAccount.name}}</h3>
                                            <div style="justify-content: space-between;display: flex;">
                                                <h3><i @click="ShowEditAccountChartModal(FourthLVLAccount,4)" class=" fa fa-edit cursor-pointer" style="margin-left:15px" ></i></h3>
                                                <h3><i @click="destroy(ThirdLVLAccount.fourth_level_accounts,fourth_level_index,FourthLVLAccount.id,4)" class="fa fa-trash-o cursor-pointer" ></i></h3>
                                            </div>
                                        </div>
                                        <div v-if="ThirdLVLAccount.fourth_level_accounts.length" class="col-md-9 col-sm-9 col-lg-9 col-xs-9 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-3 mt-10 mb-10">
                                            <div  @click="ShowAddAccountChartModal(ThirdLVLAccount.fourth_level_accounts,ThirdLVLAccount.top_parent_id,ThirdLVLAccount.parent_id,ThirdLVLAccount,4)" class="col-md-12 text-center cursor-pointer" style="border: 4px #026670 dashed;color: #026670">
                                                <h4>
                                                    أضافة حساب فرعي - مستوي رابع
                                                    <i class="fa fa-plus" style="margin-right:5px"></i>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!------------ /.fourth level list ---------->
                                    <div v-if="third_level_index == SecondLVLAccount.third_level_accounts.length - 1" class="col-md-10 col-sm-10 col-lg-10 col-xs-10 col-md-offset-2 col-sm-offset-2 col-lg-offset-2 col-xs-offset-2 mt-10 mb-10" >
                                        <div  @click="ShowAddAccountChartModal(SecondLVLAccount.third_level_accounts,0,SecondLVLAccount.parent_id,SecondLVLAccount,3)" class="col-md-12 text-center cursor-pointer" style="border: 4px #14a098 dashed;color: #14a098">
                                    <h4>
                                        أضافة حساب - مستوي ثالث
                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                    </h4>
                                </div>
                            </div>
                                </div>

                                <!------------ /.third level list ---------->
                        </div>
                    <div v-if="second_index == FirstLVLAccount.second_level_accounts.length - 1" class="col-md-11 col-sm-11 col-lg-11 col-xs-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-xs-offset-1 mt-10 mb-10" >
                        <div  @click="ShowAddAccountChartModal(FirstLVLAccount.second_level_accounts,0,0,FirstLVLAccount,2)" class="col-md-12 text-center cursor-pointer" style="border: 4px #12c998 dashed;color: #12c998">
                            <h4>
                                أضافة حساب فرعي - مستوي ثاني
                                <i class="fa fa-plus" style="margin-right:5px"></i>
                            </h4>
                        </div>
                    </div>
                    <!------------ /.second level list ---------->

                    </div>

                    </div>

                    <div v-if="first_level_index == LVL1_AccountCharts.length - 1" >
                        <div  @click="ShowAddAccountChartModal(LVL1_AccountCharts,0,0,null,1)" class="col-md-12 text-center mt-20 cursor-pointer" style="border: 4px #00a65a dashed;">
                            <h4>
                                أضافة حساب رئيسي
                                <i class="fa fa-plus" style="margin-right:5px"></i>
                            </h4>
                        </div>
                    </div>

                    <hr>
                </div>
            <div  class="pagination text-center">
                <button class="btn btn-default" @click="fetch(PaginationData.prev_page_url)" :disabled="!PaginationData.prev_page_url">السابق</button>
                <span>صفحة
                    {{PaginationData.current_page}}
                    من
                    {{PaginationData.last_page}}
                </span>
                <button class="btn btn-default" @click="fetch(PaginationData.next_page_url)" :disabled="!PaginationData.next_page_url">التالي</button>

            </div>
            <!------------ /.first level list ---------->

        </div>
        <!------------ Add Account Hidden Modal  ---------->
        <h4 type="button" ref="AddModalButton" data-toggle="modal" data-target="#AddAccountModal" style="display: none">
            أضافة حساب
        </h4>
        <div class="modal  fade" id="AddAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">أضافة حساب جديد</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form @submit.prevent="AddNewAccountChart()">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>رقم الحساب</label>
                                    <input disabled v-model="Added_Account.code" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>أسم الحساب</label>
                                    <input v-model="Added_Account.name" class="form-control" required>
                                </div>
                            </div>
                            <div class="row" v-if=" Added_Account.level !=1">
                                <div class="col-md-12 form-group">
                                    <label>اطراف ذات علاقة</label>
                                    <input v-model="Added_Account.is_related_party" type="checkbox">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>اجرائات المراجعة</label>
                                    <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.procedures" ></vue-editor>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>المعيار الدولي</label>
                                    <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.international_measurement" ></vue-editor>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>التعريف المحاسبي</label>
                                    <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.accounting_term" ></vue-editor>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>لفت الانتباه</label>
                                    <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.considerations" ></vue-editor>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>الدراسة</label>
                                    <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.study" ></vue-editor>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>الدراسة الثانية</label>
                                    <vue-editor :editorToolbar="customToolbar" v-model="Added_Account.second_study" ></vue-editor>
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
        <!------------ /. Add Account Hidden Modal  ---------->
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

        <!------------ Edit Account Hidden Modal  ---------->
        <h4 type="button" ref="EditModalButton" data-toggle="modal" data-target="#EditAccountModal" style="display: none">
            تعديل حساب
        </h4>
        <div class="modal fade" id="EditAccountModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل حساب </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form @submit.prevent="EditAccountChart()">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>رقم الحساب</label>
                                        <input disabled v-model="temp_account.code" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>أسم الحساب</label>
                                        <input v-model="temp_account.name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>اجرائات المراجعة</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.procedures" id="CkEditor1"></vue-editor>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>السياسات</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.policies" id="CkEditor2"></vue-editor>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>المعيار الدولي</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.international_measurement" ></vue-editor>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>التعريف المحاسبي</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.accounting_term" ></vue-editor>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>لفت الانتباه</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.considerations" ></vue-editor>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>الدراسة</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.study" ></vue-editor>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>الدراسة الثانية</label>
                                        <vue-editor :editorToolbar="customToolbar" v-model="temp_account.second_study" ></vue-editor>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ref="CloseEditAccountModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ /. Edit Account Hidden Modal  ---------->

    </div>

</template>

<script>
    export default {
        name: "AccountsCharts.vue",

        props:{
            AccountCharts:Array,
        },
        created() {
          this.fetch(route('system.AccountCharts.index'));
        },
        data(){
            return{
                LVL1_AccountCharts:[],

                ValidationErrors:'',
                LoadingSpinner:false,
                NumberOfFixedPoints:'',
                ParentAccountArray:[],
                Added_Account:{
                    'id':null,
                    'code':null,
                    'name':null,
                    'procedures':'',
                    'policies':'',
                    'international_measurement':'',
                    'accounting_term':'',
                    'considerations':'',
                    'study':'',
                    'second_study':'',

                    'oldest_parent_id':null,
                    'top_parent_id':null,
                    'parent_id':null,
                    'level':null,

                    'is_related_party':'',
                },
                Edit_Account:{
                    'id':null,
                    'code':null,
                    'name':null,
                    'level':null,
                    'procedures':'',
                    'policies':'',
                    'international_measurement':'',
                    'accounting_term':'',
                    'considerations':'',
                    'study':'',
                    'second_study':'',
                    'is_related_party':'',

                },
                temp_account:{
                    'id':null,
                    'code':null,
                    'name':null,
                    'level':null,
                    'procedures':'',
                    'policies':'',
                    'international_measurement':'',
                    'accounting_term':'',
                    'considerations':'',
                    'study':'',
                    'second_study':'',

                },
                PaginationData:{
                    'current_page':'',
                    'last_page':'',
                    'next_page_url':'',
                    'prev_page_url':'',
                },
                customToolbar:  [
                    [{ header: [false, 1, 2, 3, 4, 5, 6] }],

                    [{ size: ["small", false, "large", "huge"] }],

                    ["bold", "italic", "underline", "strike"],
                    [
                        { align: "" },
                        { align: "center" },
                        { align: "right" },
                        { align: "justify" }
                    ],

                    ["blockquote", "code-block"],

                    [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],

                    [{ color: [] }, { background: [] }],

                    ["link"],

                    [{ direction: "rtl" }],
                    ["clean"]
                ],

            }
        },
        methods:{
            fetch(endpoint){
                this.LoadingSpinner=true;
                axios.get(endpoint)
                .then(({data})=>{
                    this.LVL1_AccountCharts =[];
                    this.LVL1_AccountCharts.push(...data.AccountChartsWithChildren.data);
                    this.PaginationData.current_page = data.AccountChartsWithChildren.current_page;
                    this.PaginationData.last_page = data.AccountChartsWithChildren.last_page;
                    this.PaginationData.next_page_url = data.AccountChartsWithChildren.next_page_url;
                    this.PaginationData.prev_page_url = data.AccountChartsWithChildren.prev_page_url;
                    this.LoadingSpinner = false;

                })
            },
            ShowAddAccountChartModal(parentAccountArray,oldest_parent_id,top_parent_id,Parent,level){

                if(oldest_parent_id != 0){
                    this.Added_Account.oldest_parent_id = oldest_parent_id;
                }
                if(top_parent_id != 0){
                    this.Added_Account.top_parent_id = top_parent_id;
                }
                if(Parent !== null){
                    this.Added_Account.parent_id = Parent.id;
                    this.Added_Account.is_related_party = Parent.is_related_party;
                }

                this.Added_Account.level = level;
                this.ParentAccountArray = parentAccountArray;
                if(Parent == null && !this.ParentAccountArray.length){
                    this.Added_Account.code = 1;
                    this.$refs.AddModalButton.click();

                }
                else if (!this.ParentAccountArray.length){
                   this.Added_Account.code = Parent.code;
                   this.$refs.DetermineFixedPointsButton.click();
                }else{

                    let LastItemCode = this.ParentAccountArray[this.ParentAccountArray.length-1].code;
                    LastItemCode =  LastItemCode.toString();

                    let NewItemLastChar = parseInt(LastItemCode[LastItemCode.length-1])+1;

                    let NewItemLastCode  = LastItemCode.substring(0,LastItemCode.length-1) + NewItemLastChar ;


                    this.Added_Account.code = NewItemLastCode;

                    this.$refs.AddModalButton.click();
                }
            },
            CloseDetermineFixedPointsModalOpenAddModal(){

                this.Added_Account.code = this.Added_Account.code+this.NumberOfFixedPoints+(this.ParentAccountArray.length+1);

                this.$refs.CloseDetermineFixedPointsModal.click();
                this.$refs.AddModalButton.click();
            },
            ShowEditAccountChartModal(account,level){
                this.$refs.EditModalButton.click();
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

                formData.append('code',this.Added_Account.code);
                formData.append('name',this.Added_Account.name);
                formData.append('level',this.Added_Account.level);
                formData.append('procedures',this.Added_Account.procedures);
                formData.append('policies',this.Added_Account.policies);
                formData.append('international_measurement',this.Added_Account.international_measurement);
                formData.append('accounting_term',this.Added_Account.accounting_term);
                formData.append('considerations',this.Added_Account.considerations);
                formData.append('study',this.Added_Account.study);
                formData.append('second_study',this.Added_Account.second_study);

                formData.append('is_related_party',this.Added_Account.is_related_party ? 1 : 0);

                if (this.Added_Account.oldest_parent_id){
                    formData.append('oldest_parent_id',this.Added_Account.oldest_parent_id);
                }
                if (this.Added_Account.top_parent_id){
                    formData.append('top_parent_id',this.Added_Account.top_parent_id);
                }
                if (this.Added_Account.parent_id){
                    formData.append('parent_id',this.Added_Account.parent_id);
                }

                axios.post(route('system.AccountCharts.store'),formData)
                    .then(({data}) => {
                        if(this.Added_Account.level == 1){
                            this.ParentAccountArray.push({
                               'id' :   data.id,
                               'code' :  this.Added_Account.code,
                               'name' :  this.Added_Account.name,
                               'procedures' :  this.Added_Account.procedures,
                               'policies' :  this.Added_Account.policies,
                               'international_measurement' :  this.Added_Account.international_measurement,
                               'accounting_term' :  this.Added_Account.accounting_term,
                               'considerations' :  this.Added_Account.considerations,
                               'study' :  this.Added_Account.study,
                               'second_study' :  this.Added_Account.second_study,
                               'is_related_party' :  this.Added_Account.is_related_party,
                                'second_level_accounts' : [],
                            });
                        }
                        else if(this.Added_Account.level == 2){
                            this.ParentAccountArray.push({
                                'id' :  data.id,
                                'code' :  this.Added_Account.code,
                               'name' :  this.Added_Account.name,
                                'procedures' :  this.Added_Account.procedures,
                                'policies' :  this.Added_Account.policies,
                                'international_measurement' :  this.Added_Account.international_measurement,
                                'accounting_term' :  this.Added_Account.accounting_term,
                                'considerations' :  this.Added_Account.considerations,
                                'study' :  this.Added_Account.study,
                                'second_study' :  this.Added_Account.second_study,
                                'is_related_party' :  this.Added_Account.is_related_party,
                               'parent_id' :  this.Added_Account.parent_id,
                                'third_level_accounts' : [],
                            });
                        }
                        else if(this.Added_Account.level == 3){

                            this.ParentAccountArray.push({
                                'id' :  data.id,
                                'code' :  this.Added_Account.code,
                               'name' :  this.Added_Account.name,
                                'procedures' :  this.Added_Account.procedures,
                                'policies' :  this.Added_Account.policies,
                                'international_measurement' :  this.Added_Account.international_measurement,
                                'accounting_term' :  this.Added_Account.accounting_term,
                                'considerations' :  this.Added_Account.considerations,
                                'study' :  this.Added_Account.study,
                                'second_study' :  this.Added_Account.second_study,
                                'is_related_party' :  this.Added_Account.is_related_party,
                               'top_parent_id' :  this.Added_Account.top_parent_id,
                               'parent_id' :  this.Added_Account.parent_id,
                                'fourth_level_accounts' : [],

                            });
                        }
                        else if(this.Added_Account.level == 4){
                            this.ParentAccountArray.push({
                                'id' :  data.id,
                                'code' :  this.Added_Account.code,
                               'name' :  this.Added_Account.name,
                                'procedures' :  this.Added_Account.procedures,
                                'policies' :  this.Added_Account.policies,
                                'international_measurement' :  this.Added_Account.international_measurement,
                                'accounting_term' :  this.Added_Account.accounting_term,
                                'considerations' :  this.Added_Account.considerations,
                                'study' :  this.Added_Account.study,
                                'second_study' :  this.Added_Account.second_study,
                                'is_related_party' :  this.Added_Account.is_related_party,
                               'oldest_parent_id' :  this.Added_Account.oldest_parent_id,
                               'top_parent_id' :  this.Added_Account.top_parent_id,
                               'parent_id' :  this.Added_Account.parent_id
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
                        this.$toast.success('.','تمت اضافة بيانات الحساب بنجاح',{timout:2000});
                    })
                    .catch((error)=>{
                        console.log(error);
                        this.$refs.CloseAddAccountModal.click();

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                    });

            },
            destroy(ParentArray,index,id,level){
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

                            axios.delete(route('system.AccountCharts.delete',{id,level}))
                            .then((res)=>{
                                ParentArray.splice(index, 1);
                                this.$toast.success('.','قد تم حذف الحساب بنجاح',{timout:2000});
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
            EditAccountChart(){
                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('level',this.temp_account.level);
                formData.append('id',this.temp_account.id);
                formData.append('code',this.temp_account.code);
                formData.append('name',this.temp_account.name);
                formData.append('policies',this.temp_account.policies);
                formData.append('procedures',this.temp_account.procedures);

                formData.append('international_measurement',this.temp_account.procedures);
                formData.append('accounting_term',this.temp_account.procedures);

                formData.append('considerations',this.temp_account.considerations);
                formData.append('study',this.temp_account.study);
                formData.append('second_study',this.temp_account.second_study);

                axios.post(route('system.AccountCharts.update'),formData)
                    .then((res)=>{
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
                        this.$toast.success('.','تم تعديل الحساب بنجاح',{timout:2000});
                    }).catch((error)=>{
                    this.$toast.error('خطأ','خطأ اثناء التعديل',{timout:2000});
                })
                this.$refs.CloseEditAccountModal.click();

            }
        }
    }
</script>

<style scoped>

</style>
