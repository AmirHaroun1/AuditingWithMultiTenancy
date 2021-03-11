<template>
    <div>
        <div v-if="!$parent.printFullScreenBoolean">
            <h3 class="text-center"><i @click.prevent="printHeading(Account.id)" class=" fa fa-print cursor-pointer" style="margin-left:15px;" ></i></h3>
        </div>
        <!------ policies -------->
        <div v-if="!PrintingMood">
            <h3 >إظهار السياسة</h3>
            <input type="checkbox" v-model="Account.ShowPolicies">
        </div>
        <div v-if="Account.ShowPolicies"  class="row mt-10 " style="direction:rtl;margin-top:20px">
            <div class="col-md-2">
                <h3>
                    السياسة :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">

                    <vue-editor :editorToolbar="customToolbar" v-model="Account.policies" ></vue-editor>
                </div>
                <h5 v-else v-html="Account.policies"></h5>
            </div>
        </div>
        <hr v-if="Account.policies || !PrintingMood">
        <!------ ./policies -------->
        <!------ considerations -------->
        <div v-if="!PrintingMood">
            <h3 >إظهار لفت انتباه</h3>
            <input type="checkbox" v-model="Account.ShowConsedrations">
        </div>
        <div v-if="Account.ShowConsedrations" class="row mt-20 " style="direction:rtl;margin-top:20px">

            <div class="col-md-2">
                <h3>
                    لفت انتباه :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">

                    <vue-editor :editorToolbar="customToolbar" v-model="Account.considerations" ></vue-editor>
                </div>
                <h5 v-else v-html="Account.considerations"></h5>
            </div>
        </div>
        <hr v-if="Account.consedrations || !PrintingMood">
        <!------ ./considerations -------->

        <!------- Table ------------->
        <div class="row text-center">
            <div class="col-md-2 text-center" v-for="i in 4" v-if="!PrintingMood">
                <h5>اظهار رصيد السنة السابقة {{i}}</h5>
                <input v-if="i == 1" class="text-center" type="checkbox" v-model="Account.ShowFirstPastYear">
                <input v-if="i == 2" class="text-center" type="checkbox" v-model="Account.ShowSecondPastYear">
                <input v-if="i == 3" class="text-center" type="checkbox" v-model="Account.ShowThirdPastYear">
                <input v-if="i == 4" class="text-center" type="checkbox" v-model="Account.ShowFourthPastYear">
            </div>
        </div>
        <br>

        <div class=" mt-20 " style="direction:rtl"  v-if="Account.MonetaryItems">
            <h3 class="mt-20">
                يتكون بند {{Account.name}}
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
                    <th class="text-center" rowspan="1" colspan="1" v-if="Account.ShowFirstPastYear">
                        الرصيد النهائي
                    </th>

                    <th class="text-center" rowspan="1" colspan="1" v-if="Account.ShowSecondPastYear" >
                        الرصيد النهائي
                    </th>
                    <th class="text-center" rowspan="1" colspan="1" v-if="Account.ShowThirdPastYear" >
                        الرصيد النهائي
                    </th>
                    <th class="text-center" rowspan="1" colspan="1" v-if="Account.ShowFourthPastYear" >
                        الرصيد النهائي
                    </th>


                </tr>
                <tr>
                    <th >مدين</th>
                    <th >دائن</th>

                    <th>مدين</th>
                    <th >دائن</th>

                    <th class="text-center">{{Transaction.end_financial_year}}</th>
                    <th class="text-center" v-if="Account.ShowFirstPastYear">{{Transaction.FirstPastYearDate}}</th>
                    <th class="text-center" v-if="Account.ShowSecondPastYear">{{Transaction.SecondPastYearDate}}</th>
                    <th class="text-center" v-if="Account.ShowThirdPastYear">{{Transaction.ThirdPastYearDate}}</th>
                    <th class="text-center" v-if="Account.ShowFourthPastYear">{{Transaction.FourthPastYearDate}}</th>

                    <th class="text-center">
                         5%
                     </th>
                     <th class="text-center">
                         10%
                     </th>
                </tr>
                </thead>
                <tbody >
                <tr v-for="(item,index) in Account.MonetaryItems" :key="item.id">

                    <td>
                        <h5>{{Account.ClearanceNumber + '.0'}}{{index+1}}</h5>
                    </td>
                    <td>
                        <h5>{{item.name}}</h5>
                    </td>

                    <td>
                        <h5 v-text="formatValue(item.current_year_debtor)"></h5>
                    </td>
                    <td>
                        <h5 v-text="formatValue(item.current_year_creditor)"></h5>
                    </td>
                    <td>
                        <h5 @click="$set(item,'EditCurrentYearDebtor', true)" v-text="formatValue(item.edited_current_year_debtor)"></h5>
                    </td>
                    <td>
                        <h5 @click="$set(item,'EditCurrentYearCreditor', true)" v-text="formatValue(item.edited_current_year_creditor)"></h5>
                    </td>

                    <td class="text-center">
                        <h5 v-text="formatValue(item.current_year)"></h5>
                    </td>
                    <td class="text-center" v-if="Account.ShowFirstPastYear">
                        <h5 v-text="formatValue(item.first_past_year)"></h5>
                    </td>
                    <td class="text-center" v-if="Account.ShowSecondPastYear">
                        <h5 v-text="formatValue(item.second_past_year)"></h5>
                    </td>
                    <td class="text-center" v-if="Account.ShowThirdPastYear">
                        <h5 v-text="formatValue(item.third_past_year)"></h5>
                    </td>
                    <td class="text-center" v-if="Account.ShowFourthPastYear">
                        <h5 v-text="formatValue(item.fourth_past_year)"></h5>
                    </td>

                    <td class="text-center">
                        <h5 v-text="formatValue((item.current_year * 0.05))"></h5>
                    </td>
                     <td class="text-center">
                        <h5 v-text="formatValue((item.current_year * 0.1))"></h5>
                    </td>

                </tr>
                <tr>
                    <td><h5>الرصيد آخر السنة</h5></td>
                    <td style="visibility: hidden"></td>

                    <td>
                        <h5 v-text="formatValue(Account.CurrentYearDebtorSum)"> </h5>
                    </td>
                    <td>
                        <h5 v-text="formatValue(Account.CurrentYearCreditorSum)"> </h5>
                    </td>

                    <td >
                        <h5 v-text="formatValue(Account.edited_CurrentYearDebtorSum)"> </h5>
                    </td>

                    <td >
                        <h5 v-text="formatValue(Account.edited_CurrentYearCreditorSum)"> </h5>
                    </td>

                    <td >
                        <h5 class="text-center" v-text="formatValue(Account.CurrentYearSum)"> </h5>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!------- ./Table ------------->

        <!------ Study -------->
        <div v-if="!PrintingMood">
            <h3 >إظهار الدراسة</h3>
            <input type="checkbox" v-model="Account.ShowStudy">
        </div>
        <div v-if="Account.ShowStudy" class="row mt-10 " style="direction:rtl;margin-top:20px">
            <div class="col-md-2">
                <h3>
                    الدراسة :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">

                    <vue-editor :editorToolbar="customToolbar" v-model="Account.study" ></vue-editor>
                </div>
                <h5 v-else v-html="Account.study"></h5>
            </div>
        </div>

        <hr v-if="Account.study || !PrintingMood">

        <div v-if="!PrintingMood">
            <h3 >إظهار الدراسة الثانية</h3>
            <input type="checkbox" v-model="Account.ShowSecond_study">
        </div>
        <div v-if="Account.ShowSecond_study" class="row mt-10 " style="direction:rtl;margin-top:20px">
            <div class="col-md-2">
                <h3>
                    الدراسة الثانية :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">

                    <vue-editor :editorToolbar="customToolbar" v-model="Account.second_study" ></vue-editor>
                </div>
                <h5 v-else v-html="Account.second_study"></h5>
            </div>
        </div>
        <hr v-if="Account.second_study || !PrintingMood">
        <!------ ./Study -------->
        <!------ procedures ------>
        <div v-if="!PrintingMood">
            <h3 >إظهار اجرائات المراجعة</h3>
            <input type="checkbox" v-model="Account.ShowProcedures">
        </div>
        <div v-if="Account.ShowProcedures" class="row mt-20 " style="direction:rtl;margin-top:20px">

            <div class="col-md-2">
                <h3>
                    اجرائات المراجعة :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">

                    <vue-editor :editorToolbar="customToolbar" v-model="Account.procedures" ></vue-editor>
                </div>
                <h5 v-else v-html="Account.procedures"></h5>
            </div>
        </div>
        <hr v-if="Account.procedures || !PrintingMood">
        <!------ ./procedures ------>
        <!------ international Measurement ----->
        <div v-if="!PrintingMood">
            <h3 >إظهار المعيار الدولي</h3>
            <input type="checkbox" v-model="Account.ShowInternational_measurement">
        </div>
        <div v-if="Account.ShowInternational_measurement" class="row mt-20 " style="direction:rtl;margin-top:20px">

            <div class="col-md-2">
                <h3>
                    المعيار الدولي :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">
                    <vue-editor :editorToolbar="customToolbar" v-model="Account.international_measurement" ></vue-editor>
                </div>
                <h5 v-else v-html="Account.international_measurement"></h5>
            </div>
        </div>
        <hr v-if="Account.international_measurement || !PrintingMood">
        <!------ ./international Measurement ----->
        <!------ Accounting Term ----->
        <div v-if="!PrintingMood">
            <h3 >إظهار التعريف المحاسبي</h3>
            <input type="checkbox" v-model="Account.ShowAccounting_term">
        </div>
        <div v-if="Account.Account" class="row mt-20 " style="direction:rtl;margin-top:20px">

            <div class="col-md-2">
                <h3>
                    التعريف المحاسبي :
                </h3>
            </div>
            <div class="col-md-8">
                <div v-if="!PrintingMood">
                    <vue-editor :editorToolbar="customToolbar" v-model="Account.accounting_term" ></vue-editor>
                </div>

                <h5 v-else v-html="Account.accounting_term"></h5>
            </div>
        </div>
        <hr v-if="Account.accounting_term || !PrintingMood">
        <!------ ./Accounting Term ----->
        <!------ Save Button ----->
        <div v-if="!PrintingMood " class="text-center">
            <button @click="Account.GotVueEditorDataFromStatement ? UpdateValuesOfTextAreaAfterEditingToStatement(Account) : SaveValuesOfTextAreaAfterEditingToStatement(Account) " v-if="Account.ShowPolicies || Account.ShowConsiderations || Account.ShowStudy || Account.ShowSecond_study " class=" btn btn-success btn-lg mt-20">حفظ</button>
        </div>
        <!------ ./Save Button ----->

    </div>
</template>

<script>
    export default {
        name: "ClearanceTable",
        props:{
            'Account':'',
            'Transaction':'',
        },
        data(){
            return{
                'LoadingSpinner' : false,
                'PrintingMood' : false,
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
                ArabicMonths:[{'Number':1,'Name':'يناير'},{'Number':2,'Name':'فبراير'},{'Number':3,'Name':'مارس'},{'Number':4,'Name':'أبريل'},{'Number':5,'Name':'مايو'},{'Number':6,'Name':'يونيو'},{'Number':7,'Name':'يوليو'},{'Number':8,'Name':'أغسطس'},{'Number':9,'Name':'سبتمبر'},{'Number':10,'Name':'أكتوبر'},{'Number':11,'Name':'نوفمبر'},{'Number':12,'Name':'ديسمبر'}]

            }
        },
        methods : {

            formatValue(value) {
                if(value == null || value == 0 ){
                    return 0;
                }
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
            SaveValuesOfTextAreaAfterEditingToStatement(Account){
                this.LoadingSpinner = true;

                const formData = new FormData();
                if(Account.level == 1 ){
                    formData.append('first_level_account_id',Account.id);
                }else if(Account.level == 2 ){
                    formData.append('second_level_account_id',Account.id);
                }else if(Account.level == 3 ){
                    formData.append('third_level_account_id',Account.id);
                }
                formData.append('account_level',Account.level);
                formData.append('policy',Account.policies);
                formData.append('considerations',Account.considerations);
                formData.append('study',Account.study);
                formData.append('second_study',Account.second_study);
                formData.append('ReadDataOnly',1);
                axios.post(route('accounts.statements.store',this.Transaction.id),formData)
                    .then( (res) => {
                        this.LoadingSpinner = false;
                        Account.GotVueEditorDataFromStatement = true;
                        Account.ReadOnlyStatementID = res.data.id;
                        this.$toast.success('.','تم التعديل بنجاح',{timout:300});
                    }).catch(error => {
                    console.log(error);
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    this.LoadingSpinner = false;
                })
            },
            UpdateValuesOfTextAreaAfterEditingToStatement(Account){
                this.LoadingSpinner = true;
                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('policy',Account.policies);
                formData.append('considerations',Account.considerations);
                formData.append('study',Account.study);
                formData.append('second_study',Account.second_study);
                axios.post(route('accounts.statements.update',Account.ReadOnlyStatementID),formData)
                    .then( (res) => {
                        console.log(res);
                        this.$toast.success('.','تم التعديل بنجاح',{timout:300});
                        this.LoadingSpinner = false;

                    }).catch(error => {
                    console.log(error);
                    this.$toast.error('.','حدث خطأ برجاء اعادة المحاولة',{timout:300});
                    this.LoadingSpinner = false;

                })

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
                        ,
                    ]
                }

                setTimeout(() => this.$htmlToPaper(accountID+'print',options,()=>{
                    this.PrintingMood =false;
                    this.LoadingSpinner = false;

                }), 1000);


            },

        }
    }
</script>

<style scoped>

</style>
