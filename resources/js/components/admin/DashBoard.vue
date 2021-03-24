<template>
<div>
    <h3 class="text-center" style="text-align:center;">
        لوحة التحكم
    </h3>
    <v-row class="mb-8">
        <v-col cols="4">
            <v-card>
                <pie-chart :data="chartData" :options="chartOptions" title="التعاملات النشطه لكل موظف "></pie-chart>
            </v-card>
        </v-col>
        <v-col cols="8">
            <v-card>
                <v-subheader>
                    <span class="ma-2">
                        التعاملات
                    </span>
                </v-subheader>
                <v-list dense three-line>
                    <v-simple-table dense>
                        <tbody>
                            <tr>
                                <td>تعاملات السنه الحاليه:</td>
                                <td>{{TransactionsStatus[0].CurrentYearTransactions}}</td>
                            </tr>
                            <tr>
                                <td>تعاملات السنه السابقه:</td>
                                <td>{{TransactionsStatus[0].PastYearTransactions}}</td>
                            </tr>
                            <tr>
                                <td>تعاملات مسحوبه:</td>
                                <td>{{TransactionsStatus[0].WithdrawnTransactions}}</td>
                            </tr>
                            <tr>
                                <td>تعاملات مرفوضه:</td>
                                <td>{{TransactionsStatus[0].rejectedTransactions}}</td>
                            </tr>
                            <tr>
                                <td>تعاملات تحت المراجعة:</td>
                                <td>{{TransactionsStatus[0].TransactionsUnderReview}}</td>
                            </tr>
                            <tr>
                                <td>تعاملات تغيرت من المراجع:</td>
                                <td>{{TransactionsStatus[0].TransactionsAuditorIsChanged}}</td>
                            </tr>
                            <tr style="border: solid; font-weight:bold">
                                <td>كل التعاملات:</td>
                                <td>{{TransactionsStatus[0].AllTransactions}}</td>
                            </tr>
                        </tbody>
                    </v-simple-table>
                </v-list>
            </v-card>
        </v-col>
        <v-col cols="4">
            <v-card>
                <pie-chart :data="chartData2" :options="chartOptions" title="التعاملات مع كل من "></pie-chart>
            </v-card>
        </v-col>
        <v-col cols="4">
            <v-card>
                <pie-chart :data="chartDataLate" :options="chartOptions" title="التعاملات المتأخرة مع كل من"></pie-chart>
            </v-card>
        </v-col>
    </v-row>
</div>
</template>

<script>
import PieChart from "../PieChart.js";

export default {
    name: "DashBoard",
    props: {
        'TransactionsStatus': '',
        'Team': '',
    },
    components: {
        PieChart
    },
    data() {
        return {
            chartOptions: {
                hoverBorderWidth: 20,
                title: {
                    display: true,
                    text: 'Custom Chart Title'
                }
            }

        };
    },
    computed: {
        chartData() {
            const data = {
                hoverBackgroundColor: "red",
                title: {
                    display: true,
                    text: 'Custom Chart Title'
                },
                hoverBorderWidth: 10,
                labels: this.Team.map(x => {
                    return `${x.name} (${x.role})`
                }),
                datasets: [{
                    label: "Data One",
                    backgroundColor: this.Team.map(x => {
                        return this.getRandomColor()
                    }),
                    data: this.Team.map(x => {
                        return x.ActiveTransactions
                    })
                }]
            }
            return data
        },
        chartData2() {
            let rolesArray = ["TransactionsWithReviser", "TransactionsWithAuditor", "TransactionsWithRevisingManager", "TransactionsWithManagingPartner"]
            const data = {
                hoverBackgroundColor: "red",
                title: {
                    display: true,
                    text: 'Custom Chart Title'
                },
                hoverBorderWidth: 10,
                labels: ["مراجع فني", "مدير مراجعة" , "مدير مراجعة" , "شريك إدارى"] ,
                datasets: [{
                    label: "Data One",
                    backgroundColor: rolesArray.map(x => {
                        return this.getRandomColor()
                    }),
                    data: rolesArray.map(x => {
                        return this.TransactionsStatus[0][x]
                    })
                }]
            }
            return data
        },
        chartDataLate() {
            let rolesArray = ["LateTransactionAtSecretary", "LateTransactionAtReviser", "LateTransactionAtAuditor", "LateTransactionAtRevisingManager", "LateTransactionAtManagingPartner"]
            const data = {
                hoverBackgroundColor: "red",
                title: {
                    display: true,
                    text: 'Custom Chart Title'
                },
                hoverBorderWidth: 10,
                labels: ["سكرتير", "مراجع فني", "مدير مراجعة" , "مدير مراجعة" , "شريك إدارى"] ,
                datasets: [{
                    label: "Data One",
                    backgroundColor: rolesArray.map(x => {
                        return this.getRandomColor()
                    }),
                    data: rolesArray.map(x => {
                        return this.TransactionsStatus[0][x]
                    })
                }]
            }
            return data
        },
    },
    methods: {
        getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    },
}
</script>

<style scoped>

</style>
