<template>
<v-container>
    <v-card>
        <v-card-title class="mb-3">
            <span class="mr-3 ml-3">{{$t('employeesTable')}}</span>
            <v-spacer></v-spacer>
            <v-text-field id="search-box" height="32px" v-model="search" class="col-md-2 mr-2 ml-2 mt-4" :label="$t('search')" dense small justify="center" single-line solo align-center hide-details append-icon="mdi-search" />
            <v-spacer></v-spacer>
            <v-autocomplete :label="$t('filter')" multiple return-object v-model="headers" height="32px" class="col-md-2 mt-4 mr-2" :items="predefinedFilters" dense small justify="center" single-line solo align-center hide-details />
            <v-spacer></v-spacer>
            <v-btn color="#3161BE" dark heigh="30px" style="color:#FFFFFF !important" class="ml-1 mt-4">
                <v-icon>mdi-plus</v-icon> {{$t('newEmployee')}}
            </v-btn>
        </v-card-title>
        <v-data-table :headers="headers" :items="employeesArray" :search="search">
        </v-data-table>
    </v-card>
</v-container>
</template>

<script>
export default {
    data() {
        return {
            search: "",
            loading: true,
            dialog: false,
            filter: [],
            headers: [
                {
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
            ],
            predefinedFilters:
         [
                {
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

<style>
.statusDot {
    font-size: 50px;
}
.sb-input {
    font-size: 15px;
    max-height: 50px;
}
</style>
