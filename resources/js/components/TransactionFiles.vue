<template>
    <div class="container box" style="margin-top: 20px">
        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin">
            </i>
        </div>
        <div class="row">
            <div class="box-header">
                <h2>الملفات الخاصة بالمراجعة</h2>
            </div>
            <div class="box-body">
                <table class="table table-bordered" >
                    <tbody><tr>
                        <th>كود الملف</th>
                        <th>أسم الملف</th>
                        <th>رابط الملف</th>
                        <th class="text-center">التعليق</th>
                    </tr>
                    <tr v-for="(document,index) in documents">
                        <td>{{document.code}}</td>
                        <td>{{document.name}}</td>
                            <td>
                                <a v-for="DocumentInfo in document.transactions" :href="DownloadDocumentLink(DocumentInfo.pivot.DocumentPath,DocumentInfo.pivot.original_name)" target="_blank" ><br>{{DocumentInfo.pivot.original_name}}</a>
                                <h4 v-if="!document.transactions.length" class="text-danger"><i class="fa fa-warning"></i> لا يوجد </h4>
                            </td>
                            <td>
                                <div class="col-md-9">
                                    <textarea style="height:50px;width:100%" v-if="document.transactions.length" class="form-control" v-model="document.transactions[0].pivot.comment" ></textarea>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success" v-if="document.transactions.length" @click="UpdateTransactionDocument(document.transactions[0].pivot.comment,document.id)">حفظ</button>
                                </div>
                            </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "TransactionFiles",
        props:{
          'Transaction':'',
        },
        data(){
            return{
                LoadingSpinner:'',
                documents:[],
            }
        },
        created() {
            this.FetchDocuments(route('documents.index',this.Transaction.id))
        },
        methods:{
            FetchDocuments(endpoint){
                this.LoadingSpinner = true;
                axios.get(endpoint)
                    .then(({data})=>{
                        this.LoadingSpinner = false;
                        this.documents.push(...data.RequiredDocuments);
                    }).catch((error)=>{
                        this.$toast.error('.','حدث خطأ, يرجى اعادة المحاولة');
                })
            },
            UpdateTransactionDocument(documentComment,documentID){
                let formData = new FormData();
                formData.append('_method','PATCH');
                formData.append('comment',documentComment);
                formData.append('TransactionId',this.Transaction.id);
                formData.append('DocumentId',documentID);
                axios.post(route('TransactionDocument.Update'),formData)
                    .then((res)=>{
                        this.$toast.success('.','تمت أضافة التعليق بنجاح',{timeout:3000});

                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('.','خطأ يرجى اعادة المحاولة',{timeout:3000});

                })
            },
            DownloadDocumentLink(path,name){
                path = path.replace('InstitutionsDocuments/','');
                return route('TransactionDocuments.DownloadDocument',[path,name]);
            },
        },
    }
</script>

<style scoped>

</style>
