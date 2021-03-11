<template>
    <div class="container box" style="margin-top: 20px">

        <div class="row">
            <div class="box-header">
                <h2>بيانات المعاملة</h2>
            </div>
            <div class="box-body">
                <form id="EditTransactionForm" class="form-group" @submit.prevent="UpdateMainRegister()">
                <!-- Edit TransAction Form Content ------>
                    <!------ رقم السجل ------>

                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px" >
                            <label class="float-right">رقم السجل الرئيسي</label>
                            <input  v-model="MainTradeRegister.number" type="number" class="form-control" required>

                            <div v-if=" ValidationErrors.number && MainRegisterError==true "   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.number[0] }}
                                </h4>
                                <div v-if=" ValidationErrors.EndDate && MainRegisterError==true "   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.EndDate[0] }}
                                    </h4>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!------ تاريخ السجل ------>

                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">تاريخ السجل الرئيسى</label>

                            <input v-model="MainTradeRegister.date" type="date" class="form-control" required>

                        </div>
                    </div>
                    <!------ مكان اصدار ------>
                    <div class="row">

                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">مكان اصدار السجل الرئيسى</label>

                            <input v-model="MainTradeRegister.production_place" type="text" class="form-control" required >
                        </div>
                    </div>

                    <!----- Edit-Institution Form Content -->
                    <hr>
                    <div class="row" id="NewCompanyInformation">
                        <!------ أسم المنشأة ------>
                        <div class="col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">أسم المنشأة</label>
                            <input v-model="Institution.name" type="text" class="form-control" required >

                            <div v-if="ValidationErrors.name"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.name[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ أسم المنشأة/. ------>

                        <!------ رقم المنشأة ------>
                        <div class="col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">رقم المنشأة</label>
                            <input v-model="Institution.number" type="number" class="form-control" required >

                            <div v-if="ValidationErrors.number && CompanyError==true"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.number[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ رقم المنشأة/. ------>

                        <!------ الكيان القانوني ------>
                        <div class="col-md-3" style="padding-bottom: 20px">
                            <label class="float-right">الكيان القانوني</label>
                            <select class="form-control" v-model="Institution.legal_entity" required >
                                <option disabled></option>
                                <option v-for="option in legal_entityOptions" :value="option.value">{{option.value}}</option>


                            </select>
                            <div v-if="ValidationErrors.legal_entity"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.legal_entity[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ الكيان القانوني/. ------>

                        <!------ اهتمامات الملاك ------>
                        <div class="col-md-3" style="padding-bottom: 20px">
                            <label class="float-right">اهتمامات الملاك</label>
                            <select class="form-control" v-model="Institution.angel_interests" required>
                                <option disabled></option>
                                <option  v-for="option in angel_interestsOptions" :value="option.value">{{option.value}}</option>

                            </select>
                            <div v-if="ValidationErrors.angel_interests"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.angel_interests[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ اهتمامات الملاك/. ------>

                        <!------ طبيعة ملكية المنشأة وكيفية تمويلها ------>
                        <div class="col-md-3" style="padding-bottom: 20px">
                            <label class="float-right">طبيعة ملكية المنشأة وكيفية تمويلها</label>
                            <select class="form-control" v-model="Institution.nature" required >
                                <option disabled ></option>
                                <option  v-for="option in natureOptions" :value="option.value">{{option.value}}</option>
                            </select>

                            <div v-if="ValidationErrors.nature"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.nature[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ طبيعة ملكية المنشأة وكيفية تمويلها/. ------>

                        <!------ تقويم العام المالي للمنشأة ------>
                        <div class="col-md-3" style="padding-bottom: 20px">
                            <label class="float-right">تقويم العام المالي للمنشأة</label>
                            <select class="form-control" v-model="Institution.date_type" required >
                                <option disabled ></option>
                                <option value="ميلادى">ميلادى</option>
                                <option value="هجري">هجري</option>
                            </select>

                            <div v-if="ValidationErrors.date_type"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.date_type[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ تقويم العام المالي للمنشأة/. ------>

                        <!------ نشاط المنشأة ------>
                        <div class="col-md-9" style="padding-bottom: 20px">
                            <label class="float-right">نشاط المنشأة</label>
                            <textarea class="form-control" v-model="Institution.business_activity" rows="6" required >

                                </textarea>
                            <div v-if="ValidationErrors.business_activity"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.business_activity[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ نشاط المنشأة/. ------>

                        <!------ عنوان المنشأة ------>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">العنوان: المدينة</label>
                            <select class="form-control" v-model="City" required>
                                <option selected :value="City">{{City}}</option>
                                <option v-for="option in cityOptions" :value="option.value">{{option.value}}</option>

                            </select>

                            <div v-if="ValidationErrors.address"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.address[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">العنوان: الحى</label>
                            <select class="form-control" v-model="District" required >
                                <option selected :value="District">{{District}}</option>
                                <option v-for="option in districtOptions" :value="option.value">{{option.value}}</option>

                            </select>

                            <div v-if="ValidationErrors.address"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.address[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">باقى العنوان:</label>
                            <input type="text" class="form-control" v-model="RestOfAddress"required>
                            <div v-if="ValidationErrors.address"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.address[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ عنوان المنشأة/. ------>

                        <!------ الرقم المميز لدى هيئة الذكاة ------>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">الرقم المميز لدى هيئة الذكاة</label>
                            <input type="number" class="form-control" v-model="Institution.charity_num" required>

                            <div v-if="ValidationErrors.charity_num"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.charity_num[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ الرقم المميز لدى هيئة الذكاة/. ------>

                        <!------ رقم الضريبة المضافة ------>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">رقم الضريبة المضافة</label>
                            <input type="number" class="form-control" v-model="Institution.extra_tax_num" required >

                            <div v-if="ValidationErrors.extra_tax_num"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.extra_tax_num[0] }}
                                </h4>
                            </div>
                        </div>
                        <!------ رقم الضريبة المضافة/> ------>

                    </div>
                    <!-----./ Edit-Institution Form Content -->
                    <hr>
                    <!------ تاريخ انتهاء السجل ------>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom:20px">
                            <label class="float-right">تاريخ انتهاء السجل</label>

                            <input v-model="MainTradeRegister.EndDate" type="date" class="form-control" required>

                            <div v-if="ValidationErrors.EndDate"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.EndDate[0] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!------ تاريخ انتهاء السجل/. ------>


                <!-- Financial info ------>

                    <!------   السنة المالية ------>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px" >
                            <label class="float-right">السنة المالية</label>

                            <input @change="SetFinancialDates()" v-model="Transaction.financial_year" type="number" class="form-control" required>

                            <div v-if="ValidationErrors.financial_year"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.financial_year[0] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!------   السنة المالية/. ------>

                    <!------   الفترة المالية ------>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right"> الفترة المالية</label>

                            <select @change="SetFinancialDates()"  v-model="Transaction.financial_period" type="text" class="form-control" required>
                                <option value="سنة مالية">سنة مالية</option>
                                <option value="فترة قصيرة">فترة قصيرة</option>
                                <option value="فترة طويلة">فترة طويلة</option>
                            </select>

                            <div v-if="ValidationErrors.financial_period"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.financial_period[0] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!------   الفترة المالية/. ------>

                    <!------ بداية / نهاية  السنة المالية ------>
                        <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">بداية السنة المالية</label>

                            <input v-model="Transaction.start_financial_year" type="date" class="form-control" required>

                            <div v-if="ValidationErrors.start_financial_year"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.start_financial_year[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">نهاية السنة المالية</label>

                            <input   v-model="Transaction.end_financial_year" type="date" class="form-control" required>

                            <div v-if="ValidationErrors.end_financial_year"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.end_financial_year[0] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!------ بداية / نهاية  السنة المالية/. ------>


                    <!-- /.Financial info ------>

                <!-- Branched Register Details ------>

                    <h3 class="box-header">السجلات الفرعية</h3>


                    <!----- Add Branched Register ------->
                    <form id="BranchRegisterForm" @submit.prevent="AddBranchedRegister()">
                        <div class="row" style="padding-top:15px">
                            <div class="col-md-3">
                                <label class="float-right">رقم السجل </label>
                                <input type="number" v-model="NewBranchedRegister.number" class="form-control"  required>
                            </div>
                            <div class="col-md-3">
                                <label class="float-right">مكان اصدار السجل </label>
                                <input type="text" v-model="NewBranchedRegister.production_place" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="float-right"> تاريخ اصدار السجل </label>
                                <input type="date"  v-model="NewBranchedRegister.date" class="form-control"  required>
                            </div>
                            <div class="col-md-3">
                                <label class="float-right"> تاريخ انتهاء السجل </label>
                                <input type="date"  v-model="NewBranchedRegister.EndDate" class="form-control"  required>
                            </div>
                            <div class="col-md-3 justify-content-between">
                                <button type="submit" form="BranchRegisterForm"  class="btn btn-success btn-md" style="margin-top:5px">أضافة </button>
                            </div>
                        </div>

                        <div v-if="ValidationErrors.number && CompanyError == false"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.number[0] }}
                            </h4>
                        </div>
                        <div v-if="ValidationErrors.EndDate  && CompanyError == false"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red;padding-top: 10px">
                                {{ ValidationErrors.EndDate[0] }}
                            </h4>
                        </div>
                    </form>

                    <!----- /.Add Branched Register ------->

                    <div class="row" style="padding-top: 10px" v-for="register in BranchedTradeRegisters">
                        <div class="col-md-3">
                            <label class="float-right">رقم السجل </label>
                            <input type="number" v-model="register.number" class="form-control" >
                        </div>
                        <div class="col-md-3">
                            <label class="float-right">مكان اصدار السجل </label>
                            <input type="text" v-model="register.production_place" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="float-right"> تاريخ اصدار السجل </label>
                            <input type="date"  v-model="register.date" class="form-control" >
                        </div>
                        <div class="col-md-3">
                            <label class="float-right"> تاريخ انتهاء السجل </label>
                            <input type="date"  v-model="register.EndDate" class="form-control" >
                        </div>
                        <div class="col-md-3 justify-content-between">
                            <a @click="UpdateRegister(register)" class="btn btn-info btn-md" style="margin-top:5px">تعديل </a>
                            <a @click="DeleteRegister(register)" class="btn btn-danger btn-md" style="margin-top:5px">حذف </a>
                        </div>


                    </div>

                <!-- /.Branched Register Details---->

                <!----- Choose revisers Form Content -->
                <div class="row" id="chooseRevisers">
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <h3 class="box-header" v-if="ChoosenReviser"> المراجع الفنى: {{ChoosenReviser.name}}</h3>
                        <h3 class="box-header"v-else> المراجع الفنى: </h3>

                        <v-select  :options="revisers" v-model="ChoosenReviser"></v-select>

                    </div>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <h3 class="box-header" v-if="ChoosenRevisingManager">مدير المراجعة: {{ChoosenRevisingManager.name}}</h3>
                        <h3 class="box-header" v-else>مدير المراجعة:</h3>

                        <v-select  :options="revisingManagers" v-model="ChoosenRevisingManager"></v-select>

                    </div>
                </div>
                <!----- /.Choose revisers Form Content -->


                        <hr>
                    <div class="row">
                        <div class="col-md-12 ">
                            <button  class="btn btn-block btn-success btn-lg" form="EditTransactionForm" style="padding: 15px;width:230px" >تعديل</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditTransactionData.vue",

        data(){
            return{
                ValidationErrors:'',
                CompanyError:'',
                LoadingSpinner:false,
                Transaction : this.$parent.Transaction,
                MainTradeRegister : this.$parent.MainTradeRegister,
                BranchedTradeRegisters : this.$parent.BranchedTradeRegisters,
                Institution:this.$parent.Institution,
                NewBranchedRegister : {
                    id:'',
                    number:'',
                    date:'',
                    EndDate:'',
                    production_place:'',
                    type:'فرعي'
                },
                revisers : [],
                revisingManagers : [],
                ChoosenReviser : this.$parent.reviser,
                ChoosenRevisingManager : this.$parent.revisingManager,

                legal_entityOptions:[],
                angel_interestsOptions:[],
                natureOptions:[],
                cityOptions:[],
                districtOptions:[],

                City : '',
                District:'',
                RestOfAddress:'',
                MainRegisterIS_UPDATED : false,
                InstitutionIS_UPDATED : false,
            }
        },
        created() {
            this.GetRevisers(route('employee.type','مراجع فني'));
            this.GetRevisingManagers(route('employee.type','مدير مراجعة'));;

            this.GetDropDowns(route('system.DropDowns.retrieve.option'));

            this.City = this.Institution.address.split(',')[0];
            this.District = this.Institution.address.split(',')[1];
            this.RestOfAddress = this.Institution.address.split(',')[2];
        },
        methods:{
            GetRevisers(endpoint) {
                axios.get(endpoint)
                    .then(({data}) => {
                        data.employees.forEach((reviser) => {
                            this.revisers.push({'label':

                                    'الكود : '
                                    +
                                    reviser.id

                                    +
                                    ' , '
                                    +
                                    'الأسم : '
                                    +
                                    reviser.name

                                , 'code':reviser.id});

                        });
                    })
            },
            // get all the RevisingManagers in the system and put them in the array
            GetRevisingManagers(endpoint) {
                axios.get(endpoint)
                    .then(({data}) => {
                        data.employees.forEach((revisingManager) => {
                            this.revisingManagers.push({'label':

                                'الكود : '
                            +
                                revisingManager.id
                            +
                            ' , '
                            +
                            'الأسم : '
                            +
                                    revisingManager.name

                                , 'code':revisingManager.id});
                        });
                    })
            },
            // get DropDowns
            GetDropDowns(endpoint){
                axios.get(endpoint)
                    .then(({data})=>{
                        data.DropDownsOptions.forEach((option,index)=>{

                            if(option.name == 'الكيان القانونى'){
                                this.legal_entityOptions.push(option);
                            }
                            else if(option.name == 'اهتمامات الملاك'){
                                this.angel_interestsOptions.push(option);
                            }
                            else if(option.name == 'طبيعة ملكية المنشأة وكيفية تمويلها'){
                                this.natureOptions.push(option);
                            }
                            else if(option.name == 'المدينة'){
                                this.cityOptions.push(option);
                            }
                            else if(option.name == 'الحي'){
                                this.districtOptions.push(option);
                            }

                        })
                    })
            },

            SetFinancialDates(){
                if(this.Transaction.financial_period == 'سنة مالية'){
                    this.Transaction.start_financial_year = this.Transaction.financial_year+"-01-01";
                    this.Transaction.end_financial_year = this.Transaction.financial_year+"-12-31";
                }
            },

            UpdateMainRegister(){
                if(!this.MainRegisterIS_UPDATED)
                {
                    this.LoadingSpinner = true;
                    var formData = new FormData();

                    formData.append('_method','PATCH');
                    formData.append('number',this.MainTradeRegister.number);
                    formData.append('date',this.MainTradeRegister.date);
                    formData.append('production_place',this.MainTradeRegister.production_place);
                    formData.append('EndDate',this.MainTradeRegister.EndDate);
                    formData.append('type','رئيسي');
                    axios.post(route('TradeRegister.update',this.MainTradeRegister.id),formData)
                        .then(({data})=>{
                            this.LoadingSpinner = false;
                            this.ValidationErrors = '';
                            this.MainRegisterIS_UPDATED = true;
                            this.UpdateInstitution();
                        })
                        .catch((error)=>{
                            this.LoadingSpinner = false;
                            this.ValidationErrors = error.response.data.errors;
                            this.$toast.error('خطأ',register.number+'يرجى اعادة مراجعة بيانات سجل فرعي رقم ',{timout:2000});
                        })
                }else{
                    this.UpdateInstitution();
                }


            },

            UpdateInstitution(){
                if(!this.InstitutionIS_UPDATED){
                    this.LoadingSpinner = true;

                    var formData = new FormData();

                    formData.append('_method','PATCH');
                    formData.append('address', this.getAddress);
                    formData.append('business_activity', this.Institution.business_activity);
                    formData.append('name',this.Institution.name);
                    formData.append('number',this.Institution.number);
                    formData.append('legal_entity', this.Institution.legal_entity);
                    formData.append('angel_interests', this.Institution.angel_interests);
                    formData.append('date_type', this.Institution.date_type);
                    formData.append('nature', this.Institution.nature);
                    formData.append('charity_num', this.Institution.charity_num);
                    formData.append('extra_tax_num', this.Institution.extra_tax_num);
                    axios.post(route('Institution.update',this.Institution.id),
                        formData
                    ).then((res) => {
                        this.LoadingSpinner = false;
                        this.CompanyError = false;
                        this.InstitutionIS_UPDATED = true;
                        this.UpdateTransaction();
                    }).catch((error) => {
                        this.LoadingSpinner = false;
                        this.ValidationErrors = error.response.data.errors;

                        this.CompanyError = true;
                        this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                    });
                }
                else{
                    this.UpdateTransaction();
                }

            },

            UpdateTransaction(){
                this.LoadingSpinner = true;

                var formData = new FormData();

                formData.append('_method','PATCH');
                formData.append('financial_year', this.Transaction.financial_year);
                formData.append('start_financial_year', this.Transaction.start_financial_year);
                formData.append('end_financial_year',this.Transaction.end_financial_year);
                formData.append('financial_period',this.Transaction.financial_period);
                formData.append('MainTradeRegisterNumber',this.MainTradeRegister.number);
                formData.append('reviser_id',(this.ChoosenReviser.code ? this.ChoosenReviser.code : this.ChoosenReviser.id));
                formData.append('revisingManager_id',(this.ChoosenRevisingManager.code ? this.ChoosenRevisingManager.code    :   this.ChoosenRevisingManager.id));
                axios.post(route('Transactions.update',this.Transaction.id ),formData)
                    .then((res) => {
                        this.LoadingSpinner = false;
                        this.ValidationErrors = '';
                        this.$toast.success('.',
                            'قد تم تعديل بيانات المعاملة بنجاح'
                            ,{timout:2000})

                    }).catch((error) => {
                    this.LoadingSpinner = false;
                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});

                });

            },


            UpdateRegister(register){
                this.LoadingSpinner = true;
                let formData = new FormData();

                formData.append('_method','PATCH');
                formData.append('number',register.number);
                formData.append('date',register.date);
                formData.append('EndDate',register.EndDate);
                formData.append('production_place',register.production_place);
                formData.append('type',register.type);

                axios.post(route('TradeRegister.update',register.id),formData)
                    .then(({data})=>{
                        this.LoadingSpinner = false;
                        this.$toast.success('.',
                            'قد تم تعديل  بيانات السجل بنجاح '
                            ,{timout:2000});
                        this.ValidationErrors = '';
                    })
                    .catch((error)=>{
                        this.LoadingSpinner = false;
                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ',register.number+'يرجى اعادة مراجعة بيانات سجل فرعي رقم ',{timout:2000});
                    })
            },

            DeleteRegister(register){
                this.LoadingSpinner = true;

                let formDate = new FormData();

                formDate.append('_method','DELETE');

                axios.post(route('TradeRegister.delete',register.id),formDate)
                    .then(res=>{
                        this.LoadingSpinner = false;

                        this.$toast.success('.',
                            'قد تم حذف  بيانات السجل بنجاح '
                            ,{timout:2000});
                        this.BranchedTradeRegisters.splice(this.BranchedTradeRegisters.indexOf(register),1);
                        this.ValidationErrors = '';

                    })
                    .catch(error=>{
                        this.LoadingSpinner = false;

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ','خطأ اثناء الحذف حاول مرة أخرى ',{timout:2000});
                    })
            },

            AddBranchedRegister(){
                this.LoadingSpinner = true;

                let formData = new FormData();

                formData.append('number',this.NewBranchedRegister.number);
                formData.append('date',this.NewBranchedRegister.date);
                formData.append('EndDate',this.NewBranchedRegister.EndDate);
                formData.append('production_place',this.NewBranchedRegister.production_place);
                formData.append('type',this.NewBranchedRegister.type);

                axios.post(route('TradeRegister.store',this.Institution),formData)
                    .then(({data})=>{
                        this.LoadingSpinner = false;

                        this.$toast.success('.',
                            'قد تم اضافة السجل بنجاح '
                            ,{timout:2000});
                        this.ValidationErrors = '';
                        this.BranchedTradeRegisters.push({
                            'id' : data.id,
                            'number' : data.number,
                            'date' : data.date,
                            'EndDate' : data.EndDate,
                            'production_place' : data.production_place,
                        })
                        this.clearNewBranchInput();
                    })
                    .catch((error)=>{
                        this.LoadingSpinner = false;

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ',register.number+'يرجى اعادة مراجعة بيانات سجل فرعي رقم ',{timout:2000});
                    })

            },
            clearNewBranchInput(){
                this.NewBranchedRegister.number = '';
                this.NewBranchedRegister.date = '';
                this.NewBranchedRegister.production_place = '';
            },

        },
        computed : {

            getAddress() {
                return this.City + ' , ' + this.District + ',' + this.RestOfAddress;
            },


        },
    }
</script>

<style scoped>

</style>
