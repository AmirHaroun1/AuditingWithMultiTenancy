<template>
    <div class="box" style="padding-top: 20px">

        <div class="box-header" style="padding-top:30px">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="header">جدول المعاملات</h3>
                </div>
                <div class="col-md-5 ">
                    <div class="input-group " style="padding-top: 20px">
                        <input v-model="SearchMainRegisterNumber" type="text" class="form-control input-sm pull-right" style="height: 35px" placeholder="ابحث برقم السجل الرئيسي">
                        <div class="input-group-btn">
                            <button @click="search()" class="btn btn-sm btn-default" style="height: 35px"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                        <label>الترتيب</label>
                        <select @change="[SearchedTransactions.length ? search() : fetchTransactions() ]" v-model="OrderByCase" class="form-control">
                            <option selected></option>
                            <option value="latest">الأحدث</option>
                            <option value="oldest">الأقدم</option>
                        </select>
                </div>

            </div>

        </div>
        <div class="box-body table-responsive no-padding">
            <h4 @click="SearchedTransactions=[]" v-if="SearchedTransactions.length" class="text-center" style="color:red;cursor:pointer">حذف نتائج البحث <i class="fa fa-times"></i> </h4>
            <table class="table table-hover">

                <tbody><tr>
                    <th>رقم السجل الرئيسي</th>
                    <th>تاريخ تسجيل المعاملة (ميلادي)</th>
                    <th>تاريخ تسجيل المعاملة (هجري)</th>
                    <th>الحالة</th>
                    <th>السنة المالية (ميلادي)</th>
                    <th>السنة المالية (هجري)</th>
                </tr>
                <tr v-if="SearchedTransactions.length" v-for="transaction in SearchedTransactions">
                    <td><a :href="route('transactions.edit.secretary',transaction.id)"> {{transaction.MainTradeRegisterNumber}}</a></td>
                    <td>{{transaction.created_at}}</td>
                    <td>{{transaction.hijri_created_at}}</td>
                    <td><h4  style="color: red">{{transaction.status}}</h4></td>
                    <td>{{transaction.financial_year}}</td>
                    <td>{{transaction.hijri_financial_year}}</td>
                </tr>
                <tr v-if="!SearchedTransactions.length" v-for="transaction in Transactions">

                    <td><a :href="route('transactions.edit.secretary',transaction.id)"> {{transaction.MainTradeRegisterNumber}}</a></td>
                    <td>{{transaction.created_at}}</td>
                    <td>{{transaction.hijri_created_at}}</td>
                    <td><h4  style="color: red">{{transaction.status}}</h4></td>
                    <td>{{transaction.financial_year}}</td>
                    <td>{{transaction.hijri_financial_year}}</td>
                </tr>

                <div v-if="LoadingSpinner" class="overlay">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                </tbody>
            </table>

            <div v-if="!SearchedTransactions.length" class="pagination text-center">
                <button class="btn btn-default" @click="fetchTransactions(FetchPaginationData.current_page-1)" :disabled="!FetchPaginationData.prev_page_url">السابق</button>
                <span>صفحة
                    {{FetchPaginationData.current_page}}
                    من
                    {{FetchPaginationData.last_page}}
                </span>
                <button class="btn btn-default" @click="fetchTransactions(FetchPaginationData.current_page+1)" :disabled="!FetchPaginationData.next_page_url">التالي</button>

            </div>
            <div v-else-if="SearchedTransactions.length" class="pagination text-center">
                <button class="btn btn-default" @click="search(SearchPaginationData.current_page-1)" :disabled="!SearchPaginationData.prev_page_url">السابق</button>
                <span>صفحة
                    {{SearchPaginationData.current_page}}
                    من
                    {{SearchPaginationData.last_page}}
                </span>
                <button class="btn btn-default" @click="search(SearchPaginationData.current_page+1)" :disabled="!SearchPaginationData.next_page_url">التالي</button>

            </div>
        </div>
    </div>

</template>

<script>

    export default {
        name: "TransactionsTable",
        data(){
            return{
                LoadingSpinner:false,
                Transactions:[],
                SearchedTransactions:[],
                SearchMainRegisterNumber:'',
                OrderByCase:'latest',

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
