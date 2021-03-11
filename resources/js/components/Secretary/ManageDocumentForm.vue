<template>
    <div>

        <form class="form-group"  enctype="multipart/form-data" @submit.prevent="UploadDocuments()">
            <div class="row">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>المستند : {{document.name}}</h3>
                        </div>
                        <div v-if="UploadProgress" class="col-md-6 " :style="[UploadIsSuccess ? {color: 'green'} : {color : 'red'} ]">
                            <h3>عدد الملفات :
                                {{UploadedDocuments.length}}
                                ,
                                {{UploadMessage}}
                            </h3>
                            <h3 v-if="UploadProgress">    {{UploadProgress }} %  </h3>
                        </div>
                        <div v-if="DeleteProgress" class="col-md-6 " :style="[DeleteIsSuccess ? {color: 'red'} : {color : 'yellow'} ]">
                            <h3>
                                عدد الملفات :
                                {{DeletedCount}}
                                ,
                                {{DeleteMessage}}
                            </h3>
                        </div>
                    </div>

                </div>
                <div class="col-md-3 justify-content-between">
                    <input type="file" ref="FileContainer" class="form-control" accept=".jpeg,.png,.svg,.jpg,.pdf" multiple>
                </div>
                <div class="col-md-2">
                    <button  class="btn btn-success btn-sm">تحميل</button>
                </div>
            </div>
        </form>
        <ol >
            <li v-for="document in UploadedDocuments" class="justify-content-between" style="margin-top: 20px">
                <a :href="DownloadDocumentLink(document.DocumentPath,document.original_name)" target="_blank" >{{document.original_name}}</a>
                <button @click="DeleteDocuments(document)" class="btn btn-danger btn-md" >حذف</button>
            </li>
        </ol>
        <hr>
    </div>
</template>

<script>
    export default {
        props :{
            'document' : Object,

        },
        name : "ManageDocumentForm",
        data (){
            return{
                transaction : this.$parent.Transaction,
                //upload documents
                UploadProgress : null,
                UploadMessage: '',
                UploadIsSuccess : '',
                UploadedDocuments : [],
                //remove documents
                DeleteProgress : null,
                DeleteMessage: '',
                DeleteIsSuccess : '',
                DeletedCount : 0,
            }
        },
        created() {
           if(this.document.transactions.length){
               this.document.transactions.forEach((document)=>{
                   this.UploadedDocuments.push(document.pivot);
               });
           }
        },
        methods : {

            UploadDocuments() {
                this.UploadProgress = 0;
                this.DeleteProgress = null;
                this.DeletedCount = 0;
                this.DeleteIsSuccess = '';
                this.uploadFiles(event => {
                    this.UploadProgress = Math.round((100 * event.loaded) / event.total);
                })
            },

            uploadFiles(onUploadProgress) {

                if (this.$refs.FileContainer.files.length > 0) {
                    Array.prototype.forEach.call(this.$refs.FileContainer.files, file => {
                        let formData = new FormData();
                        formData.append('file', file);
                        return axios.post(route('TransactionDocuments.AddDocument', [this.transaction.id, this.document.id]), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            },
                            onUploadProgress
                        })
                            .then(({data}) => {
                                this.UploadMessage = 'تم الرفع بنجاح';
                                this.UploadIsSuccess = true;
                                console.log(data);
                                this.UploadedDocuments.push({'id':data.FileID,'original_name':data.FileName,'DocumentPath':data.FilePath});
                            })
                            .catch((error) => {
                                console.log(error);
                                this.UploadMessage = 'خطأ اثناء الرفع';
                                this.UploadIsSuccess = false;
                            })
                    });
                } else {
                    this.UploadMessage = 'أختر الملف'
                    this.UploadIsSuccess = false;
                }
            },

            DeleteDocuments(file) {
                this.DeleteProgress = 0;
                this.UploadProgress = null;
                this.UploadIsSuccess = false;
                    this.DeleteFiles(file);
            },

            DeleteFiles(file) {
                    let formData = new FormData();
                    formData.append("_method", 'DELETE');
                    formData.append("FilePath", file.DocumentPath);
                    return axios.post(route('TransactionDocuments.removeDocument', [file.id]), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    })
                        .then((res)=>{
                                this.DeleteMessage = 'تم الحذف بنجاح';
                                this.DeleteIsSuccess = true;
                                this.DeleteProgress = 100;
                                this.DeletedCount++;
                                this.UploadedDocuments.splice(this.UploadedDocuments.indexOf(file),1);

                        }).catch((error) =>{
                                console.log(error);
                                this.DeleteMessage = 'خطأ لم يتم الحذف';
                                this.DeleteIsSuccess = false;
                            });
            },
            DownloadDocumentLink(path,name){
                path = path.replace('InstitutionsDocuments/','');
                return route('TransactionDocuments.DownloadDocument',[path,name]);
            }
        }
    }
</script>

<style scoped>

</style>
