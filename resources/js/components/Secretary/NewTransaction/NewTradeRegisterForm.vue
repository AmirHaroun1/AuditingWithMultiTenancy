<template>
<div>

    <div v-if="MainTradeRegister_NOT_ADDED" id="MainTradeRegisterSection">
        <div class="box" style="margin-top: 20px">
            <div class="box-header">
                <h2>بيانات سجل الشركة الرئيسي</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-group" @submit.prevent="CreateNewTradeRegister(MainTradeRegister)" >
                    <div class="row">

                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">رقم السجل رئيسي</label>
                            <input v-model="MainTradeRegister.number" type="number" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">تاريخ الصدور </label>
                            <input v-model="MainTradeRegister.date" type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">مكان الصدور</label>
                            <input v-model="MainTradeRegister.production_place" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button  class="btn  btn-success btn-lg" style="padding: 15px;width:230px">  إضافة سجل رئيسي</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div v-else  id="BranchedTradeRegisterSection">
        <div class="box" style="margin-top: 20px">
            <div class="box-header">
                <h2>إضافة سجل الشركة الفرعي (أختياري)</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="form-group" @submit.prevent="CreateNewTradeRegister(BranchedTradeRegister)" >
                    <div class="row">

                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">رقم السجل الفرعي</label>
                            <input v-model="BranchedTradeRegister.number" type="number" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">تاريخ الصدور</label>
                            <input v-model="BranchedTradeRegister.date" type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6" style="padding-bottom: 20px">
                            <label class="float-right">مكان الصدور</label>
                            <input v-model="BranchedTradeRegister.production_place" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" v-for="(AddedBranchedTradeRegister,index) in NewBranchedTradeRegisters">

                            <ul class="list-group">
                                <li class="list-group-item">
                                    -
                                     {{index + 1}}
                                    -
                                    رقم السجل فرعى :
                                    {{AddedBranchedTradeRegister.number}}
                                    ,
                                    عنوان الصدور :
                                    {{AddedBranchedTradeRegister.production_place}}
                                    ,
                                    تاريخ الصدور :
                                    {{AddedBranchedTradeRegister.date}}

                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="row text-center ">
                        <button  class="btn  btn-warning btn-lg" style="padding: 15px;width:230px" >  إضافة سجل فرعي</button>
                    </div>

                </form>
                <div class="row text-center" style="margin-top:30px">
                    <button @click="NextStage()"  class="btn  btn-success btn-lg" style="padding: 15px;width:230px" >تخطي</button>
                </div>
            </div>
        </div>
    </div>

</div>


</template>

<script>
    export default {
        name: "NewTradeRegisterForm.vue",

        data()
        {
            return{
                MainTradeRegister : {
                    number: '',
                    date: '',
                    production_place: '',
                    type: 'رئيسي',
                },

                MainTradeRegister_NOT_ADDED : true,

                BranchedTradeRegister : {
                    number: '',
                    date: '',
                    production_place: '',
                    type: 'فرعي',
                },

                NewBranchedTradeRegisters : [],
            }
        },
        methods :{
            CreateNewTradeRegister(TradeRegister){
                var formData = new FormData();

                formData.append('number', TradeRegister.number);
                formData.append('date', TradeRegister.date);
                formData.append('production_place',TradeRegister.production_place);
                formData.append('type',TradeRegister.type);

                axios.post(route('TradeRegister.store',this.$parent.New_institution),
                    formData
                ).then(({data}) => {

                    console.log(data);
                    if( data.type  == 'فرعي'  ){

                        this.NewBranchedTradeRegisters.push({data});
                        this.ClearBranchedRegisterInput();
                        alert('Branched TradeRegister Has Been Added Successfully');

                    }
                    if ( data.type  == 'رئيسي'){

                        this.MainTradeRegister_NOT_ADDED = false;

                        alert('Master TradeRegister Has Been Added Successfully');

                    }

                }).catch((error) => {
                    console.log(error);
                });
            },
            ClearBranchedRegisterInput(){
                this.BranchedTradeRegister.number = '',
                this.BranchedTradeRegister.date = '',
                this.BranchedTradeRegister.production_place = ''
            },
            NextStage(){
                this.$parent.SectionStage = 4;
            }
        },

    }
</script>

<style scoped>

</style>
