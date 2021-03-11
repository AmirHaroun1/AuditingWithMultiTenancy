<template>
    <div class="container box mt-20">
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="row">
            <div class="box-header">
                <div class="col-md-6">

                    <h2>القوائم المالية</h2>
                </div>
                <div class="col-md-3">
                    <button class="p-10 border-none fa fa-print mt-20 bg-green text-white" @click="DownloadExcel()"> تصدير إكسل </button>
                </div>
                <div class="col-md-3 mt-20">
                    <h4 class="pull-left" data-toggle="collapse" href="#ShowingOptions" role="button" aria-expanded="false" aria-controls="ShowingOptions"><i class="fa fa-gears cursor-pointer"></i> </h4>
                </div>
                <div class="col-md-12 mt-20 collapse " id="ShowingOptions" >
                    <div class="row">

                        <div class="col-md-3">
                            <label>رصيد السنة السابقة 1</label>
                            <input type="checkbox" v-model="ShowFirstPastYear">
                        </div>
                        <div class="col-md-3">
                            <label>رصيد السنة السابقة 2</label>
                            <input type="checkbox" v-model="ShowSecondPastYear">
                        </div>
                        <div class="col-md-3">
                            <label>رصيد السنة السابقة 3</label>
                            <input type="checkbox" v-model="ShowThirdPastYear">
                        </div>
                        <div class="col-md-3">
                            <label>رصيد السنة السابقة 4</label>
                            <input type="checkbox" v-model="ShowFourthPastYear">
                        </div>
                    </div>

                </div>
                <div class="col-md-12">

                    <hr>
                </div>
            </div>
            <div class="box-body" id="printHeading">

                <div class="row " style="direction:rtl">
                    <div class="col-md-3 col-sm-3"><h5>الأسم</h5></div>

                    <div class="col-md-1 col-sm-1"><h5>إيضاح</h5></div>


                    <div class="col-md-1 col-sm-1"><h5>رصيد {{Transaction.financial_year}}</h5></div>
                    <div class="col-md-1 col-sm-1" v-if="ShowFirstPastYear"><h5>رصيد {{Transaction.financial_year-1}}</h5></div>
                    <div class="col-md-1 col-sm-1" v-else-if="ShowSecondPastYear"><h4>رصيد {{Transaction.financial_year-2}}</h4></div>
                    <div class="col-md-1 col-sm-1" v-else-if="ShowThirdPastYear"><h4>رصيد {{Transaction.financial_year-3}}</h4></div>
                    <div class="col-md-1 col-sm-1" v-else-if="ShowFourthPastYear"><h4>رصيد {{Transaction.financial_year-4}}</h4></div>

                    <div class="col-md-1 col-sm-1"><h5>5%</h5></div>
                    <div class="col-md-1 col-sm-1"><h5>10%</h5></div>
                    <div class="col-md-4"> <h5 class="text-center justify-content-center">تحديد الأهمية النسبية لأغراض العرض والإفصاح لمجموعات القوائم المالية</h5></div>
                </div>
                <div class="row mt-20 " style="direction:rtl">
                    <!--------- Name ----------->
                    <div class="col-md-3 col-sm-3">

                        <h5 class="mt-20" v-for="(account,FirstLVLIndex) in Accounts">

                            {{account.name}}
                            <h5  class="mt-20 mr-5" v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">
                                {{secondLvLAccount.name}}

                                <h5 class="mt-20 mr-10" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">
                                    {{ThirdLvLAccount.name}}
                                </h5>
                                <!---- if last element in Second Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length" >
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">
                                   <h5 class="mt-20" >
                                       مجموع
                                       {{secondLvLAccount.name}}
                                   </h5>
                                </div>
                                <!---- ./if last element in Second Level ----->
                            </h5>
                            <!---- if last element in Second Level ----->
                            <div  v-if="account.second_level_accounts.length" >
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                <h5 class="mt-20" >
                                    مجموع
                                    {{account.name}}
                                </h5>
                            </div>
                            <!---- ./if last element in Second Level ----->
                        </h5>
                    </div>
                    <!--------- ./Name ----------->
                    <!--------- Clearance ----------->
                    <div class="col-md-1 col-sm-1">
                        <h5 class="mt-20" v-for="account in Accounts">
                                <div>
                                    <p v-if="account.ClearanceNumber">
                                        {{account.ClearanceNumber}}

                                    </p>
                                    <p v-else>
                                        -
                                    </p>
                                </div>

                            <h5 class="mt-20" v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">

                                <p class="mt-20" v-if="secondLvLAccount.ClearanceNumber">{{secondLvLAccount.ClearanceNumber}}
                                <p class="mt-20" v-else>-</p>

                                <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">
                                    <p class="mt-20" v-if="ThirdLvLAccount.ClearanceNumber">{{ThirdLvLAccount.ClearanceNumber}}
                                    <p class="mt-20" v-else>-</p>
                                </h5>
                                 <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <h5 class="mt-30" >
                                        -
                                    </h5>
                                </div>

                                <!---- ./if last element in third Level ----->

                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <h5 class="mt-30" >
                                    -
                                </h5>
                            </div>
                            <!---- ./if last element in Second Level ----->

                        </h5>

                    </div>
                    <!--------- ./Clearance ----------->
                    <!--------- Current Year  ----------->
                    <div class="col-md-1 col-sm-1">


                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                <p v-if="account.ClearanceNumber" v-text="formatValue(account.CurrentYearSum)">
                                </p>
                                <p v-else>
                                    -
                                </p>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">

                                -
                                    <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">

                                        <p class="mt-20" v-if="ThirdLvLAccount.CurrentYearSum" v-text="formatValue(ThirdLvLAccount.CurrentYearSum)"></p>
                                        <p class="mt-20" v-else>-</p>


                                    </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                    <h5 class="mt-20 " v-if="secondLvLAccount.CurrentYearSum"  v-text="formatValue(secondLvLAccount.CurrentYearSum)">


                                    </h5>
                                    <h5 class="mt-20" v-else>
                                        -
                                    </h5>
                                </div>

                                <!---- ./if last element in third Level ----->

                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                <h5 class="mt-20" v-if="account.CurrentYearSum" v-text="formatValue(account.CurrentYearSum)"  >

                                </h5>
                                <h5 class="mt-20" v-else>
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>


                    </div>
                    <!--------- ./Current Year  ----------->

                    <!--------- FirstPast Year  ----------->
                    <div class="col-md-1 col-sm-1" v-if="ShowFirstPastYear">


                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                <p v-if="account.ClearanceNumber" v-text="formatValue(account.FirstPastYearSum)"  >
                                </p>
                                <p v-else>
                                    -
                                </p>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">

                                -
                                    <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">

                                        <p class="mt-20" v-if="ThirdLvLAccount.FirstPastYearSum" v-text="formatValue(ThirdLvLAccount.FirstPastYearSum)"></p>
                                        <p class="mt-20" v-else>-</p>


                                    </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                    <h5 class="mt-20 " v-if="secondLvLAccount.FirstPastYearSum" v-text="formatValue(secondLvLAccount.FirstPastYearSum)" >
                                    </h5>
                                    <h5 class="mt-20" v-else>
                                        -
                                    </h5>
                                </div>

                                <!---- ./if last element in third Level ----->

                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                <h5 class="mt-20" v-if="account.FirstPastYearSum" v-text="formatValue(account.FirstPastYearSum)" >

                                </h5>
                                <h5 class="mt-20" v-else>
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>


                    </div>
                    <!--------- ./FirstPast Year  ----------->

                    <!--------- SecondPast Year  ----------->
                    <div class="col-md-1 col-sm-1" v-else-if="ShowSecondPastYear">
                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                <p v-if="account.ClearanceNumber" v-text="formatValue(account.SecondPastYearSum)">

                                </p>
                                <p v-else>
                                    -
                                </p>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">

                                -
                                    <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">

                                        <p class="mt-20" v-if="ThirdLvLAccount.SecondPastYearSum" v-text="formatValue(ThirdLvLAccount.SecondPastYearSum)"></p>
                                        <p class="mt-20" v-else>-</p>


                                    </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                    <h5 class="mt-20 " v-if="secondLvLAccount.SecondPastYearSum" v-text="formatValue(secondLvLAccount.SecondPastYearSum)" >

                                    </h5>
                                    <h5 class="mt-20" v-else>
                                        -
                                    </h5>
                                </div>

                                <!---- ./if last element in third Level ----->

                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                <h5 class="mt-20" v-if="account.SecondPastYearSum" v-text="formatValue(account.SecondPastYearSum)"  >

                                </h5>
                                <h5 class="mt-20" v-else>
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>


                    </div>
                    <!--------- ./SecondPast Year  ----------->
                    <!--------- ThirdPast Year  ----------->
                    <div class="col-md-1 col-sm-1" v-else-if="ShowThirdPastYear">

                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                <p v-if="account.ClearanceNumber" v-text="account.ThirdPastYearSum">
                                </p>
                                <p v-else>
                                    -
                                </p>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">
                                -
                                    <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">
                                        <p class="mt-20" v-if="ThirdLvLAccount.ThirdPastYearSum" v-text="ThirdLvLAccount.ThirdPastYearSum"></p>
                                        <p class="mt-20" v-else>-</p>
                                    </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                    <h5 class="mt-20 " v-if="secondLvLAccount.ThirdPastYearSum"  v-text="secondLvLAccount.ThirdPastYearSum" >

                                    </h5>
                                    <h5 class="mt-20" v-else>
                                        -
                                    </h5>
                                </div>

                                <!---- ./if last element in third Level ----->

                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                <h5 class="mt-20" v-if="account.ThirdPastYearSum" v-text="account.ThirdPastYearSum" >
                                </h5>
                                <h5 class="mt-20" v-else>
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->
                        </h5>


                    </div>
                    <!--------- ./ThirdPast Year  ----------->
                    <!--------- Fourth Year  ----------->
                    <div class="col-md-1 col-sm-1" v-else-if="ShowFourthPastYear">
                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                <p v-if="account.ClearanceNumber">
                                    {{account.FourthPastYearSum}}
                                </p>
                                <p v-else>
                                    -
                                </p>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">
                                -
                                    <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">

                                        <p class="mt-20" v-if="ThirdLvLAccount.FourthPastYearSum" v-text="ThirdLvLAccount.FourthPastYearSum"></p>
                                        <p class="mt-20" v-else>-</p>


                                    </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                    <h5 class="mt-20 " v-if="secondLvLAccount.FourthPastYearSum" v-text="secondLvLAccount.FourthPastYearSum" >

                                    </h5>
                                    <h5 class="mt-20" v-else>
                                        -
                                    </h5>
                                </div>
                                <!---- ./if last element in third Level ----->
                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">


                                <h5 class="mt-20" v-if="account.FourthPastYearSum" v-text="account.FourthPastYearSum" >
                                </h5>
                                <h5 class="mt-20" v-else>
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>


                    </div>
                    <!--------- ./FourthPast Year  ----------->
                    <!---------- 5% column ------------>
                    <div class="col-md-1 col-sm-1">
                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                    <h5 class="mt-20">-</h5>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">
                                <p v-if="!secondLvLAccount.ClearanceNumber" v-text="formatValue(secondLvLAccount.CurrentYearSum * 0.05)"></p>
                                <p v-else>-</p>
                                <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">

                                    -
                                </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                    <h5 class="mt-20" >
                                        -
                                    </h5>
                                </div>
                                <!---- ./if last element in third Level ----->
                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                <h5 class="mt-20">
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>
                    </div>
                    <!---------- ./5% column ------------>
                    <!---------- 10% column ------------>
                    <div class="col-md-1 col-sm-1">
                        <h5 class="mt-20" v-for="account in Accounts">
                            <div>
                                    <h5 class="mt-20">-</h5>
                            </div>
                            <h5 class="mt-20 " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">
                                <p v-if="!secondLvLAccount.ClearanceNumber" v-text="formatValue(secondLvLAccount.CurrentYearSum * 0.1)"></p>
                                <p v-else>-</p>

                                <h5 class="mt-20" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">

                                    -
                                </h5>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                    <h5 class="mt-20" >
                                        -
                                    </h5>
                                </div>
                                <!---- ./if last element in third Level ----->
                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                <h5 class="mt-20">
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>
                    </div>
                    <!---------- ./10% column ------------>
                    <!---------- RelativeImportance column ------------>
                    <div class="col-md-4 col-sm-4">
                        <h5 class="mt-20 text-center justify-content-center" v-for="account in Accounts">
                            <div>
                                    <h5 class="mt-20 text-center">-</h5>
                            </div>
                            <h5 class="mt-20 text-center " v-for="(secondLvLAccount,secondLVLIndex) in account.second_level_accounts">
                                -

                                <h6 v-if="secondLvLAccount.CurrentYearSum !=0 && secondLvLAccount.CurrentYearSum !=null" style="margin-top:22px" class="text-center" v-for="(ThirdLvLAccount,ThirdLVLIndex) in secondLvLAccount.third_level_accounts">
                                    <p  v-if="ThirdLvLAccount.CurrentYearSum >= (secondLvLAccount.CurrentYearSum*0.1) " class="text-green"> يتعين عرضها والافصاح عنها</p>
                                    <p  v-else-if="ThirdLvLAccount.CurrentYearSum >= (secondLvLAccount.CurrentYearSum*0.05) && ThirdLvLAccount.CurrentYearSum < (secondLvLAccount.CurrentYearSum*0.1)">يخضع للتقدير المهني في العرض والافصاح عنة بصدر القوائم المالية </p>
                                    <p  v-else-if="ThirdLvLAccount.CurrentYearSum < (secondLvLAccount.CurrentYearSum*0.05)">يجب عرض البند داخل احد الإيضاحات ولا يعرض بصدر القوائم المالية الافى حالة التوجية من صاحب الصلاحية</p>
                                </h6>
                                <h6  v-else  style="margin-top:22px" class="text-center">-</h6>
                                <!---- if last element in third Level ----->
                                <div v-if="secondLvLAccount.third_level_accounts.length">
                                    <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                    <h5 class="mt-20 text-center" >
                                        -
                                    </h5>
                                </div>
                                <!---- ./if last element in third Level ----->
                            </h5>
                            <!---- if last element in Second Level ----->
                            <div v-if="account.second_level_accounts.length">
                                <hr class="mt-10 mb-10" style="height: 0px;border: none;border-top: 1px solid black;">

                                <h5 class="mt-20 text-center">
                                    -
                                </h5>
                            </div>

                            <!---- ./if last element in Second Level ----->

                        </h5>
                    </div>
                    <!---------- ./RelativeImportance column ------------>
                </div>

            </div>

            <div class="text-center mt-20 col-md-12 hidden-excel"  >

                <vue-excel-editor ref="grid"   v-model="ExcelAccounts"  >

                    <vue-excel-column field="RelativeImportance"  label= "تحديد الأهمية النسبية لأغراض العرض والإفصاح لمجموعات القوائم المالية" />
                    <vue-excel-column field="TenPercent"  label= "10%" />
                    <vue-excel-column field="FivePercent"  label= "5%" />
                    <vue-excel-column field="FourthPastYearSum"  :label= "  'رصيد' + (Transaction.financial_year-4) " />
                    <vue-excel-column field="ThirdPastYearSum"  :label= "  'رصيد' + (Transaction.financial_year-3) " />
                    <vue-excel-column field="SecondPastYearSum"  :label= "  'رصيد' + (Transaction.financial_year-2) " />
                    <vue-excel-column field="FirstPastYearSum"  :label= "  'رصيد' + (Transaction.financial_year-1) " />
                    <vue-excel-column field="CurrentYearSum"   :label=" 'رصيد' + (Transaction.financial_year) " />
                    <vue-excel-column field="ClearanceNumber"   label="إيضاح" />
                    <vue-excel-column field="Name"   label="الأسم" />

                </vue-excel-editor>

            </div>

        </div>
    </div>

</template>

<script>
    export default {
        name: "TransactionFinancialStatements",
        props:{
            'Transaction':'',
        },
        data(){
            return{
                LoadingSpinner:'',

                Accounts:[],

                ViewTableAccouts:[],
                ExcelAccounts:[],
                ClearanceCounter:0,
                PrintingMood : false,
                ShowFirstPastYear:true,
                ShowSecondPastYear:false,
                ShowThirdPastYear:false,
                ShowFourthPastYear:false,
            }
        },
        created() {
            this.GetSumOfAccountsOfTransaction(route('accounts.statements.sum',this.Transaction));
        },
        methods:{

            GetSumOfAccountsOfTransaction(endpoint){
                this.LoadingSpinner = true;

                axios.get(endpoint)
                    .then(({data})=>{
                        console.log(data);
                            this.Accounts.push(...data.AccountStatementsWithSum);
                            this.LoadingSpinner = false;
                            this.SetClearanceCounter();

                    }).catch((error)=>{
                        console.log(error);
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    this.LoadingSpinner = false;

                });


            },

            SetClearanceCounter(){
                this.LoadingSpinner = true;
                let ClearanceIsAddedd = false;
                this.Accounts.forEach(FirstLVLAccount =>{

                    if(FirstLVLAccount.CurrentYearSum != 0 &&FirstLVLAccount.CurrentYearSum != null && !FirstLVLAccount.second_level_accounts.length){
                        this.ClearanceCounter++;
                        this.$set(FirstLVLAccount,'ClearanceNumber',this.ClearanceCounter);
                        // filling Excel Account
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
                                        }
                                        // Add the sum of each fourth level account to the sum of parent account
                                        ThirdLVLAccount.CurrentYearSum += FourthLVLAccount.CurrentYearSum;
                                        ThirdLVLAccount.FirstPastYearSum += FourthLVLAccount.FirstPastYearSum;
                                        ThirdLVLAccount.SecondPastYearSum += FourthLVLAccount.SecondPastYearSum;
                                        ThirdLVLAccount.ThirdPastYearSum += FourthLVLAccount.ThirdPastYearSum;
                                        ThirdLVLAccount.FourthPastYearSum += FourthLVLAccount.FourthPastYearSum;

                                        // filling Excel Account
                                    }
                                })
                                ClearanceIsAddedd = false;
                                if(ThirdLVLAccount.CurrentYearSum != 0 && ThirdLVLAccount.CurrentYearSum != null) {

                                    if(!ThirdLVLAccount.fourth_level_accounts.length){

                                        console.log(ThirdLVLAccount.name + ThirdLVLAccount.CurrentYearSum);
                                        this.ClearanceCounter++;
                                        this.$set(ThirdLVLAccount,'ClearanceNumber',this.ClearanceCounter);

                                    }
                                    // Add the sum of each third level account to the sum of parent account
                                    SecondLVLAccount.CurrentYearSum += ThirdLVLAccount.CurrentYearSum;
                                    SecondLVLAccount.FirstPastYearSum += ThirdLVLAccount.FirstPastYearSum;
                                    SecondLVLAccount.SecondPastYearSum += ThirdLVLAccount.SecondPastYearSum;
                                    SecondLVLAccount.ThirdPastYearSum += ThirdLVLAccount.ThirdPastYearSum;
                                    SecondLVLAccount.FourthPastYearSum += ThirdLVLAccount.FourthPastYearSum;
                                }
                            });

                            if(SecondLVLAccount.CurrentYearSum != 0 && SecondLVLAccount.CurrentYearSum != null) {
                                // if the second level doesn't have third accounts then it will take a ClearanceNumber
                                if(!SecondLVLAccount.third_level_accounts.length){

                                    this.ClearanceCounter++;
                                    this.$set(SecondLVLAccount,'ClearanceNumber',this.ClearanceCounter);

                                }
                                // Add the sum of each Second level account to the sum of parent account
                                FirstLVLAccount.CurrentYearSum += SecondLVLAccount.CurrentYearSum;
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
            printHeading(){
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
                setTimeout(() => this.$htmlToPaper('printHeading',options,()=>{
                    this.PrintingMood =false;
                    this.LoadingSpinner = false;

                }), 1000);


            },

            DownloadExcel(){
                const format = 'xlsx';
                const exportSelectedOnly = false;
                const filename = 'القوائم المالية';

                if(this.ExcelAccounts.length == 0){

                    this.PrepareForExcel();
                    this.LoadingSpinner = true;
                    var that = this;
                    setTimeout(function() {

                        that.$refs.grid.exportTable(format, exportSelectedOnly, filename);
                        that.LoadingSpinner = false;

                    }, 5000);

                }
                else{

                    this.$refs.grid.exportTable(format, exportSelectedOnly, filename);

                }


            },
            PrepareForExcel(){

                    this.Accounts.forEach(FirstLVLAccount=>{

                        if(FirstLVLAccount.ClearanceNumber){

                            this.ExcelAccounts.push({
                                'Name':FirstLVLAccount.name,
                                'ClearanceNumber':FirstLVLAccount.ClearanceNumber,
                                'CurrentYearSum':FirstLVLAccount.CurrentYearSum,
                                'FirstPastYearSum':FirstLVLAccount.FirstPastYearSum,
                                'SecondPastYearSum':FirstLVLAccount.SecondPastYearSum,
                                'ThirdPastYearSum':FirstLVLAccount.ThirdPastYearSum,
                                'FourthPastYearSum':FirstLVLAccount.FourthPastYearSum,
                                'FivePercent':'-',
                                'TenPercent':'-',
                                'RelativeImportance':'-',
                            });

                        }else{

                            if(FirstLVLAccount.CurrentYearSum   ){
                                this.ExcelAccounts.push({
                                    'Name':FirstLVLAccount.name,
                                    'ClearanceNumber':'-',
                                    'CurrentYearSum':'-',
                                    'FirstPastYearSum':'-',
                                    'SecondPastYearSum':'-',
                                    'ThirdPastYearSum':'-',
                                    'FourthPastYearSum':'-',
                                    'FivePercent':'-',
                                    'TenPercent':'-',
                                    'RelativeImportance':'-',
                                });
                            }


                            FirstLVLAccount.second_level_accounts.forEach(SecondLVLAccount => {

                                if(SecondLVLAccount.ClearanceNumber){
                                    this.ExcelAccounts.push({ 'Name':SecondLVLAccount.name,'ClearanceNumber':SecondLVLAccount.ClearanceNumber,'CurrentYearSum':SecondLVLAccount.CurrentYearSum,'FirstPastYearSum':SecondLVLAccount.FirstPastYearSum,'SecondPastYearSum':SecondLVLAccount.SecondPastYearSum,'ThirdPastYearSum':SecondLVLAccount.ThirdPastYearSum,'FourthPastYearSum':SecondLVLAccount.FourthPastYearSum
                                        ,'FivePercent':'-'
                                        ,'TenPercent':'-'
                                        , 'RelativeImportance':'-'
                                    });
                                }else{
                                    this.ExcelAccounts.push({ 'Name':SecondLVLAccount.name,'ClearanceNumber':'-','CurrentYearSum':'-','FirstPastYearSum':'-','SecondPastYearSum':'-','ThirdPastYearSum':'-','FourthPastYearSum':'-'  ,'FivePercent':(SecondLVLAccount.CurrentYearSum*0.05)
                                        ,'TenPercent':(SecondLVLAccount.CurrentYearSum*0.1)
                                        , 'RelativeImportance':'-'});

                                    SecondLVLAccount.third_level_accounts.forEach(ThirdLVLAccount => {
                                        let RelativeImportance = '';
                                        if(ThirdLVLAccount.CurrentYearSum >= (SecondLVLAccount.CurrentYearSum*0.1) ){
                                            RelativeImportance = ' يتعين عرضها والافصاح عنها';
                                        }else if(ThirdLVLAccount.CurrentYearSum >= (SecondLVLAccount.CurrentYearSum*0.05) && ThirdLVLAccount.CurrentYearSum < (SecondLVLAccount.CurrentYearSum*0.1)){
                                            RelativeImportance = 'يخضع للتقدير المهني في العرض والافصاح عنة بصدر القوائم المالية';
                                        }else if(ThirdLVLAccount.CurrentYearSum < (SecondLVLAccount.CurrentYearSum*0.05)){
                                            RelativeImportance = 'يجب عرض البند داخل احد الإيضاحات ولا يعرض بصدر القوائم المالية الافى حالة التوجية من صاحب الصلاحية';
                                        }
                                        if(ThirdLVLAccount.ClearanceNumber){
                                            this.ExcelAccounts.push({ 'Name':ThirdLVLAccount.name,'ClearanceNumber':ThirdLVLAccount.ClearanceNumber,'CurrentYearSum':ThirdLVLAccount.CurrentYearSum,'FirstPastYearSum':ThirdLVLAccount.FirstPastYearSum,'SecondPastYearSum':ThirdLVLAccount.SecondPastYearSum,'ThirdPastYearSum':ThirdLVLAccount.ThirdPastYearSum,'FourthPastYearSum':ThirdLVLAccount.FourthPastYearSum,'FivePercent':'-','TenPercent':'-'
                                                ,'RelativeImportance':RelativeImportance});

                                        }

                                    });
                                    // Add Elmagmo3 of the Second LVL Account

                                    this.ExcelAccounts.push({ 'Name':' مجموع '+SecondLVLAccount.name,'ClearanceNumber':'-','CurrentYearSum':SecondLVLAccount.CurrentYearSum,'FirstPastYearSum':SecondLVLAccount.FirstPastYearSum,'SecondPastYearSum':SecondLVLAccount.SecondPastYearSum,'ThirdPastYearSum':SecondLVLAccount.ThirdPastYearSum,'FourthPastYearSum':SecondLVLAccount.FourthPastYearSum});

                                    // END ---- Add Elmagmo3 of the Second LVL Account


                                }

                            })
                            // Add Elmagmo3 of the First LVL Account
                            if(FirstLVLAccount.CurrentYearSum   ) {

                                this.ExcelAccounts.push({
                                    'Name': ' مجموع '+FirstLVLAccount.name ,
                                    'ClearanceNumber': '-',
                                    'CurrentYearSum': FirstLVLAccount.CurrentYearSum,
                                    'FirstPastYearSum': FirstLVLAccount.FirstPastYearSum,
                                    'SecondPastYearSum': FirstLVLAccount.SecondPastYearSum,
                                    'ThirdPastYearSum': FirstLVLAccount.ThirdPastYearSum,
                                    'FourthPastYearSum': FirstLVLAccount.FourthPastYearSum
                                });
                            }
                            // END ---- Add Elmagmo3 of the First LVL Account


                        }

                    });




            },
            formatValue(value) {
                if(value == null || value == 0 ){
                    return 0;
                }
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
        }
    }

</script>

<style scoped>

</style>
