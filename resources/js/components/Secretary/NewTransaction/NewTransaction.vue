<template>
    <div>

        <!-- Find Trade Register Section -->
            <div id="SearchTradeRegister">


                <div class="row ">

                    <form @submit.prevent="SearchTradeRegister()">
                    <div class="col-md-12">
                        <h3>أدخل رقم السجل الرئيسي للمنشأة</h3>
                            <input class="form-control" v-model="TradeRegisterInput" type="text">
                        <div v-if="ValidationErrors.RegisterNumber"  class=" " style="margin-top:10px">
                            <h4 class="  font-weight-bold" style="color:red">
                                {{ ValidationErrors.RegisterNumber[0] }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-block btn-lg btn-success" style="margin-top: 10px">التالي</button>
                    </div>
                    </form>
                </div>

                <div v-if="LoadingSpinner" class="overlay text-center" style="padding-top:200px">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>

            </div>
        <!-- /.Find Trade Register Section -->

        <!-- New Company Section -->
        <div v-if="IsNewRegister"  id="NewCompany" style="padding-top:20px">
            <div class="row">
                <div class="col-md-12">
                    <!-- ٍStages Count Section -->
                    <div id="StagesCount" style="padding-bottom: 70px" >
                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-md-2 ">
                                    <div :class="[ (this.SectionStage == 1) ? ActiveCircle : NonActiveCircle]" >1</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 1) ? ActiveHeading : '']">بيانات الشركة</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div :class="[ (this.SectionStage == 2) ? ActiveCircle : NonActiveCircle]">2</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 2) ? ActiveHeading : '']">ضابط الأتصال</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div :class="[ (this.SectionStage == 3) ? ActiveCircle : NonActiveCircle]">3</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 3) ? ActiveHeading : '']">تحميل المستندات</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div :class="[ (this.SectionStage == 4) ? ActiveCircle : NonActiveCircle]">4</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 4) ? ActiveHeading : '']">شاشة الدفع</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Stages Count Section -->
                    <div v-if="SectionStage == 1" id="NewCompany_TransactionFirstStage">
                        <new-company-form></new-company-form>
                    </div>
                    <div v-else-if="SectionStage == 2" id="NewAgent_TransactionSecondStage">
                        <new-agent-form></new-agent-form>
                    </div>
                    <div v-else-if="SectionStage == 3" id="NewDocuments_TransactionFourthStage">
                        <documents-management-section></documents-management-section>
                    </div>
                    <div v-else-if="SectionStage == 4" id="Payment_TransactionFifthStage">
                        <payment-details-form :Transaction="Transaction"></payment-details-form>
                    </div>

                </div>
            </div>
        </div>

        <!-- /.New Company Section -->

        <!-- /.Existing Company Section -->
        <div v-else-if="IsNewRegister == false"  id="ExistingCompany" style="padding-top:20px">
            <div class="row">
                <div class="col-md-12">
                    <!-- ٍStages Count Section -->
                    <div id="ExistingCompanyStagesCount" style="padding-bottom: 70px" >
                        <div class="col-md-2">
                            <div class="row">
                                <div class="col-md-2 ">
                                    <div :class="[ (this.SectionStage == 1) ? ActiveCircle : NonActiveCircle]" >1</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 1) ? ActiveHeading : '']">بيانات الشركة</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div :class="[ (this.SectionStage == 2) ? ActiveCircle : NonActiveCircle]">2</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 2) ? ActiveHeading : '']">ضابط الأتصال</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div :class="[ (this.SectionStage == 3) ? ActiveCircle : NonActiveCircle]">3</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 3) ? ActiveHeading : '']">تحميل المستندات</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="row">
                                <div class="col-md-2">
                                    <div :class="[ (this.SectionStage == 4) ? ActiveCircle : NonActiveCircle]">4</div>
                                </div>
                                <div class="col-md-10">
                                    <h4 class="text-center" :class="[(this.SectionStage == 4) ? ActiveHeading : '']">شاشة الدفع</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- ./Stages Count Section -->
                    <div v-if="SectionStage == 1" id="ExistingCompany_FirstSection">
                        <existing-company-form></existing-company-form>
                    </div><!-- ./Stages Count Section -->
                    <div v-if="SectionStage == 2" id="EditAgent_SecondSection">

                        <edit-agent-form v-if="this.Agent"></edit-agent-form>
                        <new-agent-form v-else-if="this.Agent == null"></new-agent-form>
                    </div>
                    <div v-else-if="SectionStage == 3" id="NewDocumentsExistingCompany_TransactionFourthStage">
                        <documents-management-section></documents-management-section>
                    </div>
                    <div v-else-if="SectionStage == 4" id="PaymentExistingCompany_TransactionFifthStage">
                        <payment-details-form :Transaction="Transaction"></payment-details-form>
                    </div>

                </div>
            </div>

        </div>
        <!-- /.Existing Company Section -->

    </div>

</template>


<script>

    export default {
        data()
        {
            return {
                LoadingSpinner:false,
                ValidationErrors :'',
                IsNewRegister : null,
                TradeRegisterInput: '',

                TradeRegister : '',

                SectionStage: 1,

                Institution: '',
                Agent:'',
                Transaction : '',

                NonActiveCircle: {
                    'numberCircle': true,
                },
                ActiveCircle: {
                    'activeNumberCircle': true,
                },
                ActiveHeading: {
                    'activeNumberHeading': true,
                },

            }
        },
        name: "NewTransaction.vue",
        methods:{
            SearchTradeRegister(){

                this.IsNewRegister = null;
                this.LoadingSpinner=true;
                let formData = new FormData();
                formData.append('RegisterNumber',this.TradeRegisterInput);
                axios.post(route('TradeRegister.search'),formData)
                    .then(({data}) => {

                        if( data.TradeRegister[0]){
                            this.LoadingSpinner=false;

                            this.TradeRegister = '';

                            this. SectionStage =1;

                            this.Institution ='';
                            this.Agent = '';
                            this.Transaction = '';

                            this.TradeRegister = data.TradeRegister[0];
                            this.Institution = data.TradeRegister[0].institution;
                            this.Agent = data.TradeRegister[0].institution.agent;
                            this.IsNewRegister = false;

                            this.$toast.success('<i class="fa fa-building"></i>','بدء معاملة لصالح منشأة مسجلة',{timout:3000});
                            this.ValidationErrors = '';

                        }
                        else{
                            this.LoadingSpinner=false;

                            this.TradeRegister = '';

                            this. SectionStage =1;

                            this.Institution ='';
                            this.Agent = '';
                            this.Transaction = '';

                            this.$toast.success('<i class="fa fa-building"></i>','بدء معاملة لصالح منشأة جديدة',{timout:3000});
                            this.IsNewRegister = true;
                            this.ValidationErrors = '';

                        }
                    })
                    .catch((error) =>{
                       //this.$toast.error(error.response.data.errors.RegisterNumber,'خطأ',{timout:3000});
                        this.ValidationErrors = error.response.data.errors;
                    })
            }
        },
        computed:{

        },
    }
</script>

<style scoped>

</style>
