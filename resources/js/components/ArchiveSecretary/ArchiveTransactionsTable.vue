<template>
    <div style="padding-top: 20px">
   <v-container>
        <v-card>
            <v-card-title class="mb-3">
                <span class="mr-3 ml-3">{{$t('transactionsTable')}}</span>
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
                <v-btn color="primary" link :href="route('Transactions.create')" class="mt-4" dark>
                    <v-icon>mdi-plus</v-icon> {{$t('newTransaction')}}
                </v-btn>
            </v-card-title>
            <v-data-table :headers="headers" :items="Transactions" :search="search">
                <template v-slot:item.MainTradeRegisterNumber="{ item }">
                    <a :href="route('RevisingGuid.index.archive',item.id)">
                        {{item.MainTradeRegisterNumber}}
                    </a>
                </template>
                <template :ref="item.id" v-slot:item.action="{ item }">
                    <v-icon small @click="printRow(item.id)">
                        mdi-printer
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
    </div>

</template>

<script>

    export default {
        name: "ArchiveTransactionsTable",
        data(){
            return{
                LoadingSpinner:false,
                Transactions:[],
                SearchedTransactions:[],
                SearchMainRegisterNumber:'',
                OrderByCase:'latest',
                            predefinedFilters: [{
                    text: this.$t('mainItemNumber'),
                    align: 'start',
                    value: 'MainTradeRegisterNumber',
                },
                {
                    text: this.$t('TransactionChirstianDate'),
                    value: 'created_at'
                },
                {
                    text: this.$t('TransactionHijriDate'),
                    value: 'hijri_created_at'
                },
                {
                    text: this.$t('status'),
                    value: 'status'
                },
                {
                    text: this.$t('financialChristianYear'),
                    value: 'financial_year'
                },
                {
                    text: this.$t('financialHijriYear'),
                    value: 'hijri_financial_year'
                },
                {
                    text: this.$t('action'),
                    value: 'action'
                },
                {
                    text: this.$t('Managing_partner_actualTime'),
                    value: 'Managing_partner_actualTime'
                },
                {
                    text: this.$t('Managing_partner_time'),
                    value: 'Managing_partner_time'
                },
                {
                    text: this.$t('agreed_contract_value'),
                    value: 'agreed_contract_value'
                },
                {
                    text: this.$t('archiveSecretary_notes'),
                    value: 'archiveSecretary_notes'
                },
                {
                    text: this.$t('auditor_actualTime'),
                    value: 'auditor_actualTime'
                },
                {
                    text: this.$t('auditor_time'),
                    value: 'auditor_time'
                },
                {
                    text: this.$t('down_payment'),
                    value: 'down_payment'
                },
                {
                    text: this.$t('end_financial_year'),
                    value: 'end_financial_year'
                },
                {
                    text: this.$t('engagement_letter_date'),
                    value: 'engagement_letter_date'
                },
                {
                    text: this.$t('final_payment'),
                    value: 'final_payment'
                },
                {
                    text: this.$t('down_payment'),
                    value: 'down_payment'
                },
            ],
            headers: [{
                    text: this.$t('mainItemNumber'),
                    align: 'start',
                    value: 'MainTradeRegisterNumber',
                },
                {
                    text: this.$t('TransactionChirstianDate'),
                    value: 'created_at'
                },
                {
                    text: this.$t('TransactionHijriDate'),
                    value: 'hijri_created_at'
                },
                {
                    text: this.$t('status'),
                    value: 'status'
                },
                {
                    text: this.$t('financialChristianYear'),
                    value: 'financial_year'
                },
                {
                    text: this.$t('financialHijriYear'),
                    value: 'hijri_financial_year'
                },
                {
                    text: this.$t('action'),
                    value: 'action'
                },
            ],
            search: "",

                FetchPaginationData:{
                    'current_page' : 0,
                    'last_page' : '',
                    'next_page_url' : '',
                    'prev_page_url' : '',
                },
                SearchPaginationData:{
                    'current_page' : 0,
                    'last_page' : '',
                    'next_page_url' : '',
                    'prev_page_url' : '',
                },

            }
        },
        created() {
            this.fetchTransactions();
        },
        methods:
            {
                fetchTransactions(page=1){
                    this.LoadingSpinner = true;
                    axios.get(route('transactions.index',{OrderByCase:this.OrderByCase,page}))
                        .then(({data})=>{

                            this.LoadingSpinner = false;

                            this.FetchPaginationData.current_page = data.transactions.current_page;
                            this.FetchPaginationData.last_page = data.transactions.last_page;
                            this.FetchPaginationData.next_page_url = data.transactions.next_page_url;
                            this.FetchPaginationData.prev_page_url = data.transactions.prev_page_url;

                            this.Transactions =[];
                            this.Transactions.push(...data.transactions.data);


                        })
                },
                search(page = 1){
                    this.LoadingSpinner = true;

                    axios.get(route('transactions.index',{OrderByCase:this.OrderByCase,MainRegisterNumber:this.SearchMainRegisterNumber,page}))
                        .then(({data})=>{
                            this.LoadingSpinner = false;

                            this.SearchPaginationData.current_page = data.transactions.current_page;
                            this.SearchPaginationData.last_page = data.transactions.last_page;
                            this.SearchPaginationData.next_page_url = data.transactions.next_page_url;
                            this.SearchPaginationData.prev_page_url = data.transactions.prev_page_url;

                            this.SearchedTransactions = [];
                            this.SearchedTransactions.push(...data.transactions.data);

                            if(!this.SearchedTransactions.length){
                                this.$toast.warning(',',
                                    'لا يوجد معاملات تحتوى على رقم السجل'
                                    ,{timout:2000});
                            }
                        })
                },

            },
    }
</script>

<style scoped>

</style>
