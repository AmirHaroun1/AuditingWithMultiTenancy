<template>
    <div class="box" style="margin-top: 20px">
        <div class="box-header">
            <h2 class="pb-3">القوائم المنسدلة</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form v-for="dropdown in SystemDropDowns" @submit.prevent="" class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="header"  type="button" style="cursor:pointer" data-toggle="collapse" :data-target="'#'+dropdown.CollapseLink" aria-expanded="false" aria-controls="collapseExample">قائمة {{dropdown.name}} </h3>
                    </div>

                    <div class="collapse" :id="dropdown.CollapseLink">
                        <div class="col-md-6">
                            <input class="form-control" type="text" v-model="dropdown.NewOption">
                        </div>
                        <div class="col-md-4">
                            <button @click="AddDropDownOption(dropdown)" class="btn btn-success btn-md">أضافة اختيار</button>
                        </div>

                        <div class="col-md-12" style="padding-top: 40px">
                            <div style="padding-top: 20px" class="row" v-for="option in dropdown.CurrentOptions">

                                <div class="col-md-6">
                                    <input class="form-control" type="text" v-model="option.value">
                                </div>
                                <div class="col-md-4 justify-content-between">
                                    <button @click="UpdateDropDownOption(option)" class="btn btn-info btn-md">تعديل</button>
                                    <button @click="DeleteDropDownOption(option,dropdown.CurrentOptions)" class="btn btn-danger btn-md">حذف</button>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <hr>
            </form>


        </div>
    </div>
</template>

<script>
    export default {
        name: "DropDownsManagement",

       data () {
            return{
                SystemDropDowns :[
                    {name:'الكيان القانونى',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:1},
                    {name:'اهتمامات الملاك',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:2},
                    {name:'طبيعة ملكية المنشأة وكيفية تمويلها',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:3},
                    {name:'المدينة',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:4},
                    {name:'الحي',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:5},
                    {name:'محددات معيار القياس',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:6},
                    {name:'معيار القياس',NewOption:'',type:'قائمة منسدلة',CurrentOptions:[],CollapseLink:7},
                    ],

            }
       },
        mounted() {
            this.GetAvailableDropDownOptions();
        },
        methods :{
            GetAvailableDropDownOptions(){
              axios.get(route('system.DropDowns.retrieve.option'))
                .then(({data})=>{
                    data.DropDownsOptions.forEach((option,index)=>{

                        if(option.name == 'الكيان القانونى'){
                            this.SystemDropDowns[0].CurrentOptions.push(option);
                        }
                        else if(option.name == 'اهتمامات الملاك'){
                            this.SystemDropDowns[1].CurrentOptions.push(option);
                        }
                        else if(option.name == 'طبيعة ملكية المنشأة وكيفية تمويلها'){
                            this.SystemDropDowns[2].CurrentOptions.push(option);
                        }
                        else if(option.name == 'المدينة'){
                            this.SystemDropDowns[3].CurrentOptions.push(option);
                        }
                        else if(option.name == 'الحي'){
                            this.SystemDropDowns[4].CurrentOptions.push(option);
                        }
                        else if(option.name == 'محددات معيار القياس'){
                            this.SystemDropDowns[5].CurrentOptions.push(option);
                        }
                        else if(option.name == ' معيار القياس'){
                            this.SystemDropDowns[6].CurrentOptions.push(option);
                        }
                    })
                })
            },
            AddDropDownOption(dropdown){
                let formData = new FormData();

                formData.append('name',dropdown.name);
                formData.append('value',dropdown.NewOption);
                formData.append('type',dropdown.type);

                axios.post(route('system.DropDowns.store.option'),formData)
                        .then(({data})=>{
                            console.log(data[0]);
                            dropdown.CurrentOptions.push(data[0]);
                            this.dropdown.NewOption = '';
                        }).catch((error)=>{

                        })
            },
            DeleteDropDownOption(option,CurrentOptions){
                let formData = new FormData();

                formData.append('_method','DELETE');
                axios.post(route('system.DropDowns.delete.option',option.id),formData)
                    .then((res)=>{
                        CurrentOptions.splice(CurrentOptions.indexOf(option),1)
                    })
                    .catch((error)=>{

                    })
            },
            UpdateDropDownOption(option){
                let formData = new FormData();

                formData.append('_method','PATCH');
                formData.append('name',option.name);
                formData.append('value',option.value);
                formData.append('type',option.type);
                axios.post(route('system.DropDowns.update.option',option.id),formData)
                    .then((res)=>{
                        console.log('updated');
                    })
                    .catch((error)=>{

                    })
            },

        },
        computed :{

        }
    }
</script>

<style scoped>

</style>
