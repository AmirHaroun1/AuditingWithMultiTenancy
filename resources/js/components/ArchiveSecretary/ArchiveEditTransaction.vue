<template>
    <div style="height: 800px">
        <div class="col-md-3">
                <div class="box">
                    <div class="box-header text-center main-color-text">
                        <h5>أوراق المراجعة</h5>
                    </div>
                        <virtual-list style="height: 500px; overflow-y: auto;"
                                      v-on="$listeners"
                                      :data-key="'code'"
                                      :data-sources="ListItems"
                                      :data-component="ItemComponent"
                        />


                </div>
            </div>
            <div v-if="LoadingSpinner" class="overlay text-center">
                <i class="fa fa-refresh fa-spin">
                </i>
            </div>
            <div  class="col-md-9" v-if="SelectedItem">
                <div style="direction: rtl" class="box" id="printHeading">
                    <div v-if="LoadingSpinner" class="overlay">
                        <i class="fa fa-refresh fa-spin">
                        </i>
                    </div>
                    <div  class="box-header text-center ">
                        <i class="fa fa-print cursor-pointer" @click="printHeading()"></i>
                        <h4 v-if="SelectedItem.code_alias">{{SelectedItem.code_alias}}</h4>
                        <h4 v-else>{{SelectedItem.code}}</h4>

                        <h4 v-if="SelectedItem.name_alias">{{SelectedItem.name_alias}}</h4>
                        <h4 v-else>{{SelectedItem.name}}</h4>

                        <h4>الدرجة : <b style="color:green">{{TotalMarks}}</b>/{{SelectedItem.mark}}</h4>


                        <br>

                        <h5 class="text-center">{{SelectedItem.first_note}}</h5>
                        <h5  class="text-center">{{SelectedItem.second_note}}</h5>
                    </div>
                    <div class="box-body">
                        <!------------ in case of files -------------------->
                       <div  class="col-md-12" v-for="file in SelectedItem.files">
                           <div v-if="getFileExtension(file.DocumentPath) == 'pdf'">

                               <iframe :src="FileURL(file.DocumentPath)" type="application/pdf" width="100%" height="500px">
                               </iframe>

                           </div>
                           <br>
                           <div class="text-center" v-if="getFileExtension(file.DocumentPath) == 'png'||getFileExtension(file.DocumentPath) == 'jpg'||getFileExtension(file.DocumentPath) == 'jpeg'||getFileExtension(file.DocumentPath) == 'svg'">
                               <img width="75%"  :src="FileURL(file.DocumentPath)" />
                           </div>
                           <div class="col-md-12" v-else-if="getFileExtension(file.DocumentPath) != 'pdf'">
                               <h2>رابط التنزيل</h2>
                               <a :href="FileURL(file.DocumentPath)">رابط</a>
                           </div>
                       </div>
                        <!------------ ./in case of files -------------------->
                        <!--------------- two nested levels ------------------------->
                        <div v-if="SelectedItem.code == 'ع2-1' || SelectedItem.AddedByUser" class="col-md-12">
                           <div v-for="item in SelectedItem.children">



                               <h4 v-if="item.name_alias" class="mb-20">{{item.name_alias}} : </h4>
                               <h4 v-else class="mb-10">{{item.name}} : </h4>

                               <table style="direction: rtl"  class="table table-bordered">
                                    <tbody >
                                        <tr>
                                            <th class="text-center">البيان</th>
                                            <th class="text-center">نعم</th>
                                            <th class="text-center">لا</th>
                                            <th class="text-center">المرجع</th>
                                            <th class="text-center">لا ينطبق</th>
                                        </tr>
                                        <tr  v-for="(ChildItem,index) in item.children">
                                            <td style="width:50%">
                                                <p v-if="ChildItem.name_alias">{{ChildItem.name_alias}}</p>
                                                <p v-else>{{ChildItem.name}}</p>

                                                <i v-if="ChildItem.ProcessStatus" class="fa fa-refresh fa-spin">
                                                </i>
                                                <div class="mt-10" v-if="ChildItem.children.length">
                                                    <hr>

                                                    <div style="margin-right: 30px;" v-for="innerItem in ChildItem.children">

                                                        <p v-if="innerItem.name_alias">{{innerItem.name_alias}}</p>
                                                        <p v-else>{{innerItem.name}}</p>
                                                        <i v-if="innerItem.ProcessStatus" class="fa fa-refresh fa-spin">
                                                        </i>
                                                    </div>

                                                </div>
                                            </td>
                                            <!--------- if it's a text area --------->
                                            <td v-if="ChildItem.isText == 1" colspan="3" >

                                                <div v-if="!PrintingMood">
                                                    <textarea v-if="!ChildItem.transactions.length" v-model="item.text" class="form-control"></textarea>

                                                    <textarea v-else v-model="ChildItem.transactions[0].pivot.text" class="form-control"></textarea>

                                                </div>
                                                <div v-else>
                                                    <textarea v-if="!ChildItem.transactions.length" class="form-control">{{item.text}}</textarea>

                                                    <textarea v-else class="form-control">{{ChildItem.transactions[0].pivot.text}}</textarea>


                                                </div>

                                                <div class="mt-10" v-if="ChildItem.children.length">
                                                    <div  v-for="innerItem in ChildItem.children">
                                                        <hr>
                                                            <div v-if="!PrintingMood">
                                                                <textarea v-if="!innerItem.transactions.length" v-model="innerItem.text" class="form-control"></textarea>

                                                                <textarea v-else v-model="innerItem.transactions[0].pivot.text" class="form-control"></textarea>
                                                                <a @click="innerItem.transactions.length? UpdateExistingTransactionArchiveRecord(innerItem,0) : AddNewTransactionArchiveRecord(innerItem,0)" class="btn btn-success btn-sm">حفظ</a>

                                                            </div>
                                                            <div v-else>
                                                            <textarea v-if="!innerItem.transactions.length" class="form-control">{{innerItem.text}}</textarea>

                                                            <textarea v-else class="form-control">{{innerItem.transactions[0].pivot.text}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td v-if="ChildItem.isText == 1 && !PrintingMood">
                                                <a @click="ChildItem.transactions.length? UpdateExistingTransactionArchiveRecord(ChildItem,null) : AddNewTransactionArchiveRecord(ChildItem,null)" class="btn btn-success btn-sm">حفظ</a>
                                            </td>
                                            <!--------- ./if it's a text area --------->
                                            <!--------- if it's a choice area --------->
                                            <td v-if="!ChildItem.isText" class="text-center " style="width:5%">
                                                <div v-if="!PrintingMood">
                                                    <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(ChildItem,1) " type="checkbox">
                                                    <input v-else :checked="ChildItem.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,1)" >
                                                </div>

                                                <!--------- Printing Mood ---------->
                                                <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 1 " checked >
                                                <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 1 && !ChildItem.transactions.length" checked>

                                                <!-------- in case of nested loops --------->
                                                <div v-if="ChildItem.children.length">

                                                    <div class="mt-10" v-for="innerItem in ChildItem.children">
                                                        <hr>
                                                        <div v-if="!PrintingMood">
                                                            <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(innerItem,1) " type="checkbox">
                                                            <input v-else :checked="innerItem.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,1)" >
                                                        </div>
                                                        <!--------- Printing Mood ---------->
                                                        <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 1 " checked >
                                                        <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 1 && !innerItem.transactions.length" checked>

                                                    </div>

                                                </div>
                                                <!-------- ./in case of nested loops --------->
                                            </td>

                                            <td v-if="!ChildItem.isText" class="text-center" style="width:5%">
                                                <div v-if="!PrintingMood">
                                                    <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(ChildItem,0) " type="checkbox">
                                                    <input v-else :checked="ChildItem.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,0)" >
                                                </div>
                                                <!--------- Printing Mood ---------->
                                                <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 0 " checked >
                                                <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 0 && !ChildItem.transactions.length" checked>

                                                <!-------- in case of nested loops --------->
                                                <div v-if="ChildItem.children.length">
                                                    <div class="mt-10" v-for="innerItem in ChildItem.children">
                                                        <hr>
                                                        <div v-if="!PrintingMood">
                                                            <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(innerItem,0) " type="checkbox">
                                                            <input v-else :checked="innerItem.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,0)" >
                                                        </div>
                                                        <!--------- Printing Mood ---------->
                                                        <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 0 " checked >
                                                        <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 0 && !innerItem.transactions.length" checked>

                                                    </div>
                                                </div>
                                                <!-------- ./in case of nested loops --------->
                                            </td>

                                            <td v-if="!ChildItem.isText" class="text-center" style="width:35%">

                                                <div v-if="!PrintingMood">

                                                    <v-select  v-if="ChildItem.transactions.length" @input="UpdateExistingTransactionArchiveRecord(ChildItem,ChildItem.transactions[0].pivot.status)" :options="AvailableRevisingGuides" v-model="ChildItem.transactions[0].pivot.reference" style="width: 100%" ></v-select>
                                                    <v-select v-else :options="AvailableRevisingGuides" v-model="ChildItem.default_reference" style="width: 100%" @input="AddNewTransactionArchiveRecord(ChildItem,false)" ></v-select>
                                                    <!-------- in case of nested loops --------->
                                                    <div v-if="ChildItem.children.length">
                                                        <div  v-for="innerItem in ChildItem.children">

                                                            <hr style="margin-top:20px;margin-bottom:10px">
                                                            <div  v-if="!PrintingMood">
                                                                <v-select  v-if="innerItem.transactions.length" @input="UpdateExistingTransactionArchiveRecord(innerItem,innerItem.transactions[0].pivot.status)" :options="AvailableRevisingGuides" v-model="innerItem.transactions[0].pivot.reference" style="width: 100%" ></v-select>
                                                                <v-select v-else :options="AvailableRevisingGuides" v-model="innerItem.default_reference" style="width: 100%" @input="AddNewTransactionArchiveRecord(innerItem,false)" ></v-select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-------- ./in case of nested loops --------->

                                                </div>
                                                <div v-else>

                                                    <div v-if="ChildItem.transactions.length">
                                                        <h3 v-if="ChildItem.transactions[0].pivot.reference == null "></h3>
                                                        <h3 v-else-if="ChildItem.transactions[0].pivot.reference.code">{{ChildItem.transactions[0].pivot.reference.code}}</h3>
                                                        <h3 v-else-if="ChildItem.transactions[0].pivot.reference">{{ChildItem.transactions[0].pivot.reference}}</h3>
                                                    </div>
                                                    <h3 v-else-if="ChildItem.default_reference!== null && ChildItem.default_reference.code">{{ChildItem.default_reference.code}}</h3>
                                                    <h3 v-else-if=" ChildItem.default_reference">{{ChildItem.default_reference}}</h3>

                                                    <!-------- in case of nested loops --------->
                                                    <div  v-for="innerItem in ChildItem.children">
                                                        <hr style="margin-top:20px;margin-bottom:10px">

                                                        <div v-if="ChildItem.transactions.length">

                                                            <h3 v-if="innerItem.transactions[0].pivot.reference==null"></h3>
                                                            <h3 v-if="innerItem.transactions[0].pivot.reference.code">{{innerItem.transactions[0].pivot.reference.code}}</h3>
                                                            <h3 v-else-if="innerItem.transactions[0].pivot.reference">{{innerItem.transactions[0].pivot.reference}}</h3>

                                                        </div>
                                                        <h3 v-else-if="innerItem.default_reference!== null && innerItem.default_reference.code">{{innerItem.default_reference.code}}</h3>
                                                        <h3 v-else-if=" innerItem.default_reference">{{innerItem.default_reference}}</h3>

                                                    </div>
                                                    <!-------- ./in case of nested loops --------->


                                                </div>


                                            </td>

                                            <td v-if="!ChildItem.isText" class="text-center" style="width:5%">
                                                <div v-if="!PrintingMood">
                                                    <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 2" @click="UpdateExistingTransactionArchiveRecord(ChildItem,2) " type="checkbox">
                                                    <input v-else :checked="ChildItem.default_status == 2"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,2)" >


                                                </div>
                                                <!--------- Printing Mood ---------->
                                                <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 2 " checked >
                                                <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 2 && !ChildItem.transactions.length" checked>



                                                <!-------- in case of nested loops --------->
                                                <div v-if="ChildItem.children.length">
                                                    <div  v-for="innerItem in ChildItem.children">
                                                        <hr>
                                                        <div v-if="!PrintingMood">
                                                            <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 2" @click="UpdateExistingTransactionArchiveRecord(innerItem,2) " type="checkbox">
                                                            <input v-else :checked="innerItem.default_status == 2"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,2)" >
                                                        </div>
                                                        <!--------- Printing Mood ---------->
                                                        <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 2 " checked >
                                                        <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 2 && !innerItem.transactions.length" checked>

                                                    </div>
                                                </div>
                                                <!-------- ./in case of nested loops --------->


                                            </td>
                                            <!--------- ./if it's a choice area --------->

                                        </tr>
                                    </tbody>
                                </table>
                           </div>
                        </div>
                        <!--------------- one nested level ------------------------>
                        <div v-else-if="SelectedItem.code == 'ع2-2' || SelectedItem.code == 'ع2-3' || SelectedItem.code == 'ع2-4'|| SelectedItem.code == 'ن1'|| SelectedItem.code == 'ن2'"  class="col-md-12">

                                <table style="direction: rtl" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th class="text-center">البيان</th>
                                        <th class="text-center">نعم</th>
                                        <th class="text-center">لا</th>
                                        <th class="text-center">المرجع</th>
                                        <th class="text-center">لا ينطبق</th>
                                    </tr>
                                    <tr  v-for="item in SelectedItem.children">

                                        <td :colspan="[item.isText == 2 ? 5 : 1]" :class="[item.isText == 2 ? 'text-center' :'']" style="width:50%">
                                            <p v-if="item.name_alias">{{item.name_alias}}</p>
                                            <p v-else>{{item.name}}</p>

                                            <i v-if="item.ProcessStatus" class="fa fa-refresh fa-spin">
                                            </i>

                                            <br>
                                            <div class="mt-10" v-if="item.children.length">
                                                <div  v-for="innerItem in item.children">

                                                    <hr>
                                                    <p v-if="innerItem.name_alias">{{innerItem.name_alias}}</p>
                                                    <p v-else>{{innerItem.name}}</p>

                                                    <i v-if="innerItem.ProcessStatus" class="fa fa-refresh fa-spin">
                                                    </i>
                                                </div>

                                            </div>
                                            <div v-if="item.code == 'ن2-9-2'" v-for="type in RevisingTypes">
                                                <div class="col-md-2">
                                                    <label>{{type}}</label>
                                                    <br>
                                                    <div v-if="!PrintingMood">

                                                        <input v-if="!item.transactions.length" @change="AddNewTransactionArchiveRecord(item,1,type)" type="checkbox">

                                                        <input v-else :checked="item.transactions[0].pivot.first_value == type" @change="UpdateExistingTransactionArchiveRecord(item,1,type)" type="checkbox">

                                                    </div>
                                                    <div v-else>
                                                        <input type="radio" v-if="item.transactions.length && item.transactions[0].pivot.first_value == type "  checked>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>

                                        <!--------- if it's a text area --------->
                                            <td colspan="3" v-if="item.isText == 1">
                                                <div v-if="!PrintingMood">
                                                    <textarea v-if="!item.transactions.length" v-model="item.text" class="form-control"></textarea>

                                                    <textarea v-else v-model="item.transactions[0].pivot.text" class="form-control"></textarea>

                                                </div>
                                                <div v-else>
                                                    <textarea v-if="!item.transactions.length" class="form-control">{{item.text}}</textarea>

                                                    <textarea v-else class="form-control">{{item.transactions[0].pivot.text}}</textarea>


                                                </div>

                                            </td>

                                            <td v-if="item.isText == 1 && !PrintingMood">
                                                <a @click="item.transactions.length? UpdateExistingTransactionArchiveRecord(item,null) : AddNewTransactionArchiveRecord(item,null)" class="btn btn-success btn-sm">حفظ</a>
                                            </td>
                                        <!--------- ./if it's a text area --------->

                                        <!--------- if it's a choice area --------->
                                            <td v-if="!item.isText" class="text-center " style="width:5%">

                                                <div v-if="!PrintingMood">
                                                    <input v-if=" item.transactions.length" :checked="item.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(item,1) " type="checkbox">
                                                    <input v-else :checked="item.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(item,1)" >
                                                </div>
                                                <!--------- Printing Mood ---------->
                                                <input type="checkbox" v-if="PrintingMood && item.transactions.length && item.transactions[0].pivot.status == 1 " checked >
                                                <input type="checkbox" v-else-if="PrintingMood && item.default_status == 1 && !item.transactions.length" checked>

                                                <!-------- in case of nested loops --------->
                                                <div v-if="item.children.length">

                                                    <div class="mt-10" v-for="innerItem in item.children">
                                                        <hr>
                                                        <!--------- if it's a choice area --------->
                                                        <div v-if="!innerItem.isText">

                                                            <div v-if="!PrintingMood">
                                                                <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(innerItem,1) " type="checkbox">
                                                                <input v-else :checked="innerItem.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,1)" >
                                                            </div>
                                                            <!--------- Printing Mood ---------->
                                                            <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 1 " checked >
                                                            <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 1 && !innerItem.transactions.length" checked>
                                                        </div>
                                                        <!-------- ./if it's a choice area --------->
                                                        <!--------- if it's a text area --------->
                                                        <div v-else-if="innerItem.isText == 1">
                                                            <div v-if="!PrintingMood">
                                                                <textarea v-if="!innerItem.transactions.length" v-model="innerItem.text" class="form-control"></textarea>

                                                                <textarea v-else v-model="innerItem.transactions[0].pivot.text" class="form-control"></textarea>

                                                            </div>
                                                            <div v-else>
                                                                <textarea v-if="!innerItem.transactions.length" class="form-control">{{innerItem.text}}</textarea>

                                                                <textarea v-else class="form-control">{{innerItem.transactions[0].pivot.text}}</textarea>


                                                            </div>
                                                        </div>

                                                        <!--------- ./if it's a text area --------->

                                                    </div>

                                                </div>
                                                <!-------- ./in case of nested loops --------->

                                            </td>
                                            <td v-if="!item.isText" class="text-center" style="width:5%">
                                                <div v-if="!PrintingMood">
                                                    <input v-if=" item.transactions.length" :checked="item.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(item,0) " type="checkbox">
                                                    <input v-else :checked="item.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(item,0)" >
                                                </div>
                                                <!--------- Printing Mood ---------->
                                                <input type="checkbox" v-if="PrintingMood && item.transactions.length && item.transactions[0].pivot.status == 0 " checked >
                                                <input type="checkbox" v-else-if="PrintingMood && item.default_status == 0 && !item.transactions.length" checked>

                                                <!-------- in case of nested loops --------->
                                                <div v-if="item.children.length">
                                                    <div class="mt-10" v-for="innerItem in item.children">
                                                        <hr>
                                                        <div v-if="!PrintingMood">
                                                            <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(innerItem,0) " type="checkbox">
                                                            <input v-else :checked="innerItem.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,0)" >
                                                        </div>
                                                        <!--------- Printing Mood ---------->
                                                        <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 0 " checked >
                                                        <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 0 && !innerItem.transactions.length" checked>

                                                    </div>
                                                </div>
                                                <!-------- ./in case of nested loops --------->
                                            </td>

                                            <td v-if="!item.isText" class="text-center" style="width:35%">
                                                <div v-if="!PrintingMood">

                                                    <v-select  v-if="item.transactions.length" @input="UpdateExistingTransactionArchiveRecord(item,item.transactions[0].pivot.status)" :options="AvailableRevisingGuides" v-model="item.transactions[0].pivot.reference" style="width: 100%" ></v-select>
                                                    <v-select v-else :options="AvailableRevisingGuides" v-model="item.default_reference" style="width: 100%" @input="AddNewTransactionArchiveRecord(item,false)" ></v-select>

                                                </div>
                                                <div v-else>
                                                    <div v-if="item.transactions.length">
                                                        <h3 v-if="item.transactions[0].pivot.reference == null"></h3>
                                                        <h3 v-else-if="item.transactions[0].pivot.reference.code">{{item.transactions[0].pivot.reference.code}}</h3>
                                                        <h3 v-else-if="item.transactions[0].pivot.reference">{{item.transactions[0].pivot.reference}}</h3>
                                                    </div>
                                                    <h3 v-else-if="item.default_reference!== null && item.default_reference.code">{{item.default_reference.code}}</h3>
                                                    <h3 v-else-if=" item.default_reference">{{item.default_reference}}</h3>
                                                </div>
                                            </td>

                                            <td v-if="!item.isText" class="text-center" style="width:5%">

                                            <div v-if="!PrintingMood">
                                                <input v-if=" item.transactions.length" :checked="item.transactions[0].pivot.status == 2" @click="UpdateExistingTransactionArchiveRecord(item,2) " type="checkbox">
                                                <input v-else :checked="item.default_status == 2"  type="checkbox" @click="AddNewTransactionArchiveRecord(item,2)" >


                                            </div>
                                            <!--------- Printing Mood ---------->
                                            <input type="checkbox" v-if="PrintingMood && item.transactions.length && item.transactions[0].pivot.status == 2 " checked >
                                            <input type="checkbox" v-else-if="PrintingMood && item.default_status == 2 && !item.transactions.length" checked>


                                                <!-------- in case of nested loops --------->
                                                <div v-if="item.children.length">
                                                    <div class="mt-10" v-for="innerItem in item.children">
                                                        <hr>
                                                        <div v-if="!PrintingMood">
                                                            <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 2" @click="UpdateExistingTransactionArchiveRecord(innerItem,2) " type="checkbox">
                                                            <input v-else :checked="innerItem.default_status == 2"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,2)" >
                                                        </div>
                                                        <!--------- Printing Mood ---------->
                                                        <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 2 " checked >
                                                        <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 2 && !innerItem.transactions.length" checked>

                                                    </div>
                                                </div>
                                                <!-------- ./in case of nested loops --------->

                                        </td>
                                        <!--------- ./if it's a choice area --------->

                                    </tr>
                                    </tbody>
                                </table>

                        </div>
                        <!--------------- special case ع2/5 ------------------------->

                        <div v-else-if="SelectedItem.code == 'ع2-5'" class="col-md-12">
                            <div v-for="item in SelectedItem.children">
                                <h4 v-if="item.name_alias" class="mb-10">{{item.name_alias}} : </h4>

                                <h4 v-else class="mb-10">{{item.name}} : </h4>

                                <table style="direction: rtl" class="table table-bordered">
                                      <tbody>
                                    <tr>
                                        <th class="text-center">الإجراءات</th>
                                        <th class="text-center">نعم</th>
                                        <th class="text-center">لا</th>

                                    </tr>
                                    <tr  v-for="(ChildItem,index) in item.children">
                                        <td style="width:50%">
                                            <p v-if="ChildItem.name_alias">{{ChildItem.name_alias}}</p>
                                            <p v-else>{{ChildItem.name}}</p>

                                            <i v-if="ChildItem.ProcessStatus" class="fa fa-refresh fa-spin">
                                            </i>

                                        </td>
                                        <td class="text-center " style="width:5%">

                                            <div v-if="!PrintingMood">
                                                <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(ChildItem,1) " type="checkbox">
                                                <input v-else :checked="ChildItem.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,1)" >
                                            </div>
                                            <!--------- Printing Mood ---------->
                                            <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 1 " checked >
                                            <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 1 && !ChildItem.transactions.length" checked>


                                        </td>

                                        <td class="text-center" style="width:5%">
                                            <div v-if="!PrintingMood">
                                                <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(ChildItem,0) " type="checkbox">
                                                <input v-else :checked="ChildItem.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,0)" >
                                            </div>
                                            <!--------- Printing Mood ---------->
                                            <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 0 " checked >
                                            <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 0 && !ChildItem.transactions.length" checked>


                                        </td>

                                    </tr>
                                    </tbody>

                                </table>
                            </div>

                            <h5 class="mb-10">تم مراجعة النموذج اعلاه بناء على المعطيات التالية: </h5>
                            <table style="direction: rtl" class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            اسم البرنامج المحاسبي اوديتينج اب
                                        </td>
                                        <td>
                                            * تم اختبار بعض القيود كعينة Ö
                                        </td>
                                        <td>
                                            * يوجد أدمن للبرنامج Ö
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            عدد المستخدمين
                                        </td>
                                        <td>
                                            * حماية البرنامج في اعتقادنا جيدة ويمكن الاعتماد عليها Ö
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!--------------- ./special case ع2/5 ------------------------->

                        <!--------------- special case ن6 --------------->
                        <div v-else-if="SelectedItem.code == 'ن6'" class="col-md-12">
                            <div v-if="LoadingSpinner" class="overlay text-center">
                                <i class="fa fa-refresh fa-spin">
                                </i>
                            </div>
                            <div class="col-md-12" v-for="(item,index) in SelectedItem.children">
                                <div v-if="item.code == 'ن6-1'">
                                    <h4 v-if="item.name_alias" class="pt-20">4- {{item.name_alias}}</h4>
                                    <h4 v-else>{{item.name}}</h4>
                                    <textarea v-if="!PrintingMood" disabled class="form-control" :text="Transaction.institution.business_activity"></textarea>
                                    <textarea v-else disabled class="form-control">{{Transaction.institution.business_activity}}</textarea>

                                </div>

                                <div v-if="item.code == 'ن6-2'">
                                    <h4 v-if="item.name_alias" class="pt-20">4- {{item.name_alias}}</h4>
                                    <h4 v-else>{{item.name}}</h4>
                                    <div v-if="Transaction.institution.agent">
                                        <div class="col-md-4 ">
                                            <label class="pt-10" >الأسم</label>
                                            <input v-if="!PrintingMood" class="form-control" type="text" disabled :value="Transaction.institution.agent.name">
                                            <h4 v-else>{{Transaction.institution.agent.name}}</h4>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label class="pt-10" >رقم الجوال</label>
                                            <input v-if="!PrintingMood" class="form-control" type="text" disabled :value="Transaction.institution.agent.phone">
                                            <h4 v-else>{{Transaction.institution.agent.phone}}</h4>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label class="pt-10" >الايميل</label>
                                            <input v-if="!PrintingMood" class="form-control" type="text" disabled :value="Transaction.institution.agent.email">
                                            <h4 v-else>{{Transaction.institution.agent.email}}</h4>
                                        </div>
                                        <div class="col-md-4 ">
                                            <label class="pt-10" >رقم الهوية</label>
                                            <input v-if="!PrintingMood" class="form-control" type="text" disabled :value="Transaction.institution.agent.national_id">
                                            <h4 v-else>{{Transaction.institution.agent.national_id}}</h4>

                                        </div>
                                        <div class="col-md-4 ">
                                            <label class="pt-10" >تاريخ الهوية</label>

                                            <input v-if="!PrintingMood" class="form-control" type="text" disabled :value="Transaction.institution.agent.national_id_date">
                                            <h4 v-else>{{Transaction.institution.agent.national_id_date}}</h4>

                                        </div>
                                    </div>
                                    <div v-else><h5 class="pt-20">لم يتم تحديد مندوب للمنشأة</h5></div>
                                </div>
                                <div v-if="item.code == 'ن6-3'">
                                    <hr>
                                    <h4 v-if="item.name_alias" class="pt-20">4- {{item.name_alias}}</h4>
                                    <h4 v-else>{{item.name}}</h4>
                                    <p class="text-bold">
                                        {{item.first_note}}
                                    </p>
                                </div>
                                <div v-if="item.code == 'ن6-4'">
                                    <h4 v-if="item.name_alias" class="pt-20">4- {{item.name_alias}}</h4>
                                    <h4 v-else class="pt-20">4- {{item.name}}</h4>
                                    <div v-if="!PrintingMood">
                                        <textarea v-if="!item.transactions.length" v-model="item.text" class="form-control"></textarea>
                                        <textarea v-else v-model="item.transactions[0].pivot.text" class="form-control"></textarea>
                                        <button class="btn btn-success btn-sm mt-10" @click="[item.transactions.length ? UpdateExistingTransactionArchiveRecord(item,1) : AddNewTransactionArchiveRecord(item,1)]">حفظ</button>
                                    </div>
                                    <div v-else>
                                        <textarea v-if="!item.transactions.length"  class="form-control">{{item.text}}</textarea>
                                        <textarea v-else  class="form-control">{{item.transactions[0].pivot.text}}</textarea>

                                    </div>
                                </div>
                                <div v-if="item.code == 'ن6-5'">
                                    <h4 class="pt-20">5- {{item.name}}</h4>
                                    <ul >
                                        <li class="pt-10" v-for="ChildItem in item.children">
                                           <h5>
                                             <b v-if="ChildItem.code_alias"> {{ChildItem.code_alias}} </b>
                                              <b v-else> {{ChildItem.code}} </b> - <b v-if="ChildItem.name_alias">{{ChildItem.name_alias}}</b><b v-else>{{ChildItem.name}}</b>

                                               <p v-if="ChildItem.code == '5.2'" class="pt-20"> و منها على سبيل المثال و ليس الحصر:-</p>
                                           </h5>
                                            <div v-if="ChildItem.isText">
                                                <div v-if="!PrintingMood">
                                                    <textarea v-if="!ChildItem.transactions.length" v-model="ChildItem.text" class="form-control"></textarea>
                                                    <textarea v-else v-model="ChildItem.transactions[0].pivot.text" class="form-control"></textarea>
                                                    <button class="btn btn-success btn-sm mt-10" @click="[ChildItem.transactions.length ? UpdateExistingTransactionArchiveRecord(ChildItem,1) : AddNewTransactionArchiveRecord(ChildItem,1)]">حفظ</button>
                                                </div>
                                                <div v-else>
                                                    <textarea v-if="!ChildItem.transactions.length"  class="form-control">{{ChildItem.text}}</textarea>
                                                    <textarea v-else  class="form-control">{{ChildItem.transactions[0].pivot.text}}</textarea>

                                                </div>
                                            </div>

                                            <ul v-if="ChildItem.children.length">
                                                   <li class="pt-20" v-for="GrandChild in ChildItem.children">
                                                       <h5>
                                                           <b v-if="GrandChild.code_alias"> {{GrandChild.code_alias}} </b>
                                                           <b v-else> {{GrandChild.code}} </b> - <b v-if="GrandChild.name_alias">{{GrandChild.name_alias}}</b><b v-else>{{GrandChild.name}}</b>
                                                       </h5>

                                                   </li>
                                                </ul>

                                        </li>

                                    </ul>
                                </div>
                                <hr>

                            </div>
                        </div>
                        <!--------------- ./special case ن6 --------------->

                        <!--------------- special case ن7 --------------->
                        <div v-else-if="SelectedItem.code == 'ن7'" class="col-md-12" >
                            <div v-if="LoadingSpinner" class="overlay text-center">
                                <i class="fa fa-refresh fa-spin">
                                </i>
                            </div>
                            <!-- توزيع ساعات العمل  ------>
                            <div class="row" style="padding-top:15px;padding-bottom:15px">
                                <table style="direction: rtl" class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th style="color: white;background-color: #00a65a;border-color:white">السكرتير</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المندوب الميدانى</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المراجع الفنى</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المدقق</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">مدير المراجعة</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">المدير التنفيذي</th>
                                        <th style="color: white;background-color: #00a65a;border-color:white">الشريك الإداري</th>

                                        <th v-if="EditHelperTime" v-on:keyup.enter="EditHelperTime = false" style="color: white;background-color: #00a65a;border-color:white">
                                            <input class="form-control" v-model="HelperTime">
                                        </th>

                                        <th v-else style="color: white;background-color: #00a65a;border-color:white" @click="EditHelperTime=true"><b>{{HelperTime}}</b></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.secretary_time">


                                            <h4 v-else class="font-weight-bold">{{Transaction.secretary_time}}</h4>

                                        </td>
                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.fieldDelegate_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.fieldDelegate_time}}</h4>
                                        </td>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.reviser_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.reviser_time}}</h4>
                                        </td>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.auditor_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.auditor_time}}</h4>
                                        </td>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.revisingManager_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.revisingManager_time}}</h4>
                                        </td>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.executiveDirector_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.executiveDirector_time}}</h4>
                                        </td>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.Managing_partner_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.Managing_partner_time}}</h4>
                                        </td>

                                        <td>
                                            <input v-if="!PrintingMood" type="text" class="form-control" v-model="Transaction.helper_time">
                                            <h4 v-else class="font-weight-bold">{{Transaction.helper_time}}</h4>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- توزيع ساعات العمل/.  ------>
                        </div>
                        <!--------------- ./special case ن7 --------------->

                        <!--------------- special case ن8 --------------->
                        <div v-else-if="SelectedItem.code == 'ن8'" class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table style="direction: rtl" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="color: white;background-color: #00a65a;border-color:white">الرمز</th>
                                            <th style="color: white;background-color: #00a65a;border-color:white">العملية</th>
                                            <th style="color: white;background-color: #00a65a;border-color:white">موقع الرمز</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr v-for="child in SelectedItem.children">

                                            <td class="text-center ">
                                                <p>{{child.code_alias}}</p>
                                            </td>
                                            <td>
                                                <p>{{child.name}}</p>
                                            </td>
                                            <td>
                                                <p>{{child.first_note}}</p>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!--------------- ./special case ن8 --------------->

                        <!--------------- special case ن9 --------------->
                        <div v-else-if="SelectedItem.code == 'ن9'" class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <table style="direction: rtl" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="color: white;background-color: #00a65a;border-color:white">الاسم</th>
                                            <th style="color: white;background-color: #00a65a;border-color:white">الوظيفة</th>
                                            <th style="color: white;background-color: #00a65a;border-color:white">اسم وكود التوقيع</th>
                                            <th style="color: white;background-color: #00a65a;border-color:white">التوقيع</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr v-if="worker" v-for="worker in TransactionWorkers">

                                            <td class="text-center ">
                                                <p>{{worker.name}}</p>
                                            </td>

                                            <td class="text-center ">
                                                <p v-if="worker.role=='شريك اداري'">الشريك المسؤول</p>
                                                <p v-else-if="worker.role == 'مراجع فني'">المراجع الفني</p>
                                                <p v-else-if="worker.role == 'مدقق'">مدقق حسابات</p>
                                                <p v-else-if="worker.role == 'مدير مراجعة'">مدير المراجعة</p>
                                                <p v-else-if="worker.role == 'مدير اداري'">المدير الإداري</p>
                                            </td>
                                            <td>
                                                <p>{{worker.name}}___________{{worker.code}}</p>
                                            </td>
                                            <td>
                                                <img v-if="worker.signatureImage" :src="worker.signatureImage" height="150px" width="300">
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!--------------- ./special case ن9 --------------->

                        <!--------------- Three nested levels ------------------------->
                        <div v-else-if=" SelectedItem.code == 'ن14'" class="col-md-12">
                            <div v-for="item in SelectedItem.children">

                                <h3 class="mb-20" v-if="item.code == 'ن14-1'">أولاً: العرض العام للقوائم المالية</h3>
                                <h3 class="mb-20" v-if="item.code == 'ن14-4'">ثانيا: عرض المعلومات في قائمة الدخل</h3>
                                <h3 class="mb-20" v-if="item.code == 'ن14-5'">ثالثاً: عرض المعلومات في قائمة التدفق</h3>
                                <h3 class="mb-20" v-if="item.code == 'ن14-6'">رابعاً: عرض المعلومات في قائمة الأرباح ( الخسائر) المبقاة</h3>

                                <h3 class="mb-20" v-if="item.code == 'ن14-7'">الإفصاح العام</h3>



                                <hr v-if="item.code == 'ن14-1' || item.code == 'ن14-4'">

                                <h4 v-if="item.name_alias" class="mb-20">{{item.name_alias}}  </h4>
                                <h4 v-else class="mb-10">{{item.name}}  </h4>

                                <h4 v-if="item.code == 'ن14-1'" class="text-center">هل تتضمن القوائم المالية ما يلي :</h4>
                                <h4 v-if="item.code == 'ن14-2'" class="text-center">هل تم مراعاة الأسس التالية عند إعداد القوائم المالية :</h4>
                                <h4 v-if="item.code == 'ن14-3'" class="text-center">عرض المعلومات في قائمة المركز المالي :</h4>

                                <table style="direction: rtl" class="table table-bordered">
                                    <tbody >
                                    <tr>
                                        <th class="text-center">البيان</th>
                                        <th class="text-center">نعم</th>
                                        <th class="text-center">لا</th>
                                        <th class="text-center">المرجع</th>
                                        <th class="text-center">لا ينطبق</th>
                                    </tr>
                                    <tr  v-for="(ChildItem,index) in item.children">
                                        <td  style="width:50%">
                                            <p v-if="ChildItem.name_alias">{{ChildItem.name_alias}}</p>
                                            <p v-else>{{ChildItem.name}}</p>

                                            <i v-if="ChildItem.ProcessStatus" class="fa fa-refresh fa-spin">
                                            </i>

                                            <div  class="mt-10" v-if="ChildItem.children.length">
                                                <div  v-for="innerItem in ChildItem.children">

                                                    <hr>
                                                    <div style="margin-right: 30px;">
                                                        <p v-if="innerItem.name_alias">{{innerItem.name_alias}}</p>
                                                        <p v-else>{{innerItem.name}}</p>

                                                        <i v-if="innerItem.ProcessStatus" class="fa fa-refresh fa-spin">
                                                        </i>
                                                    </div>

                                                </div>

                                            </div>

                                        </td>

                                        <!--------- if it's a text area --------->
                                        <td colspan="3" v-if="ChildItem.isText == 1">
                                            <div v-if="!PrintingMood">
                                                <textarea v-if="!ChildItem.transactions.length" v-model="ChildItem.text" class="form-control"></textarea>

                                                <textarea v-else v-model="ChildItem.transactions[0].pivot.text" class="form-control"></textarea>

                                            </div>
                                            <div v-else>
                                                <textarea v-if="!ChildItem.transactions.length" class="form-control">{{ChildItem.text}}</textarea>

                                                <textarea v-else class="form-control">{{ChildItem.transactions[0].pivot.text}}</textarea>


                                            </div>

                                        </td>

                                        <td v-if="ChildItem.isText == 1 && !PrintingMood">
                                            <a @click="ChildItem.transactions.length? UpdateExistingTransactionArchiveRecord(ChildItem,null) : AddNewTransactionArchiveRecord(ChildItem,null)" class="btn btn-success btn-sm">حفظ</a>
                                        </td>
                                        <!--------- ./if it's a text area --------->

                                        <td v-if="ChildItem.isText == 0 || ChildItem.isText == null " class="text-center " style="width:5%">

                                            <div v-if="!PrintingMood">
                                                <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(ChildItem,1) " type="checkbox">
                                                <input v-else :checked="ChildItem.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,1)" >
                                            </div>
                                            <!--------- Printing Mood ---------->
                                            <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 1 " checked >
                                            <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 1 && !ChildItem.transactions.length" checked>


                                            <!-------- in case of nested loops --------->
                                            <div v-if="ChildItem.children.length">

                                                <div class="mt-10" v-for="innerItem in ChildItem.children">
                                                    <hr>
                                                    <div v-if="!PrintingMood">
                                                        <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 1" @click="UpdateExistingTransactionArchiveRecord(innerItem,1) " type="checkbox">
                                                        <input v-else :checked="innerItem.default_status == 1"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,1)" >
                                                    </div>
                                                    <!--------- Printing Mood ---------->
                                                    <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 1 " checked >
                                                    <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 1 && !innerItem.transactions.length" checked>

                                                </div>

                                            </div>
                                            <!-------- ./in case of nested loops --------->


                                        </td>

                                        <td v-if="ChildItem.isText == 0 || ChildItem.isText == null " class="text-center" style="width:5%">



                                            <div v-if="!PrintingMood">
                                                <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(ChildItem,0) " type="checkbox">
                                                <input v-else :checked="ChildItem.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,0)" >
                                            </div>
                                            <!--------- Printing Mood ---------->
                                            <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 0 " checked >
                                            <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 0 && !ChildItem.transactions.length" checked>

                                            <!-------- in case of nested loops --------->
                                            <div v-if="ChildItem.children.length">
                                                <div class="mt-10" v-for="innerItem in ChildItem.children">
                                                    <hr>
                                                    <div v-if="!PrintingMood">
                                                        <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 0" @click="UpdateExistingTransactionArchiveRecord(innerItem,0) " type="checkbox">
                                                        <input v-else :checked="innerItem.default_status == 0"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,0)" >
                                                    </div>
                                                    <!--------- Printing Mood ---------->
                                                    <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 0 " checked >
                                                    <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 0 && !innerItem.transactions.length" checked>

                                                </div>
                                            </div>
                                            <!-------- ./in case of nested loops --------->

                                        </td>

                                        <td v-if="ChildItem.isText == 0 || ChildItem.isText == null " class="text-center" style="width:35%">

                                            <div v-if="!PrintingMood">

                                                <v-select  v-if="ChildItem.transactions.length" @input="UpdateExistingTransactionArchiveRecord(ChildItem,ChildItem.transactions[0].pivot.status)" :options="AvailableRevisingGuides" v-model="ChildItem.transactions[0].pivot.reference" style="width: 100%" ></v-select>
                                                <v-select v-else :options="AvailableRevisingGuides" v-model="ChildItem.default_reference" style="width: 100%" @input="AddNewTransactionArchiveRecord(ChildItem,false)" ></v-select>
                                                <!-------- in case of nested loops --------->
                                                <div v-if="ChildItem.children.length">
                                                    <div  v-for="innerItem in ChildItem.children">

                                                        <hr style="margin-top:20px;margin-bottom:10px">
                                                        <div  v-if="!PrintingMood">
                                                            <v-select  v-if="innerItem.transactions.length" @input="UpdateExistingTransactionArchiveRecord(innerItem,innerItem.transactions[0].pivot.status)" :options="AvailableRevisingGuides" v-model="innerItem.transactions[0].pivot.reference" style="width: 100%" ></v-select>
                                                            <v-select v-else :options="AvailableRevisingGuides" v-model="innerItem.default_reference" style="width: 100%" @input="AddNewTransactionArchiveRecord(innerItem,false)" ></v-select>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-------- ./in case of nested loops --------->
                                            </div>
                                            <div v-else>

                                                <div v-if="ChildItem.transactions.length">
                                                    <h3 v-if="ChildItem.transactions[0].pivot.reference == null "></h3>
                                                    <h3 v-else-if="ChildItem.transactions[0].pivot.reference.code">{{ChildItem.transactions[0].pivot.reference.code}}</h3>
                                                    <h3 v-else-if="ChildItem.transactions[0].pivot.reference">{{ChildItem.transactions[0].pivot.reference}}</h3>
                                                </div>
                                                <h3 v-else-if="ChildItem.default_reference!== null && ChildItem.default_reference.code">{{ChildItem.default_reference.code}}</h3>
                                                <h3 v-else-if=" ChildItem.default_reference">{{ChildItem.default_reference}}</h3>

                                                <!-------- in case of nested loops --------->
                                                <div  v-for="innerItem in ChildItem.children">
                                                    <hr style="margin-top:20px;margin-bottom:10px">

                                                    <div v-if="ChildItem.transactions.length">

                                                        <h3 v-if="innerItem.transactions[0].pivot.reference==null"></h3>
                                                        <h3 v-if="innerItem.transactions[0].pivot.reference.code">{{innerItem.transactions[0].pivot.reference.code}}</h3>
                                                        <h3 v-else-if="innerItem.transactions[0].pivot.reference">{{innerItem.transactions[0].pivot.reference}}</h3>

                                                    </div>
                                                    <h3 v-else-if="innerItem.default_reference!== null && innerItem.default_reference.code">{{innerItem.default_reference.code}}</h3>
                                                    <h3 v-else-if=" innerItem.default_reference">{{innerItem.default_reference}}</h3>

                                                </div>
                                                <!-------- ./in case of nested loops --------->
                                            </div>

                                        </td>

                                        <td v-if="ChildItem.isText == 0 || ChildItem.isText == null " class="text-center" style="width:5%">
                                            <div v-if="!PrintingMood">
                                                <input v-if=" ChildItem.transactions.length" :checked="ChildItem.transactions[0].pivot.status == 2" @click="UpdateExistingTransactionArchiveRecord(ChildItem,2) " type="checkbox">
                                                <input v-else :checked="ChildItem.default_status == 2"  type="checkbox" @click="AddNewTransactionArchiveRecord(ChildItem,2)" >


                                            </div>
                                            <!--------- Printing Mood ---------->
                                            <input type="checkbox" v-if="PrintingMood && ChildItem.transactions.length && ChildItem.transactions[0].pivot.status == 2 " checked >
                                            <input type="checkbox" v-else-if="PrintingMood && ChildItem.default_status == 2 && !ChildItem.transactions.length" checked>


                                            <!-------- in case of nested loops --------->
                                            <div v-if="ChildItem.children.length">
                                                <div  v-for="innerItem in ChildItem.children">
                                                    <hr>
                                                    <div v-if="!PrintingMood">
                                                        <input v-if=" innerItem.transactions.length" :checked="innerItem.transactions[0].pivot.status == 2" @click="UpdateExistingTransactionArchiveRecord(innerItem,2) " type="checkbox">
                                                        <input v-else :checked="innerItem.default_status == 2"  type="checkbox" @click="AddNewTransactionArchiveRecord(innerItem,2)" >
                                                    </div>
                                                    <!--------- Printing Mood ---------->
                                                    <input type="checkbox" v-if="PrintingMood && innerItem.transactions.length && innerItem.transactions[0].pivot.status == 2 " checked >
                                                    <input type="checkbox" v-else-if="PrintingMood && innerItem.default_status == 2 && !innerItem.transactions.length" checked>

                                                </div>
                                            </div>
                                            <!-------- ./in case of nested loops --------->


                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--------------- Three nested level ------------------------>

                    </div>
                </div>
            </div>
    </div>
</template>
<script>
    import VirtualList from 'vue-virtual-scroll-list'
    import MenuItem from './MenuItem'
    import Printd from 'printd';
    export default {
        name: "ArchiveEditTransaction",
        components: { 'virtual-list': VirtualList ,'MenuItem':MenuItem},

        props:{
          'Transaction':''
        },

         data(){
            return{
                TotalMarks : 0,
                LoadingSpinner: false,
                ItemComponent: MenuItem,
                ListItems:[],
                SelectedItem:null,
                AvailableRevisingGuides:[],
                RevisingTypes:['يوميا','أسبوعيا','شهريا','ربع سنوي','نصف سنوي','سنوي','فترة لاحقة','اخري'],
                BenefitsTypes:['الملاك','الإدارة','الجهات الحكومية','اطراف اخري'],
                HelperTime : 'المساعد',
                EditHelperTime : false,
                ManagingDirectorIsAdded:false,
                TransactionWorkers:[this.Transaction.partner, this.Transaction.auditor, this.Transaction.reviser,this.Transaction.revising_manager],
                PrintingMood:false,

            }
        },
        created () {
            this.GetNestedRevisingGuides();
            // detecting change checked value from item component event.
            this.$on('checkSelectedItemChange', (SelectedItem) => {
               this.SelectedItem = SelectedItem;
                this.TotalMarks = this.SelectedItem.mark;

                if(this.SelectedItem.parent_id == 1 || this.SelectedItem.code == 'ن3'|| this.SelectedItem.code == 'ن4'|| this.SelectedItem.code == 'ن5'){
                   this.GetItemDocuments();
               }
               else {
                    this.GetRevisingGuidTransactionValues();
                    if(this.SelectedItem.code == 'ن9' && !this.ManagingDirectorIsAdded){
                        this.GetManagingDirector(route('employee.type','مدير اداري'));
                    }
               }
            })
        },
        methods:{

            GetNestedRevisingGuides(){
                this.LoadingSpinner = true;
                axios.get(route('RevisingGuid.index.archive',{TransactionsID:this.Transaction.id,WithRelation:true}  ))
                    .then(({data})=>{

                        data.AllRevisingGuides.forEach(RevisingGuid=>{
                            this.ListItems.push(RevisingGuid);
                        });
                        this.LoadingSpinner = false;
                        this.GetRawRevisingGuides();
                    })
                    .catch(error =>{
                        console.log(error);
                        this.LoadingSpinner = false;
                        this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});
                    })
            },
            GetRawRevisingGuides(){
                this.LoadingSpinner = true;

                this.ListItems.forEach( ParentItem =>{

                    this.AvailableRevisingGuides.push({'label': (ParentItem.code_alias ? ParentItem.code_alias : ParentItem.code) + ' - '+  (ParentItem.name_alias ? ParentItem.name_alias : ParentItem.name) , 'code':(ParentItem.code_alias ? ParentItem.code_alias : ParentItem.code) });

                    ParentItem.children.forEach( ChildItem =>{

                        this.AvailableRevisingGuides.push({'label': (ChildItem.code_alias ? ChildItem.code_alias : ChildItem.code) + ' - '+  (ChildItem.name_alias ? ChildItem.name_alias : ChildItem.name) , 'code':(ChildItem.code_alias ? ChildItem.code_alias : ChildItem.code) });


                    })
                })
                this.LoadingSpinner = false;

            },
            GetRevisingGuidTransactionValues(){

                this.LoadingSpinner = true;
                axios.get(route('RevisingGuidTransaction.index',[this.Transaction.id,this.SelectedItem.id]))
                    .then(({data})=>{

                       this.SelectedItem =  data.RevisingGuideTransaction[0];

                        if(this.SelectedItem.children && this.SelectedItem.children.length){

                            var NumberOfChildrenThathasMark = this.SelectedItem.children.filter(Child => (Child.isText == 0 || Child.isText == null )).length;
                            var ChildMark = Math.ceil(this.SelectedItem.mark / NumberOfChildrenThathasMark);

                            this.SelectedItem.children.forEach(Child=>{


                                Child.mark = ChildMark;

                                if( Child.transactions.length && (Child.isText == null || Child.isText == 0) ) {

                                    if (Child.transactions[0].pivot.status != Child.default_status) {

                                        this.TotalMarks -= Child.mark;

                                    }
                                }
                                if(Child.children && Child.children.length){

                                    var NumberOfGrandChildrenThatHasMark = Child.children.filter(GrandChild => (GrandChild.isText == 0 || GrandChild.isText == null )).length;

                                    var GrandChildMark = Math.ceil(Child.mark / NumberOfGrandChildrenThatHasMark);

                                    Child.children.forEach(GrandChild=> {


                                        GrandChild.mark = GrandChildMark;


                                        if( GrandChild.transactions.length && (GrandChild.isText == null || GrandChild.isText == 0)  ) {

                                            if (GrandChild.transactions[0].pivot.status != GrandChild.default_status) {

                                                this.TotalMarks -= GrandChild.mark;

                                            }

                                        }


                                    })
                                }
                            })

                        }
                    })
                    .catch(error =>{
                        console.log(error);
                        this.LoadingSpinner = false;
                        this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                    })
                this.LoadingSpinner = false;

            },
            GetManagingDirector(endpoint){
                this.LoadingSpinner = true;
                    axios.get(endpoint)
                        .then(({data}) => {

                            if(data.employees[0]){
                                this.TransactionWorkers.push(data.employees[0]);
                            }
                            this.ManagingDirectorIsAdded = true;
                            this.LoadingSpinner = false;
                        }).catch(error => {
                            console.log(error);
                        this.$toast.error('.','خطأ يرجى المحاولة مرة أخرى',{timeout:3000});

                    })
            },
            GetItemDocuments(){
                this.LoadingSpinner = true;
                axios.get(route('documents.index',[this.Transaction.id,this.SelectedItem.code]))
                .then(({data})=>{
                    console.log(data);
                    this.$set(this.SelectedItem,'files',[]);
                    if(!data.RequiredDocuments[0].transactions.length){
                        this.$toast.warning('.','لا يوجد ملفات',{timeout:3000});
                    }
                    else{
                        data.RequiredDocuments[0].transactions.map(transaction=>{
                            this.SelectedItem.files.push(transaction.pivot);
                        });
                    }

                    this.LoadingSpinner= false;

                })
                .catch((error)=>{
                    console.log(error);
                    this.$toast.warning('.','لا يوجد ملفات',{timeout:3000});
                    this.LoadingSpinner= false;

                })

            },
            FileURL(DocumentPath){
                return window.location.origin+'/storage/'+DocumentPath;
            },
            getFileExtension(filename) {
                return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
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
            AddNewTransactionArchiveRecord(ArchiveRecord,status,first_value,second_value,third_value,fourth_value){
            console.log(ArchiveRecord);
                this.$set(ArchiveRecord,'ProcessStatus',true);
                const formData = new FormData();
                formData.append('_method','POST');
                formData.append('ReviseGuidID',ArchiveRecord.id);
                if(ArchiveRecord.isText){
                    formData.append('text',ArchiveRecord.text ? ArchiveRecord.text:'' );
                }
                if (ArchiveRecord.isText == 2){
                    formData.append('first_value',first_value);
                }
                else{
                    if(status === false || status === null) {
                        status = ArchiveRecord.default_status;
                    }
                    formData.append('status',status);
                    if(ArchiveRecord.default_reference !== null){
                        formData.append('reference',ArchiveRecord.default_reference.code ? ArchiveRecord.default_reference.code : ArchiveRecord.default_reference );

                    }
                }
                axios.post(route('RevisingGuidTransaction.store',this.Transaction.id),formData)
                    .then(({data})=>{
                        ArchiveRecord.ProcessStatus = false;
                        console.log(data);
                        if(ArchiveRecord.isText == 1){
                            ArchiveRecord.transactions.push({
                                'pivot' : {
                                    'text' : ArchiveRecord.text,
                                }
                            })
                        }
                        if(ArchiveRecord.isText == 2){
                            ArchiveRecord.transactions.push({
                                'pivot' : {
                                    'first_value' : first_value,
                                }
                            })
                        }
                        if(ArchiveRecord.isText == 0 || ArchiveRecord.isText == null)
                        {

                            ArchiveRecord.transactions.push({
                                'pivot':{
                                    'status': status,
                                    'reference': ArchiveRecord.default_reference
                                }
                            })
                            if(status != ArchiveRecord.default_status)
                            {
                                this.TotalMarks -= ArchiveRecord.mark;
                            }
                        }

                    }).catch(error =>{

                    ArchiveRecord.ProcessStatus = false;
                    this.$toast.error('.','خطأ يرجى المحاولة مرة أخرى',{timeout:3000});
                    console.log(error);
                })
            },
            UpdateExistingTransactionArchiveRecord(ArchiveRecord,status,first_value,second_value,third_value,fourth_value){
                console.log(ArchiveRecord);

                this.$set(ArchiveRecord,'ProcessStatus',true);
                var formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('ReviseGuidID',ArchiveRecord.id);

                if(ArchiveRecord.isText == 1){
                    formData.append('text',ArchiveRecord.transactions[0].pivot.text ? ArchiveRecord.transactions[0].pivot.text: '' )
                }
                else if(ArchiveRecord.isText == 2){
                    ArchiveRecord.transactions[0].pivot.first_value = first_value;

                    formData.append('first_value',ArchiveRecord.transactions[0].pivot.first_value)
                }
                else{
                    formData.append('status',status);
                    if(ArchiveRecord.transactions[0].pivot.reference){
                        formData.append('reference',(ArchiveRecord.transactions[0].pivot.reference.code?  ArchiveRecord.transactions[0].pivot.reference.code : ArchiveRecord.transactions[0].pivot.reference));
                    }
                }
                axios.post(route('RevisingGuidTransaction.update',this.Transaction.id),formData)
                .then(({data})=>{
                    ArchiveRecord.ProcessStatus = false;

                    if(  ArchiveRecord.isText === null || ArchiveRecord.isText === 0 ){

                        if( (status != ArchiveRecord.default_status) && (status != ArchiveRecord.transactions[0].pivot.status) ){

                            this.TotalMarks -= ArchiveRecord.mark;

                        }else if(   (status == ArchiveRecord.default_status) && (status != ArchiveRecord.transactions[0].pivot.status) ){
                            this.TotalMarks += ArchiveRecord.mark;

                        }

                    }

                    ArchiveRecord.transactions[0].pivot.status = status;
                }).catch(error =>{
                    ArchiveRecord.ProcessStatus = false;
                    this.$toast.error('.','خطأ يرجى المحاولة مرة أخرى',{timeout:3000});
                    console.log(error);
                })
            }



        },
    }
</script>

<style scoped>

</style>
