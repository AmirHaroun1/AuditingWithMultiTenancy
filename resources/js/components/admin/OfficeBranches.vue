<template>
<v-container>
    <v-card>
        <v-card-title class="mb-3">
            <span class="mr-3 ml-3">{{$t('branchesTable')}}</span>
            <v-spacer></v-spacer>
            <v-text-field id="search-box" v-model="search" class="col-md-2 mr-2 ml-2 mt-4" :label="$t('search')" dense small justify="center" single-line solo align-center hide-details append-icon="mdi-search" />
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" width="500">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn color="primary" v-on="on" class="mt-4" dark>
                        <v-icon>mdi-plus</v-icon> {{$t('addNewBranch')}}
                    </v-btn>
                </template>

                <v-card>
                    <v-container>
                        <v-card-title>
                            {{$t('addNewBranch')}}
                        </v-card-title>

                        <v-form>
                            <v-row>
                                <v-col cols="12">
                                    <v-checkbox v-model="newBranch.is_main" outlined :label="$t('isMainBranch')"></v-checkbox>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field v-model="newBranch.name" outlined :label="$t('name')"></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-textarea v-model="newBranch.address" outlined :label="$t('address')"></v-textarea>
                                </v-col>
                            </v-row>
                        </v-form>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" @click="addNewBranch">
                                {{$t('save')}}
                            </v-btn>
                        </v-card-actions>
                    </v-container>
                </v-card>
            </v-dialog>
        </v-card-title>
        <v-data-table :headers="headers" :items="branches" :search="search">
            <template v-slot:item.is_main="{item}">
                <v-icon color="success" v-if="item.is_main">
                    mdi-check
                </v-icon>
                <v-icon v-else color="error">
                    mdi-close
                </v-icon>
            </template>
            <template v-slot:item.action="{item}">
                <v-btn icon @click="selectedItem = item; editDialog = true">
                    <v-icon color="primary">
                        mdi-pencil
                    </v-icon>
                </v-btn>
            </template>
        </v-data-table>

        <v-dialog v-model="editDialog" width="500">
                <v-card>
                    <v-container>
                        <v-card-title>
                            {{$t('editBranch')}}
                        </v-card-title>

                        <v-form>
                            <v-row>
                                <v-col cols="12">
                                    <v-checkbox v-model="selectedItem.is_main" outlined :label="$t('isMainBranch')"></v-checkbox>
                                </v-col>
                                <v-col cols="12">
                                    <v-text-field v-model="selectedItem.name" outlined :label="$t('name')"></v-text-field>
                                </v-col>
                                <v-col cols="12">
                                    <v-textarea v-model="selectedItem.address" outlined :label="$t('address')"></v-textarea>
                                </v-col>
                            </v-row>
                        </v-form>

                        <v-divider></v-divider>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" @click="updateBranch">
                                {{$t('save')}}
                            </v-btn>
                        </v-card-actions>
                    </v-container>
                </v-card>
        </v-dialog>
    </v-card>
</v-container>
</template>

<script>
export default {
    data() {
        return {
            sss: 'dsdasd',
            branches: [],
            search: '',
            selectedItem: {},
            newBranch: {
                is_main: 0
            },
            dialog: false,
            editDialog: false,
            headers: [{
                    text: this.$t('name'),
                    align: 'start',
                    value: 'name',
                },
                {
                    text: this.$t('address'),
                    align: 'start',
                    value: 'address',
                },
                {
                    text: this.$t('isMainBranch'),
                    align: 'start',
                    value: 'is_main',
                },
                {
                    text: this.$t('action'),
                    value: 'action',
                },
            ],
        }
    },
    methods: {
        getAllBranches() {
            axios.get(route('OfficeBranches.index')).then((result) => {
                console.log('res', result);
                this.branches = result.data.OfficeBranches
            }).catch((err) => {
                console.log('err', error);
            });
        },
        addNewBranch() {
            axios.post(route('OfficeBranches.index'), this.newBranch).then((result) => {
                console.log('res', result);
                this.dialog = false
            }).catch((err) => {
                console.log('err', err);
                window.alert(err)
                this.dialog = false
            });
        },
        updateBranch() {
            const data = new FormData()
            data.append('name', this.selectedItem.name)
            data.append('address', this.selectedItem.address)
            data.append('is_main', this.selectedItem.is_main)
            axios.put(route('OfficeBranches.index', this.selectedItem.id), data).then((result) => {
                console.log('res', result);
                this.editDialog = false
            }).catch((err) => {
                console.log('err', err);
                window.alert(err)
                this.editDialog = false
            });
        },
    },
    created() {
        this.getAllBranches()
    },
}
</script>
