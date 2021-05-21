<template>
<div>
    <div class="col-md-3">
        <div>
            <v-card-title>
                {{$t('revisingPapers')}}
            </v-card-title>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" class="mt-4" @click="ShowAddModal()" dark>
                    <v-icon>mdi-plus</v-icon> {{$t('addNewGuide')}}
                </v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
            <draggable v-model="AvailableRevisingGuides" v-on="$listeners" group="people" @start="drag=true" @end="drag=false">
                <div v-for="(element, index) in AvailableRevisingGuides" :key="element.id">
                    <MenuItem :source="element" :index="index" />
                   </div>
            </draggable>
        </div>
    </div>
    <div class="col-md-9" v-if="SelectedItem">
        <div>
            <div v-if="LoadingSpinner" class="overlay">
                <i class="fa fa-refresh fa-spin">
                </i>
            </div>
            <v-card shaped :elevation="24">
                <v-container>

                    <div class="text-center">
                        <v-card-subtitle class="text-caption" v-if="SelectedItem.code_alias">{{SelectedItem.code_alias}}</v-card-subtitle>
                        <v-card-subtitle class="text-caption" v-else>{{SelectedItem.code}}</v-card-subtitle>

                        <v-card-title class="text-h6" v-if="SelectedItem.name_alias">{{SelectedItem.name_alias}}</v-card-title>
                        <v-card-title class="text-h6" v-else>{{SelectedItem.name}}</v-card-title>

                        <v-row align-content="center" align="center">
                            <v-col cols="9">
                                <v-text-field hide-details height="32px" :disabled="!EditMark" v-model="SelectedItem.mark" outlined :label="$t('grade')" v-on:keyup.enter="updateRevisingGuidMark()"></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-btn @click="EditMark=true" class="mr-4 ml-4" color="primary" dark>
                                    {{$t('enableEdit')}}
                                </v-btn>
                            </v-col>
                        </v-row>

                        <br>
                        <v-form @submit.prevent="updateRevisingGuidNotes()" id="NotesForm">
                            <v-row>
                                <v-col cols="9">
                                    <v-textarea v-model="SelectedItem.first_note" outlined :label="$t('firstNote')" v-on:keyup.enter="updateRevisingGuidMark()"></v-textarea>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="9">
                                    <v-textarea v-model="SelectedItem.second_note" outlined :label="$t('secondNote')" v-on:keyup.enter="updateRevisingGuidMark()"></v-textarea>
                                </v-col>
                            </v-row>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" form="NotesForm" class="mr-4 ml-4" color="primary" dark>
                                    {{$t('save')}}
                                </v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-form>
                    </div>

                    <div class="box-header mt-20">
                        <!-- first Level -->
                        <v-expansion-panels focusable>
                            <v-expansion-panel v-for="child in SelectedItem.children" :key="child.code">
                                <v-expansion-panel-header hide-actions>
                                    <span class="mainPannelText" v-if=" child.name_alias !== null && child.name_alias !==''">
                                        {{child.name_alias}}
                                    </span>
                                    <span class="mainPannelText" v-else>
                                        {{child.name}}
                                    </span>
                                </v-expansion-panel-header>
                                <v-btn absolute @click="ShowUpdateChildGuidModal(SelectedItem,child,1)" class="floatLeftAction" fab dark x-small color="primary">
                                    <v-icon dark>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                                <v-expansion-panel-content>
                                    <!-- Second Level -->
                                    <v-expansion-panels focusable>
                                        <v-expansion-panel v-for="GrandChild in child.children" :key="GrandChild.code">
                                            <v-expansion-panel-header hide-actions>
                                                <span class="mainPannelText" v-if=" GrandChild.name_alias !== null && GrandChild.name_alias !==''">
                                                    {{GrandChild.name_alias}}
                                                </span>
                                                <span class="mainPannelText" v-else>
                                                    {{GrandChild.name}}
                                                </span>
                                            </v-expansion-panel-header>
                                            <v-btn absolute @click="ShowUpdateChildGuidModal(child,GrandChild,2)" class="floatLeftAction" fab dark x-small color="primary">
                                                <v-icon dark>
                                                    mdi-pencil
                                                </v-icon>
                                            </v-btn>
                                            <v-expansion-panel-content>
                                                <!-- third level -->
                                                <v-expansion-panels focusable>
                                                    <v-expansion-panel v-for="GreatGrandChild in GrandChild.children" :key="GreatGrandChild.code">
                                                        <v-expansion-panel-header hide-actions>
                                                            <span class="mainPannelText" v-if=" GreatGrandChild.name_alias !== null && GreatGrandChild.name_alias !==''">
                                                                {{GreatGrandChild.name_alias}}
                                                            </span>
                                                            <span class="mainPannelText" v-else>
                                                                {{GreatGrandChild.name}}
                                                            </span>
                                                        </v-expansion-panel-header>
                                                        <v-btn absolute @click="ShowUpdateChildGuidModal(GrandChild,GreatGrandChild,3)" class="floatLeftAction" fab dark x-small color="primary">
                                                            <v-icon dark>
                                                                mdi-pencil
                                                            </v-icon>
                                                        </v-btn>
                                                        <v-expansion-panel-content>
                                                            <!-- fourth level -->
                                                            <v-expansion-panels disabled focusable>
                                                                <v-expansion-panel v-for="FinalLevel in GreatGrandChild.children" :key="FinalLevel.code">
                                                                    <v-expansion-panel-header hide-actions>
                                                                        <span class="mainPannelText" v-if=" FinalLevel.name_alias !== null && FinalLevel.name_alias !==''">
                                                                            {{FinalLevel.name_alias}}
                                                                        </span>
                                                                        <span class="mainPannelText" v-else>
                                                                            {{FinalLevel.name}}
                                                                        </span>
                                                                    </v-expansion-panel-header>
                                                                    <v-btn absolute @click="ShowUpdateChildGuidModal(GreatGrandChild,FinalLevel,4)" class="floatLeftAction" fab dark x-small color="primary">
                                                                        <v-icon dark>
                                                                            mdi-pencil
                                                                        </v-icon>
                                                                    </v-btn>
                                                                    <v-expansion-panel-content>
                                                                        <!-- fourth level -->

                                                                    </v-expansion-panel-content>
                                                                </v-expansion-panel>
                                                            </v-expansion-panels>
                                                            <v-card-actions>
                                                                <v-spacer></v-spacer>
                                                                <v-btn color="primary" class="mt-4" @click="ShowAddChildOfRevisingGuidModal(GreatGrandChild)" dark>
                                                                    <v-icon>mdi-plus</v-icon> {{$t('addNewBand')}}
                                                                </v-btn>
                                                                <v-spacer></v-spacer>
                                                            </v-card-actions>
                                                        </v-expansion-panel-content>
                                                    </v-expansion-panel>
                                                </v-expansion-panels>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn color="primary" class="mt-4" @click="ShowAddChildOfRevisingGuidModal(GrandChild)" dark>
                                                        <v-icon>mdi-plus</v-icon> {{$t('addNewBand')}}
                                                    </v-btn>
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-expansion-panel-content>
                                        </v-expansion-panel>
                                    </v-expansion-panels>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn color="primary" class="mt-4" @click="ShowAddChildOfRevisingGuidModal(child)" dark>
                                            <v-icon>mdi-plus</v-icon> {{$t('addNewBand')}}
                                        </v-btn>
                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-expansion-panels>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" class="mt-4" @click="ShowAddChildOfRevisingGuidModal(SelectedItem)" dark>
                                <v-icon>mdi-plus</v-icon> {{$t('addNewBand')}}
                            </v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </div>
                </v-container>

            </v-card>

        </div>

    </div>
    <!------------ Add Main RevisingGuid Hidden Modal  ---------->
    <v-dialog v-model="newAccountDialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('addNewGuide')}}
                </v-card-title>
                <v-form @submit.prevent=" Added_revisingGuid.Parent === null ? storeNewRevisingGuid():storeNewChildOfRevisingGuid()">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="Added_revisingGuid.code" outlined :label="$t('code')"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="Added_revisingGuid.name" outlined :label="$t('name')"></v-text-field>
                        </v-col>
                        <v-col v-if="Added_revisingGuid.Parent" cols="12">
                            <v-autocomplete v-model="Added_revisingGuid.isText" :items="isTextMenuItems" outlined :label="$t('type')"></v-autocomplete>
                        </v-col>
                        <v-col v-if="Added_revisingGuid.Parent&&Added_revisingGuid.isText == 0" cols="12">
                            <v-autocomplete v-model="Added_revisingGuid.default_status" :items="defaultStatusMenuItems" outlined :label="$t('value')"></v-autocomplete>
                        </v-col>
                        <v-col v-if="Added_revisingGuid.Parent&&Added_revisingGuid.isText == 0" cols="12">
                            <v-autocomplete v-model="Added_revisingGuid.default_status" item-text="label" item-value="code" :items="vSelectRevisingGuides" outlined :label="$t('revisor')"></v-autocomplete>
                        </v-col>

                    </v-row>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary" dark>
                            {{$t('save')}}
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-form>
            </v-container>
        </v-card>
    </v-dialog>
    <!------------ /. Add RevisingGuid Hidden Modal  ---------->

    <!------------ Edit RevisingGuid Hidden Modal  ---------->
    <v-dialog v-model="editAccountDialog" max-width="600px">
        <v-card>
            <v-container>
                <v-card-title>
                    {{$t('editGuide')}}
                </v-card-title>
                <v-form @submit.prevent="updateRevisingGuid()">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field v-model="temp_revisingGuid.code_alias" outlined :label="$t('code')"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field v-model="temp_revisingGuid.name_alias" outlined :label="$t('name')"></v-text-field>
                        </v-col>
                        <v-col v-if="temp_revisingGuid.Parent!==null" cols="12">
                            <v-autocomplete v-model="temp_revisingGuid.isText" :items="isTextMenuItems" outlined :label="$t('type')"></v-autocomplete>
                        </v-col>
                        <v-col v-if="temp_revisingGuid.Parent!==null&&temp_revisingGuid.isText == 0" cols="12">
                            <v-autocomplete v-model="temp_revisingGuid.default_status" :items="defaultStatusMenuItems" outlined :label="$t('value')"></v-autocomplete>
                        </v-col>
                        <v-col v-if="temp_revisingGuid.Parent!==null&&temp_revisingGuid.isText == 0" cols="12">
                            <v-autocomplete v-model="temp_revisingGuid.default_reference" item-text="label" item-value="code" :items="vSelectRevisingGuides" outlined :label="$t('revisor')"></v-autocomplete>
                        </v-col>

                    </v-row>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary" dark>
                            {{$t('save')}}
                        </v-btn>
                        <v-btn v-if="temp_revisingGuid.AddedByUser||temp_revisingGuid.Parent" @click="[ temp_revisingGuid.Parent === null ? DeleteRevisingGuid():DeleteChildOfRevisingGuid()]" color="error" dark>
                            {{$t('delete')}}
                        </v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-form>
            </v-container>
        </v-card>
    </v-dialog>
    <!------------ /. Edit RevisingGuid Hidden Modal  ---------->
</div>
</template>

<script>
import MenuItem from './MenuItem'
import draggable from 'vuedraggable'

export default {

    name: "RevisingGuidManagement",

    components: {
        'MenuItem': MenuItem,
        draggable
    },
    props: {
        'AllRevisingGuides': ''
    },
    data() {
        return {
            AvailableRevisingGuides: this.AllRevisingGuides,
            vSelectRevisingGuides: [],
            LoadingSpinner: false,
            newAccountDialog: false,
            finalArray: [],
            editAccountDialog: false,
            drag: false,
            ItemComponent: MenuItem,
            SelectedItem: null,
            isTextMenuItems: [{
                    text: 'نعم / لا / المرجع / لا ينطبق',
                    value: "0"
                },
                {
                    text: 'حقل كتابة',
                    value: "1"
                },
            ],
            defaultStatusMenuItems: [{
                    text: 'نعم',
                    value: "1"
                },
                {
                    text: 'لا',
                    value: "0"
                },
                {
                    text: 'لا ينطبق',
                    value: "2"
                },
            ],
            Added_revisingGuid: {
                'id': '',
                'name': '',
                'code': '',
                'Parent': null,
                'children': [],
                'AddedByUser': 1,
                'isText': '',
                'default_status': '',
                'default_reference': {
                    'label': '',
                    'code': ''
                }
            },

            temp_revisingGuid: {
                'id': '',
                'name_alias': '',
                'code_alias': '',
                'Parent': null,
                'level': '',
                'AddedByUser': '',
                'isText': '',
                'default_status': '',
                'default_reference': {
                    'label': '',
                    'code': ''
                }
            },

            edited_item: null,
            EditMark: false,
        }
    },
    watch: {
        AvailableRevisingGuides (newVal, oldVal) {
            if (newVal.length === oldVal.length) {
                this.updateRevisingGuidIndex()                
            } 
        }
    },
    created() {

        this.FlatRevisingGuidArray();
        // detecting change checked value from item component event.
        this.$on('UpdateRevisingGuid', (RevisingGuid) => {

            this.ShowUpdateGuidModal(RevisingGuid);

        })
        this.$on('SelectedRevisingGuid', (RevisingGuid) => {

            this.SelectedItem = RevisingGuid;
        })
    },
    methods: {
        FlatRevisingGuidArray() {
            this.LoadingSpinner = true;

            this.AvailableRevisingGuides.forEach(ParentItem => {

                this.vSelectRevisingGuides.push({
                    'label': (ParentItem.code_alias ? ParentItem.code_alias : ParentItem.code) + ' - ' + (ParentItem.name_alias ? ParentItem.name_alias : ParentItem.name),
                    'code': (ParentItem.code_alias ? ParentItem.code_alias : ParentItem.code)
                });
                ParentItem.children.forEach(ChildItem => {

                    this.vSelectRevisingGuides.push({
                        'label': (ChildItem.code_alias ? ChildItem.code_alias : ChildItem.code) + ' - ' + (ChildItem.name_alias ? ChildItem.name_alias : ChildItem.name),
                        'code': (ChildItem.code_alias ? ChildItem.code_alias : ChildItem.code)
                    });
                })
            })
            this.LoadingSpinner = false;
        },
        ShowAddModal() {
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
            this.newAccountDialog = true;
        },
        ShowAddChildOfRevisingGuidModal(Parent) {

            this.$refs.AddMainModalButton.click();
        },
        ShowAddChildOfRevisingGuidModal(Parent) {

            this.Added_revisingGuid.id = '',
                this.Added_revisingGuid.name = '',
                this.Added_revisingGuid.code = '',
                this.Added_revisingGuid.isText = '',
                this.Added_revisingGuid.default_status = '',
                this.Added_revisingGuid.default_reference = '',

                this.Added_revisingGuid.Parent = Parent,
                this.$refs.AddMainModalButton.click();

        },
        ShowUpdateGuidModal(RevisingGuid) {
            this.$refs.EditModalButton.click();

            this.temp_revisingGuid.id = RevisingGuid.id;
            this.temp_revisingGuid.name_alias = RevisingGuid.name_alias;
            this.temp_revisingGuid.name = RevisingGuid.name;
            this.temp_revisingGuid.code_alias = RevisingGuid.code_alias;
            this.temp_revisingGuid.code = RevisingGuid.code;
            this.temp_revisingGuid.AddedByUser = RevisingGuid.AddedByUser;

            this.edited_item = RevisingGuid;
        },
        ShowUpdateChildGuidModal(Parent, RevisingGuid, level) {
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
        storeNewRevisingGuid() {

            let formData = new FormData();

            formData.append('name', this.Added_revisingGuid.name);
            formData.append('code', this.Added_revisingGuid.code);
            formData.append('AddedByUser', 1);

            axios.post(route('revisingGuid.store.admin'), formData)
                .then(({
                    data
                }) => {
                    this.AvailableRevisingGuides.push({
                        'id': data[0].id,
                        'name': this.Added_revisingGuid.name,
                        'code': this.Added_revisingGuid.code,
                        'AddedByUser': 1,
                        'code_alias': '',
                        'name_alias': '',
                        'children': []
                    });
                    this.$toast.success('.', 'تم اضافة نموذج بنجاح', {
                        timeout: 3000
                    });
                }).catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                })
            this.$refs.CloseAddRevisingGuidModal.click();
        },
        storeNewChildOfRevisingGuid() {

            let formData = new FormData();

            formData.append('name_alias', this.Added_revisingGuid.name);
            formData.append('code_alias', this.Added_revisingGuid.code);
            formData.append('parent_id', this.Added_revisingGuid.Parent.id);
            formData.append('isText', this.Added_revisingGuid.isText);
            formData.append('default_status', this.Added_revisingGuid.default_status);
            if (this.Added_revisingGuid.default_reference !== null && this.Added_revisingGuid.default_reference !== '' && this.temp_revisingGuid.Added_revisingGuid !== undefined) {
                formData.append('default_reference', this.temp_revisingGuid.default_reference.hasOwnProperty('code') ? this.temp_revisingGuid.default_reference.code : this.temp_revisingGuid.default_reference);
            } else {
                formData.append('default_reference', '');
            }
            formData.append('AddedByUser', 1);

            axios.post(route('revisingGuid.store.admin'), formData)
                .then(({
                    data
                }) => {
                    this.Added_revisingGuid.Parent.children.push({
                        'id': data[0].id,
                        'name_alias': this.Added_revisingGuid.name,
                        'code_alias': this.Added_revisingGuid.code,
                        'AddedByUser': 1,
                        'code': '',
                        'name': '',
                        'isText': this.Added_revisingGuid.isText,
                        'default_status': this.Added_revisingGuid.default_status,
                        'default_reference': this.Added_revisingGuid.default_reference.code,
                        'children': []
                    });
                    console.log(this.Added_revisingGuid.Parent.children);

                    this.$toast.success('.', 'تم اضافة نموذج بنجاح', {
                        timeout: 3000
                    });
                }).catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                });
            this.$refs.CloseAddRevisingGuidModal.click();
        },
        updateRevisingGuid() {

            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('code_alias', this.temp_revisingGuid.code_alias ? this.temp_revisingGuid.code_alias : '');
            formData.append('name_alias', this.temp_revisingGuid.name_alias ? this.temp_revisingGuid.name_alias : '');
            formData.append('isText', this.temp_revisingGuid.isText);
            formData.append('default_status', this.temp_revisingGuid.default_status);
            if (this.temp_revisingGuid.default_reference !== null && this.temp_revisingGuid.default_reference !== '' && this.temp_revisingGuid.default_reference !== undefined) {
                formData.append('default_reference', this.temp_revisingGuid.default_reference.code ? this.temp_revisingGuid.default_reference.code : this.temp_revisingGuid.default_reference);
            } else {
                formData.append('default_reference', '');
            }

            axios.post(route('revisingGuid.update.admin', this.temp_revisingGuid.id), formData)
                .then(res => {
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
                    this.$toast.success('.', 'تم التعديل بنجاح', {
                        timeout: 3000
                    });

                })
                .catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

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
        updateRevisingGuidNotes() {

            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('first_note', this.SelectedItem.first_note ? this.SelectedItem.first_note : '');

            formData.append('second_note', this.SelectedItem.second_note ? this.SelectedItem.second_note : '');
            axios.post(route('revisingGuid.update.admin', this.SelectedItem.id), formData)
                .then(res => {
                    console.log(res);
                    this.$toast.success('.', 'تم التعديل بنجاح', {
                        timeout: 3000
                    });

                })
                .catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                    console.log(error);

                })

        },
        updateRevisingGuidMark() {

            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('mark', this.SelectedItem.mark);
            axios.post(route('revisingGuid.update.admin', this.SelectedItem.id), formData)
                .then(res => {
                    console.log(res);
                    this.$toast.success('.', 'تم التعديل بنجاح', {
                        timeout: 3000
                    });
                })
                .catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                    console.log(error);
                })
            this.EditMark = false;

        },
        DeleteRevisingGuid() {
            this.$refs.CloseRevisingGuidModal.click();
            let i = this.AvailableRevisingGuides.findIndex(child => child.id === this.temp_revisingGuid.id);

            // this.$toast.question('.','تأكيد الحذف ',{
            //     timeout: 40000,
            //     close: false,
            //     overlay: true,
            //     displayMode: 'once',
            //     id: 'question',
            //     zindex: 999,
            //     position: 'center',
            //     buttons: [
            //         ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

            //             axios.delete(route('revisingGuid.destroy.admin',this.temp_revisingGuid.id))
            //                 .then(res =>{
            //                     console.log(res);

            //                     this.AvailableRevisingGuides.splice(i, 1) // remove it from array
            //                     this.$toast.success('.','تم الحذف بنجاح',{timeout:3000});

            //                 })
            //                 .catch(error=>{
            //                     console.log(error);

            //                     this.$toast.warning('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

            this.Added_revisingGuid.Parent = Parent,
                this.newAccountDialog = true;

        },
        ShowUpdateGuidModal(RevisingGuid) {
            this.editAccountDialog = true;
            this.temp_revisingGuid.id = RevisingGuid.id;
            this.temp_revisingGuid.name_alias = RevisingGuid.name_alias;
            this.temp_revisingGuid.name = RevisingGuid.name;
            this.temp_revisingGuid.code_alias = RevisingGuid.code_alias;
            this.temp_revisingGuid.code = RevisingGuid.code;
            this.temp_revisingGuid.AddedByUser = RevisingGuid.AddedByUser;

            this.edited_item = RevisingGuid;
        },
        ShowUpdateChildGuidModal(Parent, RevisingGuid, level) {
            this.editAccountDialog = true;
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
        storeNewRevisingGuid() {

            let formData = new FormData();

            formData.append('name', this.Added_revisingGuid.name);
            formData.append('code', this.Added_revisingGuid.code);
            formData.append('AddedByUser', 1);

            axios.post(route('revisingGuid.store.admin'), formData)
                .then(({
                    data
                }) => {
                    this.AvailableRevisingGuides.push({
                        'id': data[0].id,
                        'name': this.Added_revisingGuid.name,
                        'code': this.Added_revisingGuid.code,
                        'AddedByUser': 1,
                        'code_alias': '',
                        'name_alias': '',
                        'children': []
                    });
                    this.$toast.success('.', 'تم اضافة نموذج بنجاح', {
                        timeout: 3000
                    });
                }).catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                })
            this.$refs.CloseAddRevisingGuidModal.click();
        },
        storeNewChildOfRevisingGuid() {

            let formData = new FormData();

            formData.append('name_alias', this.Added_revisingGuid.name);
            formData.append('code_alias', this.Added_revisingGuid.code);
            formData.append('parent_id', this.Added_revisingGuid.Parent.id);
            formData.append('isText', this.Added_revisingGuid.isText);
            formData.append('default_status', this.Added_revisingGuid.default_status);
            if (this.Added_revisingGuid.default_reference !== null && this.Added_revisingGuid.default_reference !== '' && this.temp_revisingGuid.Added_revisingGuid !== undefined) {
                formData.append('default_reference', this.temp_revisingGuid.default_reference.code ? this.temp_revisingGuid.default_reference.code : this.temp_revisingGuid.default_reference);
            } else {
                formData.append('default_reference', '');
            }
            formData.append('AddedByUser', 1);

            axios.post(route('revisingGuid.store.admin'), formData)
                .then(({
                    data
                }) => {
                    this.Added_revisingGuid.Parent.children.push({
                        'id': data[0].id,
                        'name_alias': this.Added_revisingGuid.name,
                        'code_alias': this.Added_revisingGuid.code,
                        'AddedByUser': 1,
                        'code': '',
                        'name': '',
                        'isText': this.Added_revisingGuid.isText,
                        'default_status': this.Added_revisingGuid.default_status,
                        'default_reference': this.Added_revisingGuid.default_reference.code,
                        'children': []
                    });
                    console.log(this.Added_revisingGuid.Parent.children);

                    this.$toast.success('.', 'تم اضافة نموذج بنجاح', {
                        timeout: 3000
                    });
                }).catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                });
            this.$refs.CloseAddRevisingGuidModal.click();
        },
        updateRevisingGuid() {

            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('code_alias', this.temp_revisingGuid.code_alias ? this.temp_revisingGuid.code_alias : '');
            formData.append('name_alias', this.temp_revisingGuid.name_alias ? this.temp_revisingGuid.name_alias : '');
            formData.append('isText', this.temp_revisingGuid.isText);
            formData.append('default_status', this.temp_revisingGuid.default_status);
            if (this.temp_revisingGuid.default_reference !== null && this.temp_revisingGuid.default_reference !== '' && this.temp_revisingGuid.default_reference !== undefined) {
                formData.append('default_reference', this.temp_revisingGuid.default_reference.code ? this.temp_revisingGuid.default_reference.code : this.temp_revisingGuid.default_reference);
            } else {
                formData.append('default_reference', '');
            }

            axios.post(route('revisingGuid.update.admin', this.temp_revisingGuid.id), formData)
                .then(res => {
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
                    this.$toast.success('.', 'تم التعديل بنجاح', {
                        timeout: 3000
                    });

                })
                .catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

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
        updateRevisingGuidNotes() {

            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('first_note', this.SelectedItem.first_note ? this.SelectedItem.first_note : '');

            formData.append('second_note', this.SelectedItem.second_note ? this.SelectedItem.second_note : '');
            axios.post(route('revisingGuid.update.admin', this.SelectedItem.id), formData)
                .then(res => {
                    console.log(res);
                    this.$toast.success('.', 'تم التعديل بنجاح', {
                        timeout: 3000
                    });

                })
                .catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                    console.log(error);

                })

        },
        updateRevisingGuidMark() {

            let formData = new FormData();
            formData.append('_method', "PATCH");
            formData.append('mark', this.SelectedItem.mark);
            axios.post(route('revisingGuid.update.admin', this.SelectedItem.id), formData)
                .then(res => {
                    console.log(res);
                    this.$toast.success('.', 'تم التعديل بنجاح', {
                        timeout: 3000
                    });
                })
                .catch(error => {
                    this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                        timeout: 3000
                    });

                    console.log(error);
                })
            this.EditMark = false;

        },
        DeleteRevisingGuid() {
            this.$refs.CloseRevisingGuidModal.click();
            let i = this.AvailableRevisingGuides.findIndex(child => child.id === this.temp_revisingGuid.id);

            this.$toast.question('.', 'تأكيد الحذف ', {
                timeout: 40000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                position: 'center',
                buttons: [
                    ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                        axios.delete(route('revisingGuid.destroy.admin', {
                                OfficeBranch: this.temp_revisingGuid.id
                            }))
                            .then(res => {
                                console.log(res);

                                this.AvailableRevisingGuides.splice(i, 1) // remove it from array
                                this.$toast.success('.', 'تم الحذف بنجاح', {
                                    timeout: 3000
                                });

                            })
                            .catch(error => {
                                console.log(error);

                                this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                                    timeout: 3000
                                });

                            })
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                ],
            });

        },
        DeleteChildOfRevisingGuid() {
            this.$refs.CloseRevisingGuidModal.click();

            let i = this.temp_revisingGuid.Parent.children.findIndex(child => child.id === this.temp_revisingGuid.id);

            this.$toast.question('.', 'تأكيد الحذف ', {
                timeout: 40000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                position: 'center',
                buttons: [
                    ['<button style="background-color: red;padding:10px;margin-left:40px;color:white"><b>حذف</b></button>', (instance, toast) => {

                        axios.delete(route('revisingGuid.destroy.admin', this.temp_revisingGuid.id))
                            .then(res => {
                                console.log(res);

                                this.temp_revisingGuid.Parent.children.splice(i, 1) // remove it from array
                                this.$toast.success('.', 'تم الحذف بنجاح', {
                                    timeout: 3000
                                });

                            })
                            .catch(error => {
                                console.log(error);

                                this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                                    timeout: 3000
                                });

                            })
                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }, true],
                    ['<button style="padding:10px;margin-left:40px;color:white"><b>غلق</b></button>', function (instance, toast) {

                        instance.hide({
                            transitionOut: 'fadeOut'
                        }, toast, 'button');

                    }],
                ],
            });
        },
        updateRevisingGuidIndex () {
            let count = 0;
           const data = this.AvailableRevisingGuides.map((element, index) => {
               count++;
               return {
                   id: element.id,
                   order_in_list: index
               }

           }) 

            let formData = new FormData();
           formData.append('_method',"PATCH");
           formData.append('data',JSON.stringify(data));
           formData.append('data_length',count);
            this.LoadingSpinner = true;
           axios.post(route('PatchUpdate.indices'),formData)
               .then(res => {
                   this.LoadingSpinner = false;
                   console.log(res);
                   this.$toast.success('.', 'تم التعديل بنجاح', {
                       timeout: 3000
                   });
               }).catch(error => {
               this.LoadingSpinner = false;
               console.log(error);
               this.$toast.warning('.', 'خطأ يرجى اعادة المحاولة', {
                   timeout: 3000
               });
           })

        }

    }
}
</script>

<style scoped>
.floatLeftAction {
    top: 5px;
    left: 10px;
}

.floatLeftAction2 {
    top: 5px;
    left: 50px;
}

.mainPannelText {
    margin-left: 20px;
    line-height: 20px;
}
</style>
