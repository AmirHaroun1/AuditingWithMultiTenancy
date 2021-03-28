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
                <!------ رقم 700 ------>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="float-right">الرقم 700</label>
                        <input type="text" class="form-control" v-model="institution.number700">
                    </div>
                </div>

                <!------ تاريخ السجل ------>
                <div class="row">
                    <div class="form-group col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">تاريخ السجل الرئيسى</label>

                        <input v-model="MainTradeRegister.date" type="date" class="form-control" required>

                    </div>
                </div>
                <!------ النوع ------>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="float-right">الكيان القانوني</label>
                        <select class="form-control" v-model="InstitutionType">
                            <option selected value=""></option>
                            <option  value="organization">مؤسسة</option>
                            <option  value="company">شركة</option>
                            <option  value="other">اخرى</option>
                        </select>
                    </div>
                </div>

                <!-----بيانات المؤسسة -->
                <div v-if="InstitutionType=='organization'" class="row" id="NewOrganizationInformation">
                    <hr>
                    <!------ الإسم التجاري للمؤسسة ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">الإسم التجاري للمؤسسة</label>
                        <input v-model="institution.name" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.name"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.name[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ الإسم التجاري للمؤسسة/. ------>
                    <!---- المركز الرئيسي ------>
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">المركز الرئيسي : المدينة</label>
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
                        <label class="float-right mt-2"> المركز الرئيسي : الحى</label>
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
                    <!---- المركز الرئيسي/. ------>
                    <!------ صندوق البريد(ص.ب) ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">صندوق البريد(ص.ب)</label>
                        <input v-model="institution.postal_box" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.postal_box"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.postal_box[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ صندوق البريد(ص.ب)/. ------>
                    <!------ الرمز البريدي ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">الرمز البريدي</label>
                        <input v-model="institution.postal_code" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.postal_code"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.postal_code[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ الرمز البريدي/. ------>
                    <!------ الهاتف ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">الهاتف</label>
                        <input v-model="institution.phone" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.phone"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.phone[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ الهاتف/. ------>
                    <!------ فاكس ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">فاكس</label>
                        <input v-model="institution.fax" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.fax"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.fax[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ فاكس/. ------>
                    <!---- اسم التاجر ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">اسم التاجر</label>
                        <input v-model="institution.merchant_name" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.merchant_name"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.merchant_name[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ اسم التاجر/. ------>
                    <!---- جنسية التاجر ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">الجنسية</label>
                        <input v-model="institution.merchant_nationality" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.merchant_nationality"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.merchant_name[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ جنسية التاجر/. ------>
                    <!---- تاريخ ميلاد التاجر ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">تاريخ ميلاد التاجر</label>
                        <input v-model="institution.merchant_birth_date" type="date" class="form-control" required >

                        <div v-if="ValidationErrors.merchant_birth_date"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.merchant_birth_date[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ تاريخ ميلاد التاجر/. ------>

                    <!------ رقم المنشأة ------>
                    <!----<div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">رقم المنشأة</label>
                        <input v-model="institution.company_number" type="number" class="form-control" required >

                        <div v-if="ValidationErrors.number && CompanyError==true"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.number[0] }}
                            </h4>
                        </div>
                    </div>
                    ------>
                    <!------ رقم المنشأة/. ------>

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

                    <!------ رأس المال ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">رأس المال</label>
                        <input v-model="institution.capital" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.capital"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.capital[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------رأس المال/. ------>

                    <!------ اسم المدير او الوكيل المفوض ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">اسم المدير او الوكيل المفوض </label>
                        <input v-model="ManagerTemp.name" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.managers"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.managers[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------اسم المدير او الوكيل المفوض/. ------>

                    <!------ سلطات المدير ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">سلطات المدير</label>
                        <input v-model="institution.manager_authorities" value="'حسب الضوابط'" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.manager_authorities"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.manager_authorities[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ سلطات المدير ------>


                    <!------ الكيان القانوني ------>
                    <!---------
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
                    -------->
                    <!------ الكيان القانوني/. ------>

                    <!------ اهتمامات الملاك ------>
                    <!-----
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
                    ----->
                    <!------ اهتمامات الملاك/. ------>

                    <!------ طبيعة ملكية المنشأة وكيفية تمويلها ------>
                    <!---
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
                    ----->
                    <!------ طبيعة ملكية المنشأة وكيفية تمويلها/. ------>

                    <!------ تقويم العام المالي للمنشأة ------>
                    <!-------
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
                    ------>
                    <!------ تقويم العام المالي للمنشأة/. ------>

                    <!------ الرقم المميز لدى هيئة الذكاة ------>
                    <!----------
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">الرقم المميز لدى هيئة الذكاة</label>
                        <input type="number" class="form-control" v-model="institution.charity_num" required>

                        <div v-if="ValidationErrors.charity_num"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.charity_num[0] }}
                            </h4>
                        </div>
                    </div>
                    ----------->
                    <!------ الرقم المميز لدى هيئة الذكاة/. ------>

                    <!------ رقم الضريبة المضافة ------>
                    <!-------
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">رقم الضريبة المضافة</label>
                        <input type="number" class="form-control" v-model="institution.extra_tax_num" required >

                        <div v-if="ValidationErrors.extra_tax_num"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.extra_tax_num[0] }}
                            </h4>
                        </div>
                    </div>
                    ------>
                    <!------ رقم الضريبة المضافة/> ------>

                </div>
                <!-- /.بيانات المؤسسة -->
                <!-----بيانات شركة -->
                <div v-if="InstitutionType == 'company' "class="row" id="NewCompanyInformation">
                    <hr>
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
                    <!---- جنسية الشركة ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">جنسيتها</label>
                        <input v-model="institution.company_nationality" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.company_nationality"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.company_nationality[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ جنسية الشركة/. ------>
                    <!---- مدة الشركة ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">مدة الشركة</label>
                        <input v-model="institution.company_period" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.company_period"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.company_period[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ مدة الشركة/. ------>
                    <!----تبدأ من ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">تبدأ من</label>
                        <input v-model="institution.company_start_period" type="date" class="form-control" required >

                        <div v-if="ValidationErrors.company_start_period"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.company_start_period[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ تبدأ من/. ------>
                    <!----وتنتهي في ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">وتنتهي في</label>
                        <input v-model="institution.company_end_period" type="date" class="form-control" required >

                        <div v-if="ValidationErrors.company_end_period"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.company_end_period[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ وتنتهي في/. ------>
                    <!---- المركز الرئيسي ------>
                    <div class="col-md-4" style="padding-bottom: 20px">
                        <label class="float-right mt-2">المركز الرئيسي : المدينة</label>
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
                        <label class="float-right mt-2"> المركز الرئيسي : الحى</label>
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
                    <!---- المركز الرئيسي/. ------>
                    <!------ صندوق البريد(ص.ب) ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">صندوق البريد(ص.ب)</label>
                        <input v-model="institution.postal_box" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.postal_box"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.postal_box[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ صندوق البريد(ص.ب)/. ------>
                    <!------ الرمز البريدي ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">الرمز البريدي</label>
                        <input v-model="institution.postal_code" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.postal_code"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.postal_code[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ الرمز البريدي/. ------>
                    <!------ الهاتف ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">الهاتف</label>
                        <input v-model="institution.phone" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.phone"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.phone[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ الهاتف/. ------>
                    <!------ فاكس ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">فاكس</label>
                        <input v-model="institution.fax" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.fax"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.fax[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ فاكس/. ------>
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
                    <!------ رأس المال ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">رأس المال</label>
                        <input v-model="institution.capital" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.capital"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.capital[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------رأس المال/. ------>
                    <!---- المديرون ------>
                    <div class="col-md-12" style="padding-bottom: 20px">
                        <form @submit.prevent="AddManagerToList()" id="AddManagerToListForm">
                            <div class="col-md-8">
                                <label class="float-right">المديرون</label>
                                <input v-model="ManagerTemp.name" type="text" class="form-control" required >
                                <div v-if="ValidationErrors.managers"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.managers[0] }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success" type="submit" form="AddManagerToListForm" >إضافة مدير</button>
                            </div>
                            <div class="col-md-12">
                                <ul v-if="institution.managers.length">
                                    <li v-for="(manager,index) in institution.managers" >
                                        <h4>{{manager}}</h4>
                                        <i style="color:red" class="fa fa-times cursor-pointer" @click="RemoveManagerFromList(index)"></i>
                                    </li>
                                </ul>
                            </div>
                        </form>

                    </div>
                    <!------ المديرون/. ------>
                    <!------ سلطات المدير ------>
                    <div class="col-md-6" style="padding-bottom: 20px">
                        <label class="float-right">سلطات المدير</label>
                        <input v-model="institution.manager_authorities" value="'حسب ما نص عليه العقد'" type="text" class="form-control" required >

                        <div v-if="ValidationErrors.manager_authorities"   style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.manager_authorities[0] }}
                            </h4>
                        </div>
                    </div>
                    <!------ سلطات المدير ------>

                </div>
                <!-----بيانات شركة./ -->
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
                <!------ رقم 300 ------>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="float-right">الرقم المميز 300</label>
                        <input type="text" class="form-control" v-model="institution.number300">
                    </div>
                </div>
                <!------ رقم 300./ ------>
                <!------ رقم التسجيل الضريبي ------>
                <div class="col-md-4" style="padding-bottom: 20px">
                    <label class="float-right mt-2">رقم التسجيل الضريبي</label>
                    <input type="number" class="form-control" v-model="institution.extra_tax_num" required >

                    <div v-if="ValidationErrors.extra_tax_num"   style="margin-top:10px">
                        <h4 class="  font-weight-bold" style="color:red">
                            {{ ValidationErrors.extra_tax_num[0] }}
                        </h4>
                    </div>
                </div>
                <!------ رقم التسجيل الضريبي./ ------>


                <!-- Financial Year info ------>
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
                InstitutionType:'',

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
                   number700:'',
                   postal_box:'',
                   postal_code:'',
                   fax:'',
                   number300:'',
                   capital:'',
                   managers:[],
                   phone:'',
                   merchant_name:'',
                   merchant_birth_date:'',
                   merchant_nationality:'',
                   manager_authorities:'',
                   company_nationality:'',
                   company_period:'',
                   company_start_period:'',
                   company_end_period:'',

               },
                ManagerTemp:{
                    'name':'',
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
                    formData.append('name', this.institution.name);
                    formData.append('type', this.InstitutionType);
                    formData.append('address', this.getAddress);
                    formData.append('postal_box', this.institution.postal_box);
                    formData.append('postal_code', this.institution.postal_code);
                    formData.append('phone', this.institution.phone);
                    formData.append('fax', this.institution.fax);
                    formData.append('business_activity', this.institution.business_activity);
                    formData.append('capital', this.institution.capital);
                    formData.append('manager_authorities',this.institution.manager_authorities);
                    formData.append('extra_tax_num', this.institution.extra_tax_num);
                    formData.append('number300', this.institution.number300);

                    if(this.InstitutionType == 'organization'){
                        formData.append('number700', this.institution.number700);
                        formData.append('merchant_name', this.institution.merchant_name);
                        formData.append('merchant_nationality', this.institution.merchant_nationality);
                        formData.append('merchant_birth_date', this.institution.merchant_birth_date);
                        //manager
                        this.institution.managers = [];
                        let name = this.ManagerTemp.name;
                        this.institution.managers.push({name});
                        formData.append('managers', this.institution.managers);

                    }else if(this.InstitutionType == 'company'){
                        formData.append('legal_entity', this.institution.legal_entity);
                        formData.append('company_nationality', this.institution.company_nationality);
                        formData.append('company_period', this.institution.company_period);
                        formData.append('company_start_period', this.institution.company_start_period);
                        formData.append('company_end_period', this.institution.company_end_period);
                        //managers needd to be implemented
                        formData.append('managers',this.institution.managers);

                    }
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
            },
            AddManagerToList(){
                    let name = this.ManagerTemp.name;
                    this.institution.managers.push(name);
            },
            RemoveManagerFromList(index){
                this.institution.managers.splice(index,1);
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
