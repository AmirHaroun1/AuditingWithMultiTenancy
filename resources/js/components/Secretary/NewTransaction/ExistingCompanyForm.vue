<template>
    <div class="box" style="margin-top: 20px">
        <div class="box-header">
            <h2 class="pb-3">بدء معاملة لصالح منشأة مسجلة</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="CreateTransactionForm" class="form-group" @submit.prevent="createTransaction()">
                <!-- New TransAction Form Content ------>

                <!-- main register input ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px" >
                        <label class="float-right">رقم السجل الرئيسي</label>
                        <input disabled v-model="MainTradeRegister.number" type="number" class="form-control" required>

                    </div>
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right"> مكان اصدار السجل الرئيسى</label>

                        <input disabled v-model="MainTradeRegister.production_place" type="text" class="form-control" required >

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">تاريخ اصدار السجل الرئيسى</label>

                        <input disabled v-model="MainTradeRegister.date" type="date" class="form-control" required>

                    </div>
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">تاريخ انتهاء السجل الرئيسى</label>

                        <input disabled v-model="MainTradeRegister.EndDate" type="date" class="form-control" required>

                    </div>
                </div>
                <!-- /.main register input ------>

                <!-- /. main register input ------>


                <!-----Create-Institution Form Content -->
                <form id="UpdateInstitutionForm" @submit.prevent="UpdateInstitution()">
                    <div class="row" id="NewCompanyInformation">
                        <h3 class="box-header"> بيانات المنشأة</h3>
                        <div class="col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">الأسم</label>
                            <input v-model="institution.name" type="text" class="form-control" required >

                            <div v-if="ValidationErrors.name"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.name[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">رقم المنشأة</label>
                            <input v-model="institution.number" type="number" class="form-control" required >

                            <div v-if="ValidationErrors.number && CompanyError==true"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.number[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-bottom: 20px">
                            <label class="float-right">الكيان القانوني</label>
                            <select class="form-control" v-model="institution.legal_entity" required >
                                <option :value="institution.legal_entity">{{institution.legal_entity}}</option>
                                <option value="شركة ذات مسؤولية محدودة">الكيان القانوني1</option>
                                <option value="مؤسسة فردية سعودية">الكيان القانوني2</option>
                                <option value="شركة مساهمة ">الكيان القانوني3</option>
                            </select>
                            <div v-if="ValidationErrors.legal_entity"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.legal_entity[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-3" style="padding-bottom: 20px">
                            <label class="float-right">اهتمامات الملاك</label>
                            <select class="form-control" v-model="institution.angel_interests" required>
                                <option :value="institution.angel_interests">{{institution.angel_interests}}</option>
                                <option value="شركة ذات مسؤولية محدودة">اهتمامات الملاك1</option>
                                <option value="مؤسسة فردية سعودية">اهتمامات الملاك2</option>
                                <option value="شركة مساهمة ">اهتمامات الملاك3</option>
                            </select>
                            <div v-if="ValidationErrors.angel_interests"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.angel_interests[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right">طبيعة ملكية المنشأة وكيفية تمويلها</label>
                            <select class="form-control" v-model="institution.nature" required >
                                <option :value="institution.nature">{{institution.nature}}</option>
                                <option value="شركة ذات مسؤولية محدودة">اختيار1</option>
                                <option value="مؤسسة فردية سعودية">اختيار2</option>
                                <option value="شركة مساهمة ">اختيار3</option>
                            </select>
                            <div v-if="ValidationErrors.nature"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.nature[0] }}
                                </h4>
                            </div>
                        </div>
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
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">العنوان: المدينة</label>
                            <select class="form-control" v-model="City" required>
                                <option :value="City">{{City}}</option>
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
                                <option :value="District">{{District}}</option>
                                <option v-for="option in districtOptions" :value="option.value">{{option.value}}</option>

                            </select>

                        </div>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">باقى العنوان:</label>
                            <input type="text" class="form-control" v-model="RestOfAddress"required>
                        </div>

                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">الرقم المميز لدى هيئة الذكاة</label>
                            <input type="number" class="form-control" v-model="institution.charity_num" required>
                            <div v-if="ValidationErrors.charity_num"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.charity_num[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-bottom: 20px">
                            <label class="float-right mt-2">رقم الضريبة المضافة</label>
                            <input type="number" class="form-control" v-model="institution.extra_tax_num" required >
                            <div v-if="ValidationErrors.extra_tax_num"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.extra_tax_num[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <button  class="btn btn-block btn-info btn-md" form="UpdateInstitutionForm" style="padding: 15px;width:230px" >تعديل بيانات المنشأة</button>
                        </div>
                    </div>
                </form>
                <!-- /.Create-Institution Form Content -->

                <!-- Financial info ------>
                    <!------   السنة المالية ------>
                <hr>
                    <div class="row" style="padding-bottom: 15px">
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

                <div class="row" style="padding-top: 10px" v-for="register in BranchedRegisters">
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
                        <h3 class="box-header"> المراجع الفنى</h3>
                        <select v-model="ChoosenReviserID" class="form-control" required>
                            <option v-if="revisers.length" v-for="reviser in revisers" :value="reviser.id">
                                الكود :
                                {{reviser.id}}

                                الأسم :
                                {{reviser.name}}
                            </option>
                        </select>

                    </div>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <h3 class="box-header">مدير المراجعة</h3>
                        <select v-model="ChoosenRevisingManagerID" class="form-control" required>
                            <option v-if="revisingManagers.length" v-for="revisingManager in revisingManagers" :value="revisingManager.id">
                                الكود :
                                {{revisingManager.id}}

                                الأسم :
                                {{revisingManager.name}}
                            </option>
                        </select>

                    </div>
                </div>
                <!----- /.Choose revisers Form Content -->

                <hr>
                <div class="row">
                    <div class="col-md-12 ">
                        <button  class="btn btn-block btn-success btn-lg" form="CreateTransactionForm" style="padding: 15px;width:230px" >التالى</button>
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
        name: "ExistingCompanyForm",
        data (){
            return {
                LoadingSpinner:'',
                ValidationErrors:'',

                institution: this.$parent.Institution,
                MainTradeRegister : this.$parent.TradeRegister,
                BranchedRegisters:[],

                /////  create Transaction Data ///////////
                transaction : {
                    financial_year : '',
                    start_financial_year : '',
                    end_financial_year : '',
                    financial_period : '',
                },
                /////// Added Branched Register //////////
                NewBranchedRegister : {
                    id:'',
                    number:'',
                    date:'',
                    EndDate:'',
                    production_place:'',
                    type:'فرعي'
                },

                City : '',
                District:'',
                RestOfAddress:'',
                CompanyError: false,


                legal_entityOptions:[],
                angel_interestsOptions:[],
                natureOptions:[],
                cityOptions:[],
                districtOptions:[],

                revisers : [],
                revisingManagers : [],

                ChoosenReviserID : '',
                ChoosenRevisingManagerID : '',

            }
        },
        created() {
            this.GetRevisers(route('employee.type','مراجع فني'));
            this.GetRevisingManagers(route('employee.type','مدير مراجعة'));;
            this.GetDropDowns(route('system.DropDowns.retrieve.option'));

            this.BranchedRegisters = this.$parent.Institution.branched_trade_register;
            this.City = this.institution.address.split(',')[0];
            this.District = this.institution.address.split(',')[1];
            this.RestOfAddress = this.institution.address.split(',')[2];
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
            UpdateRegister(register){
                this.LoadingSpinner = true;
                let formData = new FormData();

                formData.append('_method','PATCH');
                formData.append('register_ID',register.id);
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
                        this.BranchedRegisters.splice(this.BranchedRegisters.indexOf(register),1);
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

                axios.post(route('TradeRegister.store',this.$parent.Institution),formData)
                    .then(({data})=>{
                        this.LoadingSpinner = false;

                        this.$toast.success('.',
                            'قد تم اضافة السجل بنجاح '
                            ,{timout:2000});
                        this.ValidationErrors = '';
                        this.BranchedRegisters.push({
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

            UpdateInstitution(){
                this.LoadingSpinner = true;

                var formData = new FormData();

                formData.append('_method','PATCH');
                formData.append('address', this.getAddress);
                formData.append('business_activity', this.institution.business_activity);
                formData.append('name',this.institution.name);
                formData.append('number',this.institution.number);
                formData.append('legal_entity', this.institution.legal_entity);
                formData.append('angel_interests', this.institution.angel_interests);
                formData.append('date_type', this.institution.date_type);
                formData.append('nature', this.institution.nature);
                formData.append('charity_num', this.institution.charity_num);
                formData.append('extra_tax_num', this.institution.extra_tax_num);
                axios.post(route('Institution.update',this.institution.id),
                    formData
                ).then((res) => {
                    this.LoadingSpinner = false;

                    this.$toast.success('.',
                        'قد تم تعديل بيانات المنشأة بنجاح '
                        ,{timout:2000});
                    this.CompanyError = false;

                }).catch((error) => {
                    this.LoadingSpinner = false;

                    this.ValidationErrors = error.response.data.errors;
                    this.CompanyError = true;
                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});

                });
            },

            createTransaction(){
                this.LoadingSpinner = true;

                var formData = new FormData();

                formData.append('status', 'under_review');
                formData.append('financial_year', this.transaction.financial_year);
                formData.append('start_financial_year', this.transaction.start_financial_year);
                formData.append('end_financial_year',this.transaction.end_financial_year);

                formData.append('financial_period',this.transaction.financial_period);

                formData.append('MainTradeRegisterNumber',this.MainTradeRegister.number);

                formData.append('revisingManager_id',this.ChoosenRevisingManagerID);


                axios.post(route('Transactions.store', [this.institution.id, this.ChoosenReviserID] ),formData)
                    .then(({data}) => {
                        this.LoadingSpinner = false;

                        this.$toast.success('.',
                            'قد تم انشاء معاملة جديدة بنجاح '
                            ,{timout:2000})
                        this.$parent.Transaction = data[0];
                        this.$parent.SectionStage = 2;

                    }).catch((error) => {
                    this.LoadingSpinner = false;

                    this.ValidationErrors = error.response.data.errors;
                    this.$toast.error('خطأ','يرجى اعادة مراجعة البيانات',{timout:2000});

                });
            },

            SetFinancialDates(){
                if(this.transaction.financial_period == 'سنة مالية'){
                    this.transaction.start_financial_year = this.transaction.financial_year+"-01-01";
                    this.transaction.end_financial_year = this.transaction.financial_year+"-12-31";
                }
            },
        },
        computed : {
            getAddress(){
                return  this.City + ' , ' + this.District + ',' + this.RestOfAddress ;
            }
        }
    }
</script>

<style scoped>

</style>
