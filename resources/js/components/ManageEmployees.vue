<template>
<v-container>
    <v-card>
        <v-card-title class="mb-3">
            <span class="mr-3 ml-3">جدول الموظفين</span>
            <v-spacer></v-spacer>
            <v-text-field id="search-box" height="32px" v-model="search" class="col-md-2 mr-2 ml-2 mt-4" label="Search" dense small justify="center" single-line solo align-center hide-details append-icon="mdi-search" />
            <v-spacer></v-spacer>
            <v-autocomplete label="Filter" multiple v-model="filter" height="32px" class="col-md-2 mt-4 mr-2" :items="predefinedFilters" dense small justify="center" single-line solo align-center hide-details />
            <v-spacer></v-spacer>
            <v-btn color="#3161BE" dark heigh="30px" style="color:#FFFFFF !important" class="ml-1 mt-4">
                <v-icon>mdi-plus</v-icon> موظف جديد
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
            headers: [{
                    text: 'الأسم',
                    align: 'start',
                    value: 'name',
                },
                {
                    text: 'الوظيفة',
                    value: 'role'
                },
                {
                    text: 'رقم الجوال',
                    value: 'phone'
                },
                {
                    text: 'الإيميل',
                    value: 'email'
                },
            ],
            predefinedFilters: [{
                text: 'الاسم',
                value: ''
            }, {
                text: 'رقم الهاتف',
                value: 'Active'
            }, {
                text: 'الإيميل',
                value: 'Inactive'
            }, {
                text: 'الوظيفة',
                value: 'Intrial'
            }, {
                text: 'تاريخ الميلاد',
                value: 'Renewing'
            }, {
                text: 'Non-Renewing',
                value: 'NonRenewing'
            }],
            desserts: [{
                    name: 'Frozen Yogurt',
                    calories: 159,
                    fat: 6.0,
                    carbs: 24,
                    protein: 4.0,
                    iron: '1%',
                },
                {
                    name: 'Ice cream sandwich',
                    calories: 237,
                    fat: 9.0,
                    carbs: 37,
                    protein: 4.3,
                    iron: '1%',
                },
                {
                    name: 'Eclair',
                    calories: 262,
                    fat: 16.0,
                    carbs: 23,
                    protein: 6.0,
                    iron: '7%',
                },
                {
                    name: 'Cupcake',
                    calories: 305,
                    fat: 3.7,
                    carbs: 67,
                    protein: 4.3,
                    iron: '8%',
                },
                {
                    name: 'Gingerbread',
                    calories: 356,
                    fat: 16.0,
                    carbs: 49,
                    protein: 3.9,
                    iron: '16%',
                },
                {
                    name: 'Jelly bean',
                    calories: 375,
                    fat: 0.0,
                    carbs: 94,
                    protein: 0.0,
                    iron: '0%',
                },
                {
                    name: 'Lollipop',
                    calories: 392,
                    fat: 0.2,
                    carbs: 98,
                    protein: 0,
                    iron: '2%',
                },
                {
                    name: 'Honeycomb',
                    calories: 408,
                    fat: 3.2,
                    carbs: 87,
                    protein: 6.5,
                    iron: '45%',
                },
                {
                    name: 'Donut',
                    calories: 452,
                    fat: 25.0,
                    carbs: 51,
                    protein: 4.9,
                    iron: '22%',
                },
                {
                    name: 'KitKat',
                    calories: 518,
                    fat: 26.0,
                    carbs: 65,
                    protein: 7,
                    iron: '6%',
                },
            ],
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
