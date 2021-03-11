<template>
    <div class="container box mt-20">
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="row">
            <div class="box-header">
                <h2>الإيضاحات</h2>
                <hr>
            </div>

            <div class="box-body" id="printHeading">
                <h3 class="text-center cursor-pointer" v-if="!printFullScreenBoolean"><i class="fa fa-print" @click="printFullScreen()"></i></h3>
                <div v-if="Accounts.length" v-for="FirstLVLAccount in Accounts" :key="FirstLVLAccount.id">

                    <!-- check if the first level account has clearance number -->
                    <div :id="FirstLVLAccount.id+'print'" v-if="FirstLVLAccount.ClearanceNumber" >
                        <div @click="FirstLVLAccount.MonetaryItems ? '':GetAccountStatements(FirstLVLAccount)" data-toggle="collapse" :data-target="'#'+'collapse'+FirstLVLAccount.id" aria-expanded="true" :aria-controls="FirstLVLAccount.id" class="col-md-12  mt-20 cursor-pointer mb-20 content-between" style="border: 2px #00a65a dashed;">

                            <h3 class="cursor-pointer">
                                إيضاح :
                                {{FirstLVLAccount.ClearanceNumber}}
                                ,
                                {{FirstLVLAccount.name}}
                            </h3>

                        </div>
                        <!----- collapsed tap content ------->
                        <div :id="'collapse'+FirstLVLAccount.id" :class="[printFullScreenBoolean ? '': 'collapse fade' ]">
                            <clearance-table :Account="FirstLVLAccount" :Transaction="Transaction" ref="FirstLVLClearances"></clearance-table>

                        </div>
                        <!----- ./collapsed tap content ------->
                    </div>
                    <!-- ./ check if the first level account has clearance number -->

                    <!-- if FirstLVLAccount doesn't have clearance number  -->
                    <!-- check if the second level account has clearance number -->
                    <div v-if="FirstLVLAccount.second_level_accounts.length && !FirstLVLAccount.ClearanceNumber" v-for="SecondLVLAccount in FirstLVLAccount.second_level_accounts">

                        <!----- if SecondLVLAccount level has clearance number --->
                        <div :id="SecondLVLAccount.id+'print'"  v-if="SecondLVLAccount.ClearanceNumber">
                            <div @click="SecondLVLAccount.MonetaryItems ? '':GetAccountStatements(SecondLVLAccount)" data-toggle="collapse" :data-target="'#'+'collapse'+SecondLVLAccount.id" aria-expanded="true" :aria-controls="SecondLVLAccount.id" class="col-md-12  mt-20 cursor-pointer mb-20 content-between" style="border: 2px #00a65a dashed;">
                                <h3 class="cursor-pointer">
                                    إيضاح :
                                    {{SecondLVLAccount.ClearanceNumber}}
                                    ,
                                    {{SecondLVLAccount.name}}
                                </h3>
                            </div>
                            <!----- collapsed tap content ------->
                            <div :id="'collapse'+SecondLVLAccount.id" :class="[printFullScreenBoolean ? '': 'collapse fade' ]">
                                <clearance-table :Account="SecondLVLAccount" :Transaction="Transaction" ref="SecondLVLClearances"></clearance-table>
                            </div>
                            <!----- ./collapsed tap content ------->
                        </div>
                        <!----- if ./SecondLVLAccount level has clearance number --->

                        <!-- if SecondLVLAccount doesn't have clearance number  -->
                        <!-- check if the third level account has clearance number -->
                        <div v-else-if="SecondLVLAccount.third_level_accounts.length" v-for="ThirdLVLAccount in SecondLVLAccount.third_level_accounts">

                            <!----- if ThirdLVLAccount level doesn't have Fourth level Accounts --->
                            <!----- if ThirdLVLAccount level has clearance number --->
                            <div  :id="ThirdLVLAccount.id+'print'"  v-if="ThirdLVLAccount.ClearanceNumber && ThirdLVLAccount.fourth_level_accounts.length == 0" >

                                <div @click="ThirdLVLAccount.MonetaryItems ? '':GetAccountStatements(ThirdLVLAccount)" data-toggle="collapse" :data-target="'#'+'collapse'+ThirdLVLAccount.id" aria-expanded="true" :aria-controls="ThirdLVLAccount.id" class="col-md-12  mt-20 cursor-pointer mb-20 content-between" style="border: 2px #00a65a dashed;">
                                    <h3 class="cursor-pointer">
                                        إيضاح :
                                        {{ThirdLVLAccount.ClearanceNumber}}
                                        ,
                                        {{ThirdLVLAccount.name}}

                                    </h3>
                                </div>
                                <!----- collapsed tap content ------->
                                <div :id="'collapse'+ThirdLVLAccount.id" :class="[printFullScreenBoolean ? '': 'collapse fade' ]">
                                    <clearance-table :Account="ThirdLVLAccount" :Transaction="Transaction" ref="ThirdLVLClearances" ></clearance-table>
                                </div>
                                <!----- ./collapsed tap content ------->

                            </div>
                            <!----- ./if ThirdLVLAccount level has clearance number --->
                            <!----- ./if ThirdLVLAccount level doesn't have Fourth level Accounts --->

                            <!----- if ThirdLVLAccount level  have Fourth level Accounts --->
                            <!----- if ThirdLVLAccount level has clearance number --->
                            <div  :id="ThirdLVLAccount.id+'print'"  v-else-if="ThirdLVLAccount.ClearanceNumber && ThirdLVLAccount.fourth_level_accounts.length" >

                                <div  @click="GetFourthLevelAccountsStatementsOfThirdLevelAccount(ThirdLVLAccount)" data-toggle="collapse" :data-target="'#'+'collapse'+ThirdLVLAccount.id" aria-expanded="true" :aria-controls="ThirdLVLAccount.id" class="col-md-12  mt-20 cursor-pointer mb-20 content-between" style="border: 2px #00a65a dashed;">
                                    <h3 class="cursor-pointer">
                                        إيضاح :
                                        {{ThirdLVLAccount.ClearanceNumber}}
                                        ,
                                        {{ThirdLVLAccount.name}}

                                    </h3>
                                </div>
                                <!--------- div contains all fourth level accounts ----------->
                                <div :id="'collapse'+ThirdLVLAccount.id" :class="[printFullScreenBoolean ? '': 'collapse fade' ]">
                                    <div>
                                        <h3 class="text-center"><i @click.prevent="printHeading(ThirdLVLAccount.id)" class=" fa fa-print cursor-pointer" style="margin-left:15px;" ></i></h3>
                                    </div>
                                    <!------ policies -------->
                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار السياسة</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowPolicies">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowPolicies"  class="row mt-10 " style="direction:rtl;margin-top:20px">
                                        <div class="col-md-2">
                                            <h3>
                                                السياسة :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">

                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.policies" ></vue-editor>
                                            </div>
                                            <h4 v-else v-html="ThirdLVLAccount.policies"></h4>
                                        </div>
                                    </div>
                                    <hr v-if="ThirdLVLAccount.policies || !PrintingMood">
                                    <!------ ./policies -------->
                                    <!------ considerations -------->
                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار لفت انتباه</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowConsedrations">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowConsedrations" class="row mt-20 " style="direction:rtl;margin-top:20px">

                                        <div class="col-md-2">
                                            <h3>
                                                لفت انتباه :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">

                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.considerations" ></vue-editor>
                                            </div>
                                            <h4 v-else v-html="ThirdLVLAccount.considerations"></h4>
                                        </div>
                                    </div>
                                    <hr v-if="ThirdLVLAccount.consedrations || !PrintingMood">
                                    <!------ ./considerations -------->

                                    <!------- Table ------------->
                                    <div class="row text-center">
                                        <div class="col-md-2 text-center" v-for="i in 4" v-if="!PrintingMood">
                                            <h5>اظهار رصيد السنة السابقة {{i}}</h5>
                                            <input v-if="i == 1" class="text-center" type="checkbox" v-model="ThirdLVLAccount.ShowFirstPastYear">
                                            <input v-if="i == 2" class="text-center" type="checkbox" v-model="ThirdLVLAccount.ShowSecondPastYear">
                                            <input v-if="i == 3" class="text-center" type="checkbox" v-model="ThirdLVLAccount.ShowThirdPastYear">
                                            <input v-if="i == 4" class="text-center" type="checkbox" v-model="ThirdLVLAccount.ShowFourthPastYear">
                                        </div>

                                    </div>
                                    <br>
                                    <div class=" mt-20 " style="direction:rtl" >
                                        <h3 class="mt-20">
                                            يتكون بند {{ThirdLVLAccount.name}}
                                            من :
                                        </h3>
                                        <table class="mt-20 table table-bordered" >
                                            <thead>
                                            <tr>
                                                <th rowspan="2" colspan="1" >
                                                    .
                                                </th>
                                                <th  rowspan="2" colspan="1">
                                                    الأسم
                                                </th>

                                                <th class="text-center"  rowspan="1" colspan="2">
                                                    حركة
                                                </th>

                                                <th class="text-center" rowspan="1" colspan="2" >
                                                    تعديل
                                                </th>
                                                <th class="text-center" rowspan="1" colspan="1" >
                                                    الرصيد النهائي
                                                </th>
                                                <th class="text-center" rowspan="1" colspan="1" v-if="ThirdLVLAccount.ShowFirstPastYear">
                                                    الرصيد النهائي
                                                </th>

                                                <th class="text-center" rowspan="1" colspan="1" v-if="ThirdLVLAccount.ShowSecondPastYear" >
                                                    الرصيد النهائي
                                                </th>
                                                <th class="text-center" rowspan="1" colspan="1" v-if="ThirdLVLAccount.ShowThirdPastYear" >
                                                    الرصيد النهائي
                                                </th>
                                                <th class="text-center" rowspan="1" colspan="1" v-if="ThirdLVLAccount.ShowFourthPastYear" >
                                                    الرصيد النهائي
                                                </th>

                                            </tr>
                                            <tr>
                                                <th >مدين</th>
                                                <th >دائن</th>

                                                <th>مدين</th>
                                                <th >دائن</th>

                                                <th class="text-center">{{Transaction.end_financial_year}}</th>
                                                <th class="text-center" v-if="ThirdLVLAccount.ShowFirstPastYear">{{Transaction.FirstPastYearDate}}</th>
                                                <th class="text-center" v-if="ThirdLVLAccount.ShowSecondPastYear">{{Transaction.SecondPastYearDate}}</th>
                                                <th class="text-center" v-if="ThirdLVLAccount.ShowThirdPastYear">{{Transaction.ThirdPastYearDate}}</th>
                                                <th class="text-center" v-if="ThirdLVLAccount.ShowFourthPastYear">{{Transaction.FourthPastYearDate}}</th>

                                                <th class="text-center">
                                                    5%
                                                </th>
                                                <th class="text-center">
                                                    10%
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody >
                                            <tr v-for="(item,index) in ThirdLVLAccount.fourth_level_accounts" :key="item.id">

                                                <td>
                                                    <h5>{{ThirdLVLAccount.ClearanceNumber + '.0'}}{{index+1}}</h5>
                                                </td>
                                                <td>
                                                    <h5>{{item.name}}</h5>
                                                </td>

                                                <td>
                                                    <h5 v-text="formatValue(item.CurrentYearDebtorSum)"></h5>
                                                </td>
                                                <td>
                                                    <h5 v-text="formatValue(item.CurrentYearCreditorSum)"></h5>
                                                </td>
                                                <td>
                                                    <h5 v-text="formatValue(item.edited_CurrentYearDebtorSum)"></h5>
                                                </td>
                                                <td>
                                                    <h5 v-text="formatValue(item.edited_CurrentYearCreditorSum)"></h5>
                                                </td>

                                                <td class="text-center">
                                                    <h5 v-text="formatValue((item.CurrentYearSum))" ></h5>
                                                </td>
                                                <td class="text-center" v-if="ThirdLVLAccount.ShowFirstPastYear">
                                                    <h5 v-text="formatValue(item.FirstPastYearSum)"></h5>
                                                </td>
                                                <td class="text-center" v-if="ThirdLVLAccount.ShowSecondPastYear">
                                                    <h5 v-text="formatValue(item.SecondPastYearSum)"></h5>
                                                </td>
                                                <td class="text-center" v-if="ThirdLVLAccount.ShowThirdPastYear">
                                                    <h5 v-text="formatValue(item.ThirdPastYearSum)"></h5>
                                                </td>
                                                <td class="text-center" v-if="ThirdLVLAccount.ShowFourthPastYear">
                                                    <h5 v-text="formatValue(item.FourthPastYearSum)"></h5>
                                                </td>
                                                <td class="text-center" >
                                                    <h5 v-text="formatValue((item.CurrentYearSum * 0.05))" ></h5>
                                                </td>
                                                <td class="text-center" >
                                                    <h5 v-text="formatValue((item.CurrentYearSum * 0.10))" ></h5>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td><h4>الرصيد آخر السنة</h4></td>
                                                <td style="visibility: hidden"></td>

                                                <td><h5 v-text="formatValue(ThirdLVLAccount.CurrentYearDebtorSum)"></h5></td>
                                                <td><h5 v-text="formatValue(ThirdLVLAccount.CurrentYearCreditorSum)"></h5></td>
                                                <td><h5 v-text="formatValue(ThirdLVLAccount.edited_CurrentYearDebtorSum)"></h5></td>
                                                <td><h5  v-text="formatValue(ThirdLVLAccount.edited_CurrentYearCreditorSum)"></h5></td>
                                                <td >
                                                    <h5 class="text-center" v-text="formatValue(ThirdLVLAccount.CurrentYearSum)"> </h5>
                                                </td>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!------- ./Table ------------->

                                    <!------ Study -------->
                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار الدراسة</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowStudy">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowStudy" class="row mt-10 " style="direction:rtl;margin-top:20px">
                                        <div class="col-md-2">
                                            <h3>
                                                الدراسة :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">

                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.study" ></vue-editor>
                                            </div>
                                            <h4 v-else v-html="ThirdLVLAccount.study"></h4>
                                        </div>
                                    </div>

                                    <hr v-if="ThirdLVLAccount.study || !PrintingMood">

                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار الدراسة الثانية</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowSecond_study">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowSecond_study" class="row mt-10 " style="direction:rtl;margin-top:20px">
                                        <div class="col-md-2">
                                            <h3>
                                                الدراسة الثانية :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">

                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.second_study" ></vue-editor>
                                            </div>
                                            <h4 v-else v-html="ThirdLVLAccount.second_study"></h4>
                                        </div>
                                    </div>
                                    <hr v-if="ThirdLVLAccount.second_study || !PrintingMood">
                                    <!------ ./Study -------->
                                    <!------ procedures ------>
                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار اجرائات المراجعة</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowProcedures">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowProcedures" class="row mt-20 " style="direction:rtl;margin-top:20px">

                                        <div class="col-md-2">
                                            <h3>
                                                اجرائات المراجعة :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">

                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.procedures" ></vue-editor>
                                            </div>
                                            <h4 v-else v-html="ThirdLVLAccount.procedures"></h4>
                                        </div>
                                    </div>
                                    <hr v-if="ThirdLVLAccount.procedures || !PrintingMood">
                                    <!------ ./procedures ------>
                                    <!------ international Measurement ----->
                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار المعيار الدولي</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowInternational_measurement">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowInternational_measurement" class="row mt-20 " style="direction:rtl;margin-top:20px">

                                        <div class="col-md-2">
                                            <h3>
                                                المعيار الدولي :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">
                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.international_measurement" ></vue-editor>
                                            </div>
                                            <h4 v-else v-html="ThirdLVLAccount.international_measurement"></h4>
                                        </div>
                                    </div>
                                    <hr v-if="ThirdLVLAccount.international_measurement || !PrintingMood">
                                    <!------ ./international Measurement ----->
                                    <!------ Accounting Term ----->
                                    <div v-if="!PrintingMood">
                                        <h3 >إظهار التعريف المحاسبي</h3>
                                        <input type="checkbox" v-model="ThirdLVLAccount.ShowAccounting_term">
                                    </div>
                                    <div v-if="ThirdLVLAccount.ShowAccounting_term" class="row mt-20 " style="direction:rtl;margin-top:20px">

                                        <div class="col-md-2">
                                            <h3>
                                                التعريف المحاسبي :
                                            </h3>
                                        </div>
                                        <div class="col-md-8">
                                            <div v-if="!PrintingMood">
                                                <vue-editor :editorToolbar="customToolbar" v-model="ThirdLVLAccount.accounting_term" ></vue-editor>
                                            </div>

                                            <h4 v-else v-html="ThirdLVLAccount.accounting_term"></h4>
                                        </div>
                                    </div>
                                    <hr v-if="ThirdLVLAccount.accounting_term || !PrintingMood">
                                    <!------ ./Accounting Term ----->
                                    <!------ Save Button ----->
                                    <div v-if="!PrintingMood " class="text-center">
                                        <button @click="ThirdLVLAccount.GotVueEditorDataFromStatement ? UpdateValuesOfTextAreaOfThirdLVLStatementAfterEditingToStatement(ThirdLVLAccount) : SaveValuesOfTextAreaOfThirdLVLStatementAfterEditingToStatement(ThirdLVLAccount) "  class=" btn btn-success btn-lg mt-20">حفظ</button>
                                    </div>
                                    <!------ ./Save Button ----->

                                </div>
                                <!--------- ./div contains all fourth level accounts ----------->

                            </div>
                            <!----- ./if ThirdLVLAccount level has clearance number --->
                            <!----- ./if ThirdLVLAccount level have Fourth level Accounts --->


                        </div>
                        <!-- check if the third level account has clearance number -->



                        <!-- if ./SecondLVLAccount doesn't have clearance number  -->

                    </div>
                    <!-- ./ check if the second level account has clearance number -->
                    <!-- ./if FirstLVLAccount doesn't have clearance number  -->

                </div>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "TransactionClearances",
        props:{
            'Transaction':'',
        },
        data(){
            return{
                LoadingSpinner:'',

                Accounts:[],

                ClearanceCounter:0,

                PrintingMood : false,
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

                ArabicMonths:[{'Number':1,'Name':'يناير'},{'Number':2,'Name':'فبراير'},{'Number':3,'Name':'مارس'},{'Number':4,'Name':'أبريل'},{'Number':5,'Name':'مايو'},{'Number':6,'Name':'يونيو'},{'Number':7,'Name':'يوليو'},{'Number':8,'Name':'أغسطس'},{'Number':9,'Name':'سبتمبر'},{'Number':10,'Name':'أكتوبر'},{'Number':11,'Name':'نوفمبر'},{'Number':12,'Name':'ديسمبر'}],
                printFullScreenBoolean:false,
            }
        },
        created() {
            this.GetSumOfAccountsOfTransaction(route('accounts.statements.sum',this.Transaction));
        },
        methods: {

            GetSumOfAccountsOfTransaction(endpoint){
                this.LoadingSpinner = true;
                this.GetEndDateOfTransactionInArabic();
                axios.get(endpoint)
                    .then(({data})=>{

                        this.Accounts.push(...data.AccountStatementsWithSum);
                        this.LoadingSpinner = false;
                        this.SetClearanceNumber();

                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    this.LoadingSpinner = false;

                });


            },

            SetClearanceNumber(){
                this.LoadingSpinner = true;
                let ClearanceIsAddedd = false;
                this.Accounts.forEach(FirstLVLAccount =>{

                    if(FirstLVLAccount.CurrentYearSum != 0 &&FirstLVLAccount.CurrentYearSum != null && !FirstLVLAccount.second_level_accounts.length){

                        console.log(FirstLVLAccount.name + FirstLVLAccount.CurrentYearSum);
                        this.ClearanceCounter++;
                        this.$set(FirstLVLAccount,'ClearanceNumber',this.ClearanceCounter);
                        this.$set(FirstLVLAccount,'ShowPolicies',false);
                        this.$set(FirstLVLAccount,'ShowConsiderations',false);
                        this.$set(FirstLVLAccount,'ShowStudy',false);
                        this.$set(FirstLVLAccount,'ShowSecond_study',false);
                        this.$set(FirstLVLAccount,'ShowProcedures',false);
                        this.$set(FirstLVLAccount,'ShowAccounting_term',false);
                        this.$set(FirstLVLAccount,'ShowInternational_measurement',false);
                        // filling Excel Account
                        this.$set(FirstLVLAccount,'ShowFirstPastYear',false);
                        this.$set(FirstLVLAccount,'ShowSecondPastYear',false);
                        this.$set(FirstLVLAccount,'ShowThirdPastYear',false);
                        this.$set(FirstLVLAccount,'ShowFourthPastYear',false);
                    }
                    else{
                        FirstLVLAccount.second_level_accounts.forEach(SecondLVLAccount =>{

                            SecondLVLAccount.third_level_accounts.forEach(ThirdLVLAccount =>{

                                ThirdLVLAccount.fourth_level_accounts.forEach(FourthLVLAccount =>{

                                    if(FourthLVLAccount.CurrentYearSum != 0 && FourthLVLAccount.CurrentYearSum != null){

                                        // if the fourth level Account Sum is not 0 or null and the third level didn't have Clearance Number increment clearance number and assign it to third LVL
                                        if(ClearanceIsAddedd !== true){
                                            this.ClearanceCounter++;
                                            this.$set(ThirdLVLAccount,'ClearanceNumber',this.ClearanceCounter);
                                            ClearanceIsAddedd = true;
                                            this.$set(ThirdLVLAccount,'ShowProcedures',false);
                                            this.$set(ThirdLVLAccount,'ShowPolicies',false);
                                            this.$set(ThirdLVLAccount,'ShowInternational_measurement',false);
                                            this.$set(ThirdLVLAccount,'ShowAccounting_term',false);
                                            this.$set(ThirdLVLAccount,'ShowConsiderations',false);
                                            this.$set(ThirdLVLAccount,'ShowStudy',false);
                                            this.$set(ThirdLVLAccount,'ShowSecond_study',false);

                                            this.$set(ThirdLVLAccount,'ShowFirstPastYear',false);
                                            this.$set(ThirdLVLAccount,'ShowSecondPastYear',false);
                                            this.$set(ThirdLVLAccount,'ShowThirdPastYear',false);
                                            this.$set(ThirdLVLAccount,'ShowFourthPastYear',false);
                                        }
                                        // Add the sum of each fourth level account to the sum of parent account
                                        ThirdLVLAccount.CurrentYearSum += FourthLVLAccount.CurrentYearSum;
                                        ThirdLVLAccount.CurrentYear_creditor += FourthLVLAccount.CurrentYear_creditor;
                                        ThirdLVLAccount.CurrentYear_debtor += FourthLVLAccount.CurrentYear_debtor;
                                        ThirdLVLAccount.FirstPastYearSum += FourthLVLAccount.FirstPastYearSum;
                                        ThirdLVLAccount.SecondPastYearSum += FourthLVLAccount.SecondPastYearSum;
                                        ThirdLVLAccount.ThirdPastYearSum += FourthLVLAccount.ThirdPastYearSum;
                                        ThirdLVLAccount.FourthPastYearSum += FourthLVLAccount.FourthPastYearSum;
                                    }

                                })

                                ClearanceIsAddedd = false;
                                if(ThirdLVLAccount.CurrentYearSum != 0 && ThirdLVLAccount.CurrentYearSum != null) {

                                    if(!ThirdLVLAccount.fourth_level_accounts.length){

                                        this.ClearanceCounter++;
                                        this.$set(ThirdLVLAccount,'ClearanceNumber',this.ClearanceCounter);
                                        this.$set(ThirdLVLAccount,'ShowProcedures',false);
                                        this.$set(ThirdLVLAccount,'ShowPolicies',false);
                                        this.$set(ThirdLVLAccount,'ShowInternational_measurement',false);
                                        this.$set(ThirdLVLAccount,'ShowAccounting_term',false);
                                        this.$set(ThirdLVLAccount,'ShowConsiderations',false);
                                        this.$set(ThirdLVLAccount,'ShowStudy',false);
                                        this.$set(ThirdLVLAccount,'ShowSecond_study',false);

                                        this.$set(ThirdLVLAccount,'ShowFirstPastYear',false);
                                        this.$set(ThirdLVLAccount,'ShowSecondPastYear',false);
                                        this.$set(ThirdLVLAccount,'ShowThirdPastYear',false);
                                        this.$set(ThirdLVLAccount,'ShowFourthPastYear',false);
                                    }
                                    // Add the sum of each third level account to the sum of parent account
                                    SecondLVLAccount.CurrentYearSum += ThirdLVLAccount.CurrentYearSum;
                                    SecondLVLAccount.CurrentYear_creditor += ThirdLVLAccount.CurrentYear_creditor;
                                    SecondLVLAccount.CurrentYear_debtor += ThirdLVLAccount.CurrentYear_debtor;
                                    SecondLVLAccount.FirstPastYearSum += ThirdLVLAccount.FirstPastYearSum;
                                    SecondLVLAccount.SecondPastYearSum += ThirdLVLAccount.SecondPastYearSum;
                                    SecondLVLAccount.ThirdPastYearSum += ThirdLVLAccount.ThirdPastYearSum;
                                    SecondLVLAccount.FourthPastYearSum += ThirdLVLAccount.FourthPastYearSum;
                                }

                            });

                            if(SecondLVLAccount.CurrentYearSum != 0 && SecondLVLAccount.CurrentYearSum != null) {
                                // if the second level doesn't have third accounts then it will take a ClearanceNumber
                                if(!SecondLVLAccount.third_level_accounts.length){

                                    this.$set(SecondLVLAccount,'ClearanceNumber',this.ClearanceCounter);
                                    this.ClearanceCounter++;
                                    this.$set(SecondLVLAccount,'ShowProcedures',false);
                                    this.$set(SecondLVLAccount,'ShowPolicies',false);
                                    this.$set(SecondLVLAccount,'ShowInternational_measurement',false);
                                    this.$set(SecondLVLAccount,'ShowAccounting_term',false);
                                    this.$set(SecondLVLAccount,'ShowConsiderations',false);
                                    this.$set(SecondLVLAccount,'ShowStudy',false);
                                    this.$set(SecondLVLAccount,'ShowSecond_study',false);

                                    this.$set(SecondLVLAccount,'ShowFirstPastYear',false);
                                    this.$set(SecondLVLAccount,'ShowSecondPastYear',false);
                                    this.$set(SecondLVLAccount,'ShowThirdPastYear',false);
                                    this.$set(SecondLVLAccount,'ShowFourthPastYear',false);
                                }
                                // Add the sum of each Second level account to the sum of parent account
                                FirstLVLAccount.CurrentYearSum += SecondLVLAccount.CurrentYearSum;
                                FirstLVLAccount.CurrentYear_creditor += SecondLVLAccount.CurrentYear_creditor;
                                FirstLVLAccount.CurrentYear_debtor += SecondLVLAccount.CurrentYear_debtor;
                                FirstLVLAccount.FirstPastYearSum += SecondLVLAccount.FirstPastYearSum;
                                FirstLVLAccount.SecondPastYearSum += SecondLVLAccount.SecondPastYearSum;
                                FirstLVLAccount.ThirdPastYearSum += SecondLVLAccount.ThirdPastYearSum;
                                FirstLVLAccount.FourthPastYearSum += SecondLVLAccount.FourthPastYearSum;
                            }
                        })
                    }
                })
                this.LoadingSpinner = false;
            },

            GetAccountStatements(Account){
                this.LoadingSpinner = true;
                axios.get(route('accounts.statements.index',[Account.id,this.Transaction.id,Account.level]))
                    .then(({data})=>{

                        this.$set(Account,'MonetaryItems',[]);
                        this.$set(Account,'FinalCredit',0);


                        data.statements.forEach(statement => {
                            if(statement.ReadDataOnly == 1){

                                this.$set(Account,'GotVueEditorDataFromStatement',true);
                                this.$set(Account,'ReadOnlyStatementID',statement.id);
                                Account.policies = statement.policy;
                                Account.consedrations = statement.consedrations;
                                Account.study = statement.study;
                                Account.second_study = statement.second_study;
                            }else{
                                Account.MonetaryItems.push(statement);
                                statement.current_year = (statement.edited_current_year_creditor-statement.edited_current_year_debtor)+(statement.current_year_creditor - statement.current_year_debtor);
                            }

                        });
                        this.LoadingSpinner = false;

                    }).catch((error)=>{
                        console.log(error);

                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300})
                });
            },

            GetFourthLevelAccountValues(Account,ParentThirdLVLAccount){
                this.LoadingSpinner = true;
                axios.get(route('accounts.statements.index',[Account.id,this.Transaction.id,Account.level]))
                    .then(({data})=>{

                        this.$set(Account,'MonetaryItems',[]);
                        this.$set(Account,'FinalCredit',0);

                        data.statements.forEach(statement => {
                            Account.MonetaryItems.push(statement);
                        });

                        ParentThirdLVLAccount.CurrentYearSum += parseInt( Account.CurrentYearSum ? Account.CurrentYearSum : 0);
                        ParentThirdLVLAccount.CurrentYearDebtorSum += parseInt(Account.CurrentYearDebtorSum ? Account.CurrentYearDebtorSum  : 0);
                        ParentThirdLVLAccount.CurrentYearCreditorSum += parseInt(Account.CurrentYearCreditorSum ? Account.CurrentYearCreditorSum : 0);
                        ParentThirdLVLAccount.edited_CurrentYearDebtorSum += parseInt(Account.edited_CurrentYearDebtorSum ? Account.edited_CurrentYearDebtorSum : 0);
                        ParentThirdLVLAccount.edited_CurrentYearCreditorSum += parseInt(Account.edited_CurrentYearCreditorSum ? Account.edited_CurrentYearCreditorSum : 0 );
                        this.LoadingSpinner = false;
                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300})
                });
            },
            GetFourthLevelAccountsStatementsOfThirdLevelAccount(ThirdLVLAccount){
                ThirdLVLAccount.CurrentYearSum = 0;
                ThirdLVLAccount.CurrentYearDebtorSum = 0;
                ThirdLVLAccount.CurrentYearCreditorSum = 0;
                ThirdLVLAccount.edited_CurrentYearDebtorSum = 0;
                ThirdLVLAccount.edited_CurrentYearCreditorSum = 0;

                this.GetThirdAccountReadOnlyStatement(ThirdLVLAccount);
                ThirdLVLAccount.fourth_level_accounts.forEach(FourthLVLAccount=>{
                    if (!FourthLVLAccount.MonetaryItems) {
                        this.GetFourthLevelAccountValues(FourthLVLAccount,ThirdLVLAccount);
                    }
                })
            },
            GetThirdAccountReadOnlyStatement(Account){
                this.LoadingSpinner = true;
                axios.get(route('accounts.statements.ReadDataOnly',[this.Transaction.id,Account.id,Account.level]))
                    .then(({data})=>{
                        if (data.VueEditorValues.length && data.VueEditorValues[0].ReadDataOnly == 1) {
                            this.$set(Account, 'GotVueEditorDataFromStatement', true);
                            this.$set(Account, 'ReadOnlyStatementID', data.VueEditorValues[0].id);
                            Account.policies = data.VueEditorValues[0].policy;
                            Account.consedrations = data.VueEditorValues[0].consedrations;
                            Account.study = data.VueEditorValues[0].study;
                            Account.second_study = data.VueEditorValues[0].second_study;
                        }
                        this.LoadingSpinner = false;
                    }).catch((error) => {
                    console.log(error);
                    this.$toast.error('.', 'حدث خطأ برجاء اعادة المحاولة', {timout: 300});
                });
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
            printHeading(accountID){
                this.LoadingSpinner = true;
                this.PrintingMood = true;

                const options = {
                    specs: [
                        'fullscreen=yes',
                        'titlebar=yes',
                        'scrollbars=no'

                    ],
                    styles: [
                        'https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css',
                    ]
                }

                setTimeout(() => this.$htmlToPaper(accountID+'print',options,()=>{
                    this.PrintingMood =false;
                    this.LoadingSpinner = false;

                }), 1000);


            },
            printFullScreen(){
                this.printFullScreenBoolean = true;
                this.Accounts.forEach(FirstLVLAccount => {

                    if(FirstLVLAccount.ClearanceNumber && !FirstLVLAccount.MonetaryItems){
                        this.GetAccountStatements(FirstLVLAccount);
                    }else{
                        FirstLVLAccount.second_level_accounts.forEach(SecondLVLAccount => {
                            if (SecondLVLAccount.ClearanceNumber && !SecondLVLAccount.MonetaryItems){
                                this.GetAccountStatements(SecondLVLAccount);
                            }
                            else{
                                SecondLVLAccount.third_level_accounts.forEach(ThirdLVLAccount => {
                                    if(ThirdLVLAccount.ClearanceNumber){

                                        if(ThirdLVLAccount.fourth_level_accounts.length){
                                            this.GetFourthLevelAccountsStatementsOfThirdLevelAccount(ThirdLVLAccount);
                                        }else{

                                            this.GetAccountStatements(ThirdLVLAccount);
                                        }
                                    }
                                })
                            }
                        })
                    }


                });
                this.LoadingSpinner  = true;
                this.printFullScreenBoolean = true;
                this.PrintingMood = true;

               if(this.$refs.FirstLVLClearances){
                   this.$refs.FirstLVLClearances[0].LoadingSpinner = true;
                   this.$refs.FirstLVLClearances[0].PrintingMood = true;
               }
               if(this.$refs.SecondLVLClearances){
                   this.$refs.SecondLVLClearances[0].LoadingSpinner = true;
                   this.$refs.SecondLVLClearances[0].PrintingMood = true;
               }
               if(this.$refs.ThirdLVLClearances){
                   this.$refs.ThirdLVLClearances[0].LoadingSpinner = true;
                   this.$refs.ThirdLVLClearances[0].PrintingMood = true;
               }
                const options = {
                    specs: [
                        'fullscreen=yes',
                        'titlebar=yes',
                        'scrollbars=no'
                    ],
                    styles: [
                        'https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css',
                    ]
                }

                setTimeout(() => this.$htmlToPaper('printHeading',options,()=>{
                    this.printFullScreenBoolean = false;
                    this.PrintingMood = false;
                    this.LoadingSpinner  = false;

                    if(this.$refs.FirstLVLClearances){
                        this.$refs.FirstLVLClearances[0].LoadingSpinner = false;
                        this.$refs.FirstLVLClearances[0].PrintingMood = false;
                    }
                    if(this.$refs.SecondLVLClearances){
                        this.$refs.SecondLVLClearances[0].PrintingMood = LoadingSpinner;
                        this.$refs.SecondLVLClearances[0].PrintingMood = false;
                    }
                    if(this.$refs.ThirdLVLClearances){
                        this.$refs.ThirdLVLClearances[0].PrintingMood = LoadingSpinner;
                        this.$refs.ThirdLVLClearances[0].PrintingMood = false;
                    }
                }), 2000);

            },
            formatValue(value) {
                if(value == null || value == 0 ){
                    return 0;
                }
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },

            UpdateValuesOfTextAreaOfThirdLVLStatementAfterEditingToStatement(ThirdLVLAcccount){
                this.LoadingSpinner = true;

                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('policy',ThirdLVLAcccount.policies);
                formData.append('considerations',ThirdLVLAcccount.considerations);
                formData.append('study',ThirdLVLAcccount.study);
                formData.append('second_study',ThirdLVLAcccount.second_study);
                axios.post(route('accounts.statements.update',ThirdLVLAcccount.ReadOnlyStatementID),formData)
                    .then( (res) => {
                        console.log(res);
                        this.LoadingSpinner = false;

                        this.$toast.success('.','تم التعديل بنجاح',{timout:300});
                    }).catch(error => {
                    console.log(error);
                    this.LoadingSpinner = false;

                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                })

            },
            SaveValuesOfTextAreaOfThirdLVLStatementAfterEditingToStatement(ThirdLVLAcccount){
                this.LoadingSpinner = true;
                const formData = new FormData();

                formData.append('third_level_account_id',ThirdLVLAcccount.id);
                formData.append('account_level',3);
                formData.append('policy',ThirdLVLAcccount.policies);
                formData.append('considerations',ThirdLVLAcccount.considerations);
                formData.append('study',ThirdLVLAcccount.study);
                formData.append('second_study',ThirdLVLAcccount.second_study);
                formData.append('ReadDataOnly',1);
                axios.post(route('accounts.statements.store',this.Transaction.id),formData)
                    .then( (res) => {
                        ThirdLVLAcccount.GotVueEditorDataFromStatement = true;
                        ThirdLVLAcccount.ReadOnlyStatementID = res.data.id;
                        this.$toast.success('.','تم التعديل بنجاح',{timout:300});
                        this.LoadingSpinner = false;

                    }).catch(error => {
                    console.log(error);
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    this.LoadingSpinner = false;

                })
            },

        }
    }
</script>

<style scoped>

</style>
