<template>
<div>
    <v-card-title>
        {{$t('dropdowns')}}
    </v-card-title>
    <v-card-subtitle>
        {{$t('setting')}}
    </v-card-subtitle>
    <v-tabs background-color="primary" dark>
        <v-tab v-for="dropdown in SystemDropDowns" :key="dropdown.CollapseLink">
            {{dropdown.name}}
        </v-tab>
        <v-tab-item v-for="dropdown in SystemDropDowns" :key="dropdown.name">
            <v-card flat>
                <v-card-text>
                    <v-row>
                        <v-col cols="6">
                            <v-text-field v-model="dropdown.NewOption" :label="$t('newOption')" dense clearable small outlined />
                        </v-col>
                        <v-btn color="primary" class="col-md-2 mt-4 mr-2" @click="AddDropDownOption(dropdown)" dark v-bind="attrs" v-on="on">
                            <v-icon>mdi-plus</v-icon> {{$t('newOption')}}
                        </v-btn>
                    </v-row>

                    <v-data-table :headers="headers" :items="dropdown.CurrentOptions">
                        <template v-slot:item.value="props">
                            <v-edit-dialog :return-value.sync="props.item.value" @save="UpdateDropDownOption(props.item)" @cancel="cancel" @open="open" @close="close">
                                {{ props.item.value }}
                                <template v-slot:input>
                                    <v-text-field v-model="props.item.value" :label="$t('edit')" single-line counter></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </template>
                        <template v-slot:item.action="props">
                            <v-btn @click="DeleteDropDownOption(props.item, dropdown.CurrentOptions)" fab dark x-small color="error">
                                <v-icon dark>
                                    mdi-delete
                                </v-icon>
                            </v-btn>
                        </template>
                    </v-data-table>

                    <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
                        {{ snackText }}

                        <template v-slot:action="{ attrs }">
                            <v-btn v-bind="attrs" text @click="snack = false">
                                {{$t('close')}}
                            </v-btn>
                        </template>
                    </v-snackbar>
                </v-card-text>
            </v-card>
        </v-tab-item>
    </v-tabs>
</div>
</template>

<script>
export default {
    name: "DropDownsManagement",

    data() {
        return {
            SystemDropDowns: [{
                    name: 'الكيان القانونى',
                    NewOption: '',
                    type: 'قائمة منسدلة',
                    CurrentOptions: [],
                    CollapseLink: 1
                },
                {
                    name: 'اهتمامات الملاك',
                    NewOption: '',
                    type: 'قائمة منسدلة',
                    CurrentOptions: [],
                    CollapseLink: 2
                },
                {
                    name: 'طبيعة ملكية المنشأة وكيفية تمويلها',
                    NewOption: '',
                    type: 'قائمة منسدلة',
                    CurrentOptions: [],
                    CollapseLink: 3
                },
                {
                    name: 'المدينة',
                    NewOption: '',
                    type: 'قائمة منسدلة',
                    CurrentOptions: [],
                    CollapseLink: 4
                },
                {
                    name: 'محددات معيار القياس',
                    NewOption: '',
                    type: 'قائمة منسدلة',
                    CurrentOptions: [],
                    CollapseLink: 6
                },
                {
                    name: 'معيار القياس',
                    NewOption: '',
                    type: 'قائمة منسدلة',
                    CurrentOptions: [],
                    CollapseLink: 7
                },
            ],
            tab: null,
            snack: false,
            snackColor: '',
            snackText: '',
            max25chars: v => v.length <= 25 || 'Input too long!',
            pagination: {},
            headers: [{
                    text: this.$t('name'),
                    align: 'start',
                    sortable: false,
                    value: 'value',
                },
                {
                    text: this.$t('delete'),
                    value: 'action'
                }
            ]
        }
    },
    mounted() {
        this.GetAvailableDropDownOptions();
    },
    methods: {
        GetAvailableDropDownOptions() {
            axios.get(route('system.DropDowns.retrieve.option'))
                .then(({
                    data
                }) => {
                    data.DropDownsOptions.forEach((option, index) => {

                        if (option.name == 'الكيان القانونى') {
                            this.SystemDropDowns[0].CurrentOptions.push(option);
                        } else if (option.name == 'اهتمامات الملاك') {
                            this.SystemDropDowns[1].CurrentOptions.push(option);
                        } else if (option.name == 'طبيعة ملكية المنشأة وكيفية تمويلها') {
                            this.SystemDropDowns[2].CurrentOptions.push(option);
                        } else if (option.name == 'المدينة') {
                            this.SystemDropDowns[3].CurrentOptions.push(option);
                        } else if (option.name == 'محددات معيار القياس') {
                            this.SystemDropDowns[4].CurrentOptions.push(option);
                        } else if (option.name == ' معيار القياس') {
                            this.SystemDropDowns[5].CurrentOptions.push(option);
                        }
                    })
                })
        },
        AddDropDownOption(dropdown) {
            let formData = new FormData();

            formData.append('name', dropdown.name);
            formData.append('value', dropdown.NewOption);
            formData.append('type', dropdown.type);

            axios.post(route('system.DropDowns.store.option'), formData)
                .then(({
                    data
                }) => {
                    console.log(data[0]);
                    dropdown.CurrentOptions.push(data[0]);
                    this.dropdown.NewOption = '';
                }).catch((error) => {

                })
        },
        DeleteDropDownOption(option, CurrentOptions) {
            let formData = new FormData();

            formData.append('_method', 'DELETE');
            axios.post(route('system.DropDowns.delete.option', option.id), formData)
                .then((res) => {
                    CurrentOptions.splice(CurrentOptions.indexOf(option), 1)
                })
                .catch((error) => {

                })
        },
        UpdateDropDownOption(option) {
            let formData = new FormData();

            formData.append('_method', 'PATCH');
            formData.append('name', option.name);
            formData.append('value', option.value);
            formData.append('type', option.type);
            axios.post(route('system.DropDowns.update.option', option.id), formData)
                .then((res) => {
                    console.log('updated');
                })
                .catch((error) => {

                })
        },
        save() {
            this.snack = true
            this.snackColor = 'success'
            this.snackText = this.$t('saved')
        },
        cancel() {
            this.snack = true
            this.snackColor = 'error'
            this.snackText = this.$t('cancel')
        },
        open() {
            this.snack = true
            this.snackColor = 'info'
            this.snackText = this.$t('editEnabled')
        },
        close() {
            console.log('Dialog closed')
        },
    },
    computed: {

    }
}
</script>

<style scoped>

</style>
