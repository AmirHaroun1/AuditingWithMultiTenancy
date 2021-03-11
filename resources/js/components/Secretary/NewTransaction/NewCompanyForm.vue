<template>

    <div class="box" style="margin-top: 20px">
        <div class="box-header">
            <h2 class="pb-3">معاملة لصالح منشأة جديدة</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form class="form-group" @submit.prevent="createInstitution()">
            <!-- New TransAction Form Content ------>
                <!------ رقم السجل ------>

                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px" >
                        <label class="float-right">رقم السجل الرئيسي</label>
                        <input disabled v-model="MainTradeRegister.number" type="number" class="form-control" required>

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
                <div class="row">

                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">مكان اصدار السجل الرئيسى</label>

                        <input v-model="MainTradeRegister.production_place" type="text" class="form-control" required >
                    </div>
                </div>

                <!-----Create-Institution Form Content -->
                <hr>
                <div class="row" id="NewCompanyInformation">
                    <!------ أسم المنشأة ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">أسم المنشأة</label>
                        <input v-model="institution.name" type="text" class="form-control" required >

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
                        <input v-model="institution.company_number" type="number" class="form-control" required >

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
                        <select class="form-control" v-model="institution.legal_entity" required >
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
                        <select class="form-control" v-model="institution.angel_interests" required>
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
                        <select class="form-control" v-model="institution.nature" required >
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
                        <select class="form-control" v-model="institution.date_type" required >
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
                        <textarea class="form-control" v-model="institution.business_activity" rows="6" required >

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
                        <select class="form-control" v-model="institution.city" required>
                            <option disabled></option>
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
                        <select class="form-control" v-model="institution.district" required >
                            <option disabled></option>
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
                        <input type="text" class="form-control" v-model="institution.restofadress"required>

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
                        <input type="number" class="form-control" v-model="institution.charity_num" required>

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
                        <input type="number" class="form-control" v-model="institution.extra_tax_num" required >

                        <div v-if="ValidationErrors.extra_tax_num"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.extra_tax_num[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ رقم الضريبة المضافة/> ------>

                </div>

                <!-- /.Create-Institution Form Content -->

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

                                <input @change="SetFinancialDates()" v-model="transaction.financial_year" type="number" class="form-control" required>

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

                                <select @change="SetFinancialDates()"  v-model="transaction.financial_period" type="text" class="form-control" required>
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

                            <input  v-model="transaction.start_financial_year" type="date" class="form-control" required>

                            <div v-if="ValidationErrors.start_financial_year"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.start_financial_year[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">نهاية السنة المالية</label>

                            <input   v-model="transaction.end_financial_year" type="date" class="form-control" required>

                            <div v-if="ValidationErrors.end_financial_year"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.end_financial_year[0] }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!------ بداية / نهاية  السنة المالية/. ------>

                <!-- /.Financial info ------>

                <!------ السجلات الفرعية ------>

                <form class="row" id="BranchedRegisterForm" @submit.prevent="AddRegisterToList()">
                    <h3 class="box-header">السجلات الفرعية</h3>
                    <div class="col-md-3">
                        <label class="float-right">رقم السجل </label>
                        <input type="number" v-model="BranchedTradeRegister.number" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="float-right">مكان صدور السجل </label>
                        <input type="text" v-model="BranchedTradeRegister.production_place" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="float-right"> تاريخ اصدار السجل </label>
                        <input type="date"  v-model="BranchedTradeRegister.date" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label class="float-right"> تاريخ انتهاء السجل </label>
                        <input type="date"  v-model="BranchedTradeRegister.EndDate" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" form="BranchedRegisterForm" class="btn btn-success btn-lg" style="margin-top:5px">أضافة سجل</button>
                    </div>
                    <div v-if="ValidationErrors.number && MainRegisterError==false"   style="margin-top:10px">
                        <h4 class="  font-weight-bold" style="color:red;padding-top: 10px">
                            {{ ValidationErrors.number[0] }}
                        </h4>
                    </div>
                    <div v-if="ValidationErrors.EndDate && MainRegisterError==false"   style="margin-top:10px">
                        <h4 class="  font-weight-bold" style="color:red;padding-top: 10px">
                            {{ ValidationErrors.EndDate[0] }}
                        </h4>
                    </div>
                    <div v-if="AddedBranchedRegisters.length" class="col-md-12">
                        <table class="table" style="margin-top:10px">
                            <tbody><tr>
                                <th>رقم السجل</th>
                                <th>تاريخ اصدار السجل</th>
                                <th>مكان الاصدار</th>
                                <th>تاريخ انتهاء السجل</th>
                                <th>حذف</th>
                            </tr>
                            <tr v-for="reg in AddedBranchedRegisters">
                                <td>{{reg.number}}</td>
                                <td>{{reg.date}}</td>
                                <td>
                                   {{reg.production_place}}
                                </td>
                                <td>
                                   {{reg.EndDate}}
                                </td>
                                <td><i class="fa fa-times" style="color:red;cursor:pointer;" @click="removeRegisterFromList(reg)"></i></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </form>
            <!-- /.New TransAction Form Content ------>

            <!----- Choose revisers Form Content -->
                <div class="row" id="chooseRevisers">
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <h3 class="box-header"> المراجع الفنى</h3>
                        <select v-model="ChoosenReviserID" class="form-control"  required>
                            <option v-for="reviser in revisers" :value="reviser.id">
                                الكود :
                                {{reviser.id}}

                                الأسم :
                                {{reviser.name}}
                            </option>
                        </select>

                    </div>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <h3 class="box-header">مدير المراجعة</h3>
                        <select v-model="ChoosenRevisingManagerID" class="form-control"  required>
                            <option v-for="revisingManager in revisingManagers" :value="revisingManager.id">
                                الكود :
                                {{revisingManager.id}}

                                الأسم :
                                {{revisingManager.name}}
                            </option>
                        </select>

                    </div>
                </div>
            <!----- /.Choose revisers Form Content -->
                <div class="col-md-12">
                    <hr>
                </div>

                <div class="row">
                    <div class="col-md-12 ">
                        <button  class="btn btn-block btn-success btn-lg" style="padding: 15px;width:230px" >  التالى</button>
                    </div>
                </div>
            </form>

        </div>

        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
    </div>


</template>

<script>

    export default {
        name: "NewCompanyForm.vue",
        data()
        {
            return{
                revisers : [],
                revisingManagers : [],


                ChoosenReviserID : '',
                ChoosenRevisingManagerID : '',
              //////// Create-Institution DATA  //////
               institution : {
                   name : '',
                   company_number : '',
                   //العوان يتكون من التالي
                   city:'',
                   district:'',
                   restofadress:'',
                   //باقى بيانات الشركة
                   legal_entity:'',
                   date_type : '',
                   angel_interests : '',
                   nature:'',
                   business_activity:'',
                   charity_num:'',
                   extra_tax_num:'',
               },
                legal_entityOptions:[],
                angel_interestsOptions:[],
                natureOptions:[],
                cityOptions:[],
                districtOptions:[],

                created_institution : Object,
                NewCompanyNot_ADDED : true,
                ///////// Create TradeRegister Data /////////
                MainTradeRegister : {
                    number: this.$parent.TradeRegisterInput,
                    date: '',
                    EndDate:'',
                    production_place: '',
                    type: 'رئيسي',
                },
                BranchedTradeRegister : {
                    number: '',
                    date: '',
                    EndDate:'',
                    production_place: '',
                    type: 'فرعي',
                },
                AddedBranchedRegisters : [],
                NewMainRegisterNot_ADDED : true,
                AllBranchedRegistersNot_Added : true,
             /////  create Transaction Data ///////////
                transaction : {

                    financial_year : '',
                    start_financial_year : '',
                    end_financial_year : '',
                    financial_period : '',

                },

                NewTransactionNot_ADDED : true,

                LoadingSpinner : false,
                ValidationErrors: '',
                MainRegisterError: false,
                CompanyError: false,
            }
        },
        created() {
            this.GetRevisers(route('employee.type','مراجع فني'));
            this.GetRevisingManagers(route('employee.type','مدير مراجعة'));
            this.GetDropDowns(route('system.DropDowns.retrieve.option'));
        },
        methods: {
            // get all the revisers in the system and put them in the array
            GetRevisers(endpoint) {
                axios.get(endpoint)
                    .then(({data}) => {
                        data.employees.forEach((reviser) => {
                            this.revisers.push(reviser);
                        });
                    })
            },
            // get all the RevisingManagers in the system and put them in the array
            GetRevisingManagers(endpoint) {
                axios.get(endpoint)
                    .then(({data}) => {
                        data.employees.forEach((revisingManager) => {
                            this.revisingManagers.push(revisingManager);
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
            createInstitution(){
                if(this.NewCompanyNot_ADDED)
                {
                    this.LoadingSpinner=true;

                    var formData = new FormData();

                    formData.append('address', this.getAddress);
                    formData.append('business_activity', this.institution.business_activity);
                    formData.append('name',this.institution.name);
                    formData.append('number',this.institution.company_number);
                    formData.append('legal_entity', this.institution.legal_entity);
                    formData.append('angel_interests', this.institution.angel_interests);
                    formData.append('date_type', this.institution.date_type);
                    formData.append('nature', this.institution.nature);
                    formData.append('charity_num', this.institution.charity_num);
                    formData.append('extra_tax_num', this.institution.extra_tax_num);
                    axios.post(route('Institution.store'),
                        formData
                    ).then((res) => {

                        this.created_institution = res.data;

                        this.$parent.Institution = res.data;

                        this.ValidationErrors = '';

                        this.NewCompanyNot_ADDED = false;

                        this.CompanyError = false;

                        this.LoadingSpinner=false;

                        this.createMainTradeRegister();
                    }).catch((error) => {
                        this.LoadingSpinner=false;
                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                        this.CompanyError = true;
                    });
                }
                else if(!this.NewCompanyNot_ADDED){
                    this.LoadingSpinner=false;

                    this.createMainTradeRegister();
                }

            },

            createMainTradeRegister(){
                if(this.NewMainRegisterNot_ADDED){
                    this.LoadingSpinner=true;

                    var formData = new FormData();

                    formData.append('number', this.MainTradeRegister.number);
                    formData.append('date', this.MainTradeRegister.date);
                    formData.append('EndDate', this.MainTradeRegister.EndDate);
                    formData.append('production_place',this.MainTradeRegister.production_place);
                    formData.append('type',this.MainTradeRegister.type);

                    axios.post(route('TradeRegister.store',this.$parent.Institution),formData)
                        .then((res) => {

                            this.NewMainRegisterNot_ADDED = false;
                            this.ValidationErrors = '';
                            this.MainRegisterError = false;
                            this.LoadingSpinner=false;

                            this.createTransaction();
                        }).catch((error) => {
                        this.LoadingSpinner=false;

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});
                        this.MainRegisterError = true;

                    });
                }
                else if(!this.NewMainRegisterNot_ADDED){
                    this.LoadingSpinner=false;

                    this.createTransaction();
                }

            },

            createTransaction(){

                if(this.NewTransactionNot_ADDED){

                    this.LoadingSpinner=true;

                    var formData = new FormData();

                    formData.append('financial_year', this.transaction.financial_year);
                    formData.append('start_financial_year', this.transaction.start_financial_year);
                    formData.append('end_financial_year',this.transaction.end_financial_year);

                    formData.append('financial_period',this.transaction.financial_period);

                    formData.append('MainTradeRegisterNumber',this.MainTradeRegister.number);

                    formData.append('revisingManager_id',this.ChoosenRevisingManagerID);

                    axios.post(route('Transactions.store', [this.created_institution.id, this.ChoosenReviserID] ),formData)
                        .then(({data}) => {

                            this.NewTransactionNot_ADDED = false;
                            this.$parent.Transaction = data[0];
                            this.ValidationErrors = '';
                            this.LoadingSpinner=false;

                            this.createBranchedRegisters();
                        }).catch((error) => {
                        this.LoadingSpinner=false;

                        this.ValidationErrors = error.response.data.errors;
                        this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});

                    });
                }

                else if(!this.NewTransactionNot_ADDED){
                    this.createBranchedRegisters();

                }

            },

            createBranchedRegisters(){

                if(this.AddedBranchedRegisters.length == 0){
                    this.LoadingSpinner=false;

                    this.AllBranchedRegistersNot_Added = false;
                    this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                        'قد تم تسجيل البيانات بنجاح '
                       ,{timout:2000});
                    this.$parent.SectionStage = 2;
                }
                else{
                    this.AddedBranchedRegisters.forEach((register, index) => {
                        this.LoadingSpinner=true;

                        var formData = new FormData();

                        formData.append('number', register.number);
                        formData.append('date', register.date);
                        formData.append('EndDate', register.EndDate);
                        formData.append('production_place', register.production_place);
                        formData.append('type', register.type);

                        axios.post(route('TradeRegister.store',this.$parent.Institution),formData)
                            .then((res) => {

                                this.ValidationErrors = '';

                                this.AddedBranchedRegisters.splice(this.AddedBranchedRegisters.indexOf(register), 1);
                                console.log('size' + this.AddedBranchedRegisters.length);
                                if(this.AddedBranchedRegisters.length == 0){
                                    this.LoadingSpinner=false;

                                    this.AllBranchedRegistersNot_Added = false;
                                    this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                                        'قد تم تسجيل البيانات بنجاح '
                                        ,{timout:2000});
                                    this.$parent.SectionStage = 2;
                                }
                            }).catch((error) => {
                            this.LoadingSpinner=false;

                            this.ValidationErrors = error.response.data.errors;
                            this.$toast.error('خطأ',register.number+'يرجى اعادة مراجعة بيانات سجل فرعي رقم ',{timout:2000});

                        });
                    });
                }


            },
            AddRegisterToList(){

              this.AddedBranchedRegisters.push({
                  number : this.BranchedTradeRegister.number,
                  date : this.BranchedTradeRegister.date,
                  EndDate : this.BranchedTradeRegister.EndDate,
                  production_place : this.BranchedTradeRegister.production_place,
                  type : this.BranchedTradeRegister.type,
              });
              this.ClearBranchedRegisterInput();
            },
            removeRegisterFromList(reg){
                this.AddedBranchedRegisters.splice(this.AddedBranchedRegisters.indexOf(reg), 1);

            },
            ClearBranchedRegisterInput(){
                this.BranchedTradeRegister.number = '',
                    this.BranchedTradeRegister.date = '',
                    this.BranchedTradeRegister.EndDate = '',
                    this.BranchedTradeRegister.production_place = ''
            },
            SetFinancialDates(){
                if(this.transaction.financial_period == 'سنة مالية'){
                    this.transaction.start_financial_year = this.transaction.financial_year+"-01-01";
                    this.transaction.end_financial_year = this.transaction.financial_year+"-12-31";
                }
            }
        },

        computed : {

            getAddress() {
                return this.institution.city + ' , ' + this.institution.district + ',' + this.institution.restofadress;
            },


        },

    }
</script>

<style scoped>

</style>
