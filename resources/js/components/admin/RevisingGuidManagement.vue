<template>
    <div style="height: 800px">
        <div class="col-md-3">
            <div class="box">
                <div class="box-header text-center main-color-text">
                    <h5>أوراق المراجعة</h5>
                </div>
                <div >
                    <virtual-list style="height: 500px; overflow-y: auto;"
                                  v-on="$listeners"
                                  :data-key="'id'"
                                  :data-sources="AvailableRevisingGuides"
                                  :data-component="ItemComponent"
                    />
                    <div @click="ShowAddModal()" class="text-center" style="border: 4px #00a65a dashed;cursor:pointer;color: #00a65a">
                        <h4 >
                            أضافة نموذج رئيسي
                            <i class="fa fa-plus" style="margin-right:5px"></i>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9" v-if="SelectedItem">
            <div class="box">
                <div v-if="LoadingSpinner" class="overlay">
                    <i class="fa fa-refresh fa-spin">
                    </i>
                </div>

                <div class="box-header text-center">
                    <h4 v-if="SelectedItem.code_alias">{{SelectedItem.code_alias}}</h4>
                    <h4 v-else>{{SelectedItem.code}}</h4>

                    <h4 v-if="SelectedItem.name_alias">{{SelectedItem.name_alias}}</h4>
                    <h4 v-else>{{SelectedItem.name}}</h4>

                    <input v-if="EditMark" v-on:keyup.enter="updateRevisingGuidMark()" class="form-control" v-model="SelectedItem.mark">
                    <h4 v-else @click="EditMark=true" class="cursor-pointer">الدرجة : {{SelectedItem.mark}}</h4>


                    <br>
                        <form @submit.prevent="updateRevisingGuidNotes()" id="NotesForm">
                            <textarea class="form-control" v-model="SelectedItem.first_note" ></textarea>
                            <textarea class="form-control mt-10" v-model="SelectedItem.second_note"></textarea>
                                <button form="NotesForm" class="btn btn-success mt-10 ">حفظ</button>
                        </form>
                </div>

                <div class="box-header mt-20" >
                    <!--------------- First Level --------------->
                        <div class="col-md-12 mt-20" style="border:black dashed 1px;" v-if=" SelectedItem.children.length || child.AddedByUser  "   v-for="child in SelectedItem.children" >

                            <div class="col-md-11" data-toggle="collapse" :href="'#'+child.id">
                                <h5 v-if=" child.name_alias !== null && child.name_alias !==''" class="pt-10 pb-10 font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{child.name_alias}}</h5>

                                <h5 v-else class="pt-10 pb-10 font-weight-bold font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{child.name}}</h5>
                            </div>
                            <div class="col-md-1 "style="justify-content: space-between;display: flex;">

                                    <h4 @click="ShowUpdateChildGuidModal(SelectedItem,child,1)"> <i class="fa fa-edit pt-10 pb-10 cursor-pointer"></i></h4>
                            </div>

                            <!--------------- Second Level --------------->
                            <div  class="collapse fade " :id="child.id">

                                <div class="col-md-11  mb-20 col-xs-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-xs-offset-1" style="border:black dashed 1px;" v-if="child.children.length "   v-for="GrandChild in child.children" >

                                    <div class="col-md-11" data-toggle="collapse" :href="'#'+GrandChild.id">
                                        <h5 v-if=" GrandChild.name_alias !== null && GrandChild.name_alias !==''" class="pt-10 pb-10 font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{GrandChild.name_alias}}</h5>
                                        <h5 v-else class="pt-10 pb-10 font-weight-bold font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{GrandChild.name}}</h5>
                                    </div>
                                    <div class="col-md-1 "style="justify-content: space-between;display: flex;">

                                        <h4 @click="ShowUpdateChildGuidModal(child,GrandChild,2)"> <i class="fa fa-edit pt-10 pb-10 cursor-pointer"></i></h4>
                                    </div>

                                    <!--------------- Third Level --------------->
                                        <div  class="collapse fade " :id="GrandChild.id">

                                            <div class="col-md-10  mb-20 col-xs-10 col-md-offset-2 col-sm-offset-2 col-lg-offset-2 col-xs-offset-2" style="border:black dashed 1px;" v-if="GrandChild.children.length "   v-for="GreatGrandChild in GrandChild.children" >

                                                <div class="col-md-11" data-toggle="collapse" :href="'#'+GreatGrandChild.id">
                                                    <h5 v-if=" GreatGrandChild.name_alias !== null && GreatGrandChild.name_alias !==''" class="pt-10 pb-10 font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{GreatGrandChild.name_alias}}</h5>
                                                    <h5 v-else class="pt-10 pb-10 font-weight-bold font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{GreatGrandChild.name}}</h5>
                                                </div>

                                                <div class="col-md-1 "style="justify-content: space-between;display: flex;">

                                                    <h4 @click="ShowUpdateChildGuidModal(GrandChild,GreatGrandChild,3)"> <i class="fa fa-edit pt-10 pb-10 cursor-pointer"></i></h4>
                                                </div>



                                                <!--------------- Fourth Level --------------->
                                                <div  class="collapse fade " :id="GreatGrandChild.id">
                                                    <div class="col-md-9  mb-20 col-xs-9 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-3" style="border:black dashed 1px;" v-if="GreatGrandChild.children.length && GreatGrandChild.name != '' "   v-for="FinalLevel in GreatGrandChild.children" >

                                                        <div class="col-md-11">
                                                            <h5 v-if=" FinalLevel.name_alias !== null && FinalLevel.name_alias !==''" class="pt-10 pb-10 font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{FinalLevel.name_alias}}</h5>
                                                            <h5 v-else class="pt-10 pb-10 font-weight-bold font-weight-bold cursor-pointer"><i class="fa fa-angle-double-left" style="margin-left:10px"></i>{{FinalLevel.name}}</h5>
                                                        </div>

                                                        <div class="col-md-1 "style="justify-content: space-between;display: flex;">

                                                            <h4 @click="ShowUpdateChildGuidModal(GreatGrandChild,FinalLevel,4)"> <i class="fa fa-edit pt-10 pb-10 cursor-pointer"></i></h4>
                                                        </div>

                                                    </div>
                                                    <!--------------- Add Fourth Level --------------->
                                                    <div class="col-md-9  mb-20 col-xs-9 col-md-offset-3 col-sm-offset-3 col-lg-offset-3 col-xs-offset-3" style="border:black dashed 1px;" >

                                                        <div @click="ShowAddChildOfRevisingGuidModal(GreatGrandChild)" class="text-center mb-10 mt-10" style="border: 2px #00a65a dashed;cursor:pointer;color: #00a65a">
                                                            <h5 >
                                                                أضافة بند جديد
                                                                <i class="fa fa-plus" style="margin-right:5px"></i>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <!--------------- ./Add Fourth Level --------------->

                                                </div>
                                                <!--------------- ./Fourth Level --------------->
                                            </div>

                                            <!--------------- Add ThirdThird Level --------------->
                                            <div class="col-md-10  mb-20 col-xs-10 col-md-offset-2 col-sm-offset-2 col-lg-offset-2 col-xs-offset-2" style="border:black dashed 1px;" >
                                                <div @click="ShowAddChildOfRevisingGuidModal(GrandChild)" class="text-center mb-10 mt-10" style="border: 2px #00a65a dashed;cursor:pointer;color: #00a65a">
                                                    <h5 >
                                                        أضافة بند جديد
                                                        <i class="fa fa-plus" style="margin-right:5px"></i>
                                                    </h5>
                                                </div>
                                            </div>
                                            <!--------------- ./Add ThirdThird Level --------------->

                                        </div>

                                    <!--------------- ./Third Level --------------->

                                </div>
                                <!--------------- Add Second Level --------------->
                                    <div class="col-md-11  mb-20 col-xs-11 col-md-offset-1 col-sm-offset-1 col-lg-offset-1 col-xs-offset-1">
                                        <div @click="ShowAddChildOfRevisingGuidModal(child)" class="text-center mb-10 mt-10" style="border: 2px #00a65a dashed;cursor:pointer;color: #00a65a">
                                            <h5 >
                                                أضافة بند جديد
                                                <i class="fa fa-plus" style="margin-right:5px"></i>
                                            </h5>
                                        </div>
                                    </div>
                                <!--------------- ./Add Second Level --------------->

                            </div>
                            <!--------------- ./Second Level --------------->

                        </div>
                    <!--------------- ./First Level --------------->


                    <!--------------- Add First Level --------------->
                        <div class="col-md-12">
                            <div @click="ShowAddChildOfRevisingGuidModal(SelectedItem)" class="text-center mb-10 mt-10" style="border: 2px #00a65a dashed;cursor:pointer;color: #00a65a">
                                <h5 >
                                    أضافة بند جديد
                                    <i class="fa fa-plus" style="margin-right:5px"></i>
                                </h5>
                            </div>
                        </div>
                    <!--------------- ./Add First Level --------------->

                </div>

            </div>




        </div>
        <!------------ Add Main RevisingGuid Hidden Modal  ---------->
        <h4 type="button" ref="AddMainModalButton" data-toggle="modal" data-target="#AddMainRevisingGuidModal" style="display: none">
            اضافة
        </h4>
        <div class="modal fade bd-example-modal-lg" id="AddMainRevisingGuidModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form @submit.prevent=" Added_revisingGuid.Parent === null ? storeNewRevisingGuid():storeNewChildOfRevisingGuid()">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>الرمز</label>
                                        <input v-model="Added_revisingGuid.code"  class="form-control" required>
                                    </div>


                                    <div class="col-md-12 form-group">
                                        <label>الاسم</label>
                                        <input v-model="Added_revisingGuid.name"  class="form-control" required>
                                    </div>

                                    <div v-if="Added_revisingGuid.Parent" class="col-md-12 form-group">
                                        <label>النوع</label>
                                        <select v-model="Added_revisingGuid.isText"  class="form-control" required>
                                            <option value="0" selected >نعم / لا  / المرجع / لا ينطبق</option>
                                            <option value="1">حقل كتابة</option>
                                        </select>
                                    </div>
                                    <div v-if="Added_revisingGuid.Parent&&Added_revisingGuid.isText == 0" class="col-md-12  form-group">
                                        <label>القيمة</label>
                                        <select v-model="Added_revisingGuid.default_status" class="form-control" required>
                                            <option value="1">نعم</option>
                                            <option value="0">لا</option>
                                            <option value="2">لا ينطبق</option>
                                        </select>
                                    </div>
                                    <div v-if="Added_revisingGuid.Parent&&Added_revisingGuid.isText == 0" class="col-md-12  form-group">
                                        <label>المرجع</label>
                                        <v-select :options="vSelectRevisingGuides" v-model="Added_revisingGuid.default_reference"  style="width: 100%" >

                                        </v-select>

                                    </div>

                                </div>
                                <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ref="CloseAddRevisingGuidModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ /. Add RevisingGuid Hidden Modal  ---------->

        <!------------ Edit RevisingGuid Hidden Modal  ---------->
        <h4 type="button" ref="EditModalButton" data-toggle="modal" data-target="#EditRevisingGuidModal" style="display: none">
            تعديل
        </h4>
        <div class="modal fade" id="EditRevisingGuidModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form @submit.prevent="updateRevisingGuid()">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>الرمز</label>
                                        <input v-model="temp_revisingGuid.code_alias"  class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label>الاسم</label>
                                        <input v-model="temp_revisingGuid.name_alias"  class="form-control">
                                    </div>
                                    <div v-if="temp_revisingGuid.Parent!==null" class="col-md-12 form-group">
                                        <label>النوع</label>
                                        <select v-model="temp_revisingGuid.isText"  class="form-control" required>
                                            <option value="0" selected>نعم / لا  / المرجع / لا ينطبق</option>
                                            <option value="1">حقل كتابة</option>
                                        </select>
                                    </div>
                                    <div v-if="temp_revisingGuid.Parent!==null&&temp_revisingGuid.isText == 0" class="col-md-12  form-group">
                                        <label>القيمة</label>
                                        <select v-model="temp_revisingGuid.default_status" class="form-control" required>
                                            <option value="1">نعم</option>
                                            <option value="0">لا</option>
                                            <option value="2">لا ينطبق</option>
                                        </select>
                                    </div>
                                    <div v-if="temp_revisingGuid.Parent!==null&&temp_revisingGuid.isText == 0" class="col-md-12  form-group">
                                        <label>المرجع</label>
                                        <v-select :options="vSelectRevisingGuides" v-model="temp_revisingGuid.default_reference" style="width: 100%" required :required="true"></v-select>

                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-block btn-success btn-lg" style="width:130px;height:50px" >حفظ</button>
                                </div>
                                <div v-if="temp_revisingGuid.AddedByUser||temp_revisingGuid.Parent" class="col-md-6">
                                    <form id="DeleteForm" @submit.prevent="[ temp_revisingGuid.Parent === null ? DeleteRevisingGuid():DeleteChildOfRevisingGuid()]">

                                        <button type="submit" class="btn btn-block btn-danger btn-lg pull-left" style="width:130px;height:50px" >حذف</button>

                                    </form>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ref="CloseRevisingGuidModal" type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------ /. Edit RevisingGuid Hidden Modal  ---------->
    </div>
</template>

<script>
    import VirtualList from 'vue-virtual-scroll-list'
    import MenuItem from './MenuItem'

    export default {

        name: "RevisingGuidManagement",

        components: { 'virtual-list': VirtualList ,'MenuItem':MenuItem},
        props:{'AllRevisingGuides':''},
        data(){
            return{
                AvailableRevisingGuides : this.AllRevisingGuides,
                vSelectRevisingGuides:[],
                LoadingSpinner: false,
                ItemComponent: MenuItem,
                SelectedItem:null,
                Added_revisingGuid : {'id':'','name':'','code':'','Parent':null,'children':[],'AddedByUser':1,'isText':'','default_status':'','default_reference':{'label':'','code':''}},

                temp_revisingGuid : {'id':'','name_alias':'','code_alias':'','Parent':null,'level':'','AddedByUser':'','isText':'','default_status':'','default_reference':{'label':'','code':''}},

                edited_item:null,
                EditMark : false,
            }
        },
        created () {

            this.FlatRevisingGuidArray();
            // detecting change checked value from item component event.
            this.$on('UpdateRevisingGuid', (RevisingGuid) => {

                this.ShowUpdateGuidModal(RevisingGuid);

            })
            this.$on('SelectedRevisingGuid', (RevisingGuid) => {

                this.SelectedItem = RevisingGuid;
            })
        },
        methods : {
            FlatRevisingGuidArray(){
                this.LoadingSpinner = true;

                this.AvailableRevisingGuides.forEach( ParentItem =>{

                    this.vSelectRevisingGuides.push({'label': (ParentItem.code_alias ? ParentItem.code_alias : ParentItem.code) + ' - '+  (ParentItem.name_alias ? ParentItem.name_alias : ParentItem.name) , 'code':(ParentItem.code_alias ? ParentItem.code_alias : ParentItem.code) });
                    ParentItem.children.forEach( ChildItem =>{

                        this.vSelectRevisingGuides.push({'label': (ChildItem.code_alias ? ChildItem.code_alias : ChildItem.code) + ' - '+  (ChildItem.name_alias ? ChildItem.name_alias : ChildItem.name) , 'code':(ChildItem.code_alias ? ChildItem.code_alias : ChildItem.code) });
                    })
                })
                this.LoadingSpinner = false;
            },
            ShowAddModal(){
                this.Added_revisingGuid.id = '',
                this.Added_revisingGuid.name = '',
                this.Added_revisingGuid.code = '',
                this.Added_revisingGuid.id = '',
                this.Added_revisingGuid.name = '',
                this.Added_revisingGuid.code = '',
                this.Added_revisingGuid.isText = '',
                this.Added_revisingGuid.default_status = '',
                this.Added_revisingGuid.default_reference = '',
                this.Added_revisingGuid.Parent = null,

                this.$refs.AddMainModalButton.click();
            },
            ShowAddChildOfRevisingGuidModal(Parent){

                this.Added_revisingGuid.id = '',
                    this.Added_revisingGuid.name = '',
                    this.Added_revisingGuid.code = '',
                    this.Added_revisingGuid.isText = '',
                    this.Added_revisingGuid.default_status = '',
                    this.Added_revisingGuid.default_reference = '',

                    this.Added_revisingGuid.Parent = Parent,
                    this.$refs.AddMainModalButton.click();

            },
            ShowUpdateGuidModal(RevisingGuid){
                this.$refs.EditModalButton.click();

                this.temp_revisingGuid.id = RevisingGuid.id;
                this.temp_revisingGuid.name_alias = RevisingGuid.name_alias;
                this.temp_revisingGuid.name = RevisingGuid.name;
                this.temp_revisingGuid.code_alias = RevisingGuid.code_alias;
                this.temp_revisingGuid.code = RevisingGuid.code;
                this.temp_revisingGuid.AddedByUser = RevisingGuid.AddedByUser;

                this.edited_item = RevisingGuid;
            },
            ShowUpdateChildGuidModal(Parent,RevisingGuid,level){
                this.$refs.EditModalButton.click();

                this.temp_revisingGuid.id = RevisingGuid.id;
                this.temp_revisingGuid.Parent = Parent;
                this.temp_revisingGuid.level = level;
                this.temp_revisingGuid.name_alias = RevisingGuid.name_alias;
                this.temp_revisingGuid.code_alias = RevisingGuid.code_alias;
                this.temp_revisingGuid.AddedByUser = RevisingGuid.AddedByUser;
                this.temp_revisingGuid.isText = RevisingGuid.isText;
                this.temp_revisingGuid.default_status = RevisingGuid.default_status;
                this.temp_revisingGuid.default_reference = RevisingGuid.default_reference;

                this.edited_item = RevisingGuid;
            },
            storeNewRevisingGuid(){

                let formData = new FormData();

                formData.append('name',this.Added_revisingGuid.name);
                formData.append('code',this.Added_revisingGuid.code);
                formData.append('AddedByUser',1);

                axios.post(route('revisingGuid.store.admin'),formData)
                    .then(({data})=>{
                        this.AvailableRevisingGuides.push({'id':data[0].id,'name':this.Added_revisingGuid.name,'code':this.Added_revisingGuid.code,'AddedByUser':1,'code_alias':'','name_alias':'','children':[]});
                        this.$toast.success('.','تم اضافة نموذج بنجاح',{timeout:3000});
                    }).catch(error=>{
                    this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                     })
                this.$refs.CloseAddRevisingGuidModal.click();
            },
            storeNewChildOfRevisingGuid(){

                let formData = new FormData();

                formData.append('name_alias',this.Added_revisingGuid.name);
                formData.append('code_alias',this.Added_revisingGuid.code);
                formData.append('parent_id',this.Added_revisingGuid.Parent.id);
                formData.append('isText',this.Added_revisingGuid.isText);
                formData.append('default_status',this.Added_revisingGuid.default_status);
                if(this.Added_revisingGuid.default_reference !== null && this.Added_revisingGuid.default_reference !== '' &&  this.temp_revisingGuid.Added_revisingGuid !== undefined){
                    formData.append('default_reference',this.temp_revisingGuid.default_reference.code ? this.temp_revisingGuid.default_reference.code : this.temp_revisingGuid.default_reference );
                }else{
                    formData.append('default_reference','');
                }
                formData.append('AddedByUser',1);

                axios.post(route('revisingGuid.store.admin'),formData)
                    .then(({data})=>{
                        this.Added_revisingGuid.Parent.children.push({'id':data[0].id,'name_alias':this.Added_revisingGuid.name,'code_alias':this.Added_revisingGuid.code,'AddedByUser':1,'code':'','name':'','isText':this.Added_revisingGuid.isText,'default_status':this.Added_revisingGuid.default_status,'default_reference':this.Added_revisingGuid.default_reference.code,'children':[]});
                        console.log(this.Added_revisingGuid.Parent.children);

                        this.$toast.success('.','تم اضافة نموذج بنجاح',{timeout:3000});
                    }).catch(error=>{
                    this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                });
                this.$refs.CloseAddRevisingGuidModal.click();
            },
            updateRevisingGuid(){

                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('code_alias',this.temp_revisingGuid.code_alias ? this.temp_revisingGuid.code_alias : '');
                formData.append('name_alias',this.temp_revisingGuid.name_alias ? this.temp_revisingGuid.name_alias : '');
                formData.append('isText',this.temp_revisingGuid.isText);
                formData.append('default_status',this.temp_revisingGuid.default_status);
                if(this.temp_revisingGuid.default_reference !== null && this.temp_revisingGuid.default_reference !== '' &&  this.temp_revisingGuid.default_reference !== undefined){
                    formData.append('default_reference',this.temp_revisingGuid.default_reference.code ? this.temp_revisingGuid.default_reference.code : this.temp_revisingGuid.default_reference );
                }else{
                    formData.append('default_reference','');
                }

                axios.post(route('revisingGuid.update.admin',this.temp_revisingGuid.id),formData)
                    .then(res =>{
                        console.log(res);

                        this.edited_item.code_alias = this.temp_revisingGuid.code_alias;
                        this.edited_item.name_alias = this.temp_revisingGuid.name_alias;
                        this.edited_item.isText = this.temp_revisingGuid.isText;
                        this.edited_item.default_status = this.temp_revisingGuid.default_status;
                        this.edited_item.default_reference = this.temp_revisingGuid.default_reference;

                        this.temp_revisingGuid.code_alias = '';
                        this.temp_revisingGuid.name_alias = '';
                        this.temp_revisingGuid.isText = '';
                        this.temp_revisingGuid.default_status = '';
                        this.temp_revisingGuid.default_reference = '';
                        this.$toast.success('.','تم التعديل بنجاح',{timeout:3000});

                    })
                    .catch(error =>{
                        this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                        console.log(error);

                        this.edited_item = null;
                        this.temp_revisingGuid.code_alias = '';
                        this.temp_revisingGuid.name_alias = '';
                        this.temp_revisingGuid.isText = '';
                        this.temp_revisingGuid.default_status = '';
                        this.temp_revisingGuid.default_reference = '';
                    })
                this.$refs.CloseRevisingGuidModal.click();
            },
            updateRevisingGuidNotes(){

                let formData = new FormData();
                formData.append('_method',"PATCH");
                    formData.append('first_note',this.SelectedItem.first_note ? this.SelectedItem.first_note:'' );

                    formData.append('second_note',this.SelectedItem.second_note ? this.SelectedItem.second_note : '');
                axios.post(route('revisingGuid.update.admin',this.SelectedItem.id),formData)
                    .then(res =>{
                        console.log(res);
                        this.$toast.success('.','تم التعديل بنجاح',{timeout:3000});

                    })
                    .catch(error =>{
                        this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                        console.log(error);

                    })

            },
            updateRevisingGuidMark(){

                let formData = new FormData();
                formData.append('_method',"PATCH");
                formData.append('mark',this.SelectedItem.mark);
                axios.post(route('revisingGuid.update.admin',this.SelectedItem.id),formData)
                    .then(res =>{
                        console.log(res);
                        this.$toast.success('.','تم التعديل بنجاح',{timeout:3000});
                    })
                    .catch(error =>{
                        this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                        console.log(error);
                    })
                this.EditMark = false;

            },
            DeleteRevisingGuid(){
                this.$refs.CloseRevisingGuidModal.click();
                let i = this.AvailableRevisingGuides.findIndex(child => child.id === this.temp_revisingGuid.id);

                this.$toast.question('.','تأكيد الحذف ',{
                    timeout: 40000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                            axios.delete(route('revisingGuid.destroy.admin',this.temp_revisingGuid.id))
                                .then(res =>{
                                    console.log(res);

                                    this.AvailableRevisingGuides.splice(i, 1) // remove it from array
                                    this.$toast.success('.','تم الحذف بنجاح',{timeout:3000});

                                })
                                .catch(error=>{
                                    console.log(error);

                                    this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                                })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });

            },
            DeleteChildOfRevisingGuid(){
                this.$refs.CloseRevisingGuidModal.click();

                let i = this.temp_revisingGuid.Parent.children.findIndex(child => child.id === this.temp_revisingGuid.id);

                this.$toast.question('.','تأكيد الحذف ',{
                    timeout: 40000,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    position: 'center',
                    buttons: [
                        ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                            axios.delete(route('revisingGuid.destroy.admin',this.temp_revisingGuid.id))
                                .then(res =>{
                                    console.log(res);

                                    this.temp_revisingGuid.Parent.children.splice(i, 1) // remove it from array
                                    this.$toast.success('.','تم الحذف بنجاح',{timeout:3000});

                                })
                                .catch(error=>{
                                    console.log(error);

                                    this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                                })
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }, true],
                        ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        }],
                    ],
                });
            },

        }
    }
</script>

<style scoped>

</style>
