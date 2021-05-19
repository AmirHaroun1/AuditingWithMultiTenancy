<template>
<v-container>
    <v-card>
        <v-card-title class="mb-3">
            <span class="mr-3 ml-3">{{$t('employeesTable')}}</span>
            <v-spacer></v-spacer>
            <v-text-field id="search-box" v-model="search" class="col-md-2 mr-2 ml-2 mt-4" :label="$t('search')" dense small justify="center" single-line solo align-center hide-details append-icon="mdi-search" />
            <v-spacer></v-spacer>
            <v-autocomplete :label="$t('filter')" hide-details dense chips multiple return-object v-model="headers" outlined class="col-md-3 mt-4 mr-2" :items="predefinedFilters" dense small justify="center">
                <template v-slot:selection="{ item, index }">
                    <v-chip small v-if="index === 0">
                        <span>{{ item.text }}</span>
                    </v-chip>
                    <span v-if="index === 1" class="grey--text caption">
                        (+{{ headers.length - 1 }} {{$t('others')}})
                    </span>
                </template>
            </v-autocomplete>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="600px">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn color="primary" class="mt-4" dark v-bind="attrs" v-on="on">
                        <v-icon>mdi-plus</v-icon> {{$t('newEmployee')}}
                    </v-btn>
                </template>
                <newEmployee @close="dialog = false" />
            </v-dialog>
        </v-card-title>
        <v-data-table :headers="headers" :items="employeesArray" :search="search">
                <template :ref="item.id" v-slot:item.action="{ item }">
                    <v-icon small color="primary">
                        mdi-pencil
                    </v-icon>
                    <v-icon small color="error">
                        mdi-delete
                    </v-icon>
                    <v-icon small color="grey">
                        mdi-printer
                    </v-icon>
                </template>
        </v-data-table>
    </v-card>
</v-container>
</template>

<script>
import newEmployee from './new'
export default {
    components: {
        newEmployee
    },
    data() {
        return {
            search: "",
            loading: true,
            dialog: false,
            filter: [],
            headers: [{
                    text: this.$t('name'),
                    align: 'start',
                    value: 'name',
                },
                {
                    text: this.$t('job'),
                    value: 'role'
                },
                {
                    text: this.$t('phoneNumber'),
                    value: 'phone'
                },
                {
                    text: this.$t('email'),
                    value: 'email'
                },
                {
                    text: this.$t('action'),
                    value: 'action'
                },
            ],
            predefinedFilters: [{
                    text: this.$t('name'),
                    align: 'start',
                    value: 'name',
                },
                {
                    text: this.$t('job'),
                    value: 'role'
                },
                {
                    text: this.$t('phoneNumber'),
                    value: 'phone'
                },
                {
                    text: this.$t('email'),
                    value: 'email'
                },
                {
                    text: this.$t('birth_date'),
                    value: 'birth_date'
                },
                {
                    text: this.$t('code'),
                    value: 'code'
                },
                {
                    text: this.$t('national_id'),
                    value: 'national_id'
                },
                {
                    text: this.$t('national_id_date'),
                    value: 'national_id_date'
                },
            ]
        };
    },
    props: ['employees'],
    mounted() {
        this.loading = false
    },
    methods: {
        ViewPlanProfile(item) {
            this.$router.push('./plans/' + item.id);
        }
    },
    filters: {
        stripWord(word, maxLength) {
            if (word.length > maxLength) {
                return word.substring(0, maxLength) + ".."
            } else {
                return word
            }
        },
        customizeDate(date) {
            return moment(date).format("DD/MM/YYYY");
        }
    },
    computed: {
        employeesArray() {
            return JSON.parse(this.employees).data
        }
    }
};
</script>
