<template>
    <div id="DocumentsUploadSection">
        <div class="box" style="margin-top: 20px">

            <div v-if="LoadingSpinner" class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="box-header">
                <h2>تحميل ملفات الشركة</h2>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <manage-document-form v-for="document in RequiredDocuments" :document="document" :key="document.id"></manage-document-form>
                <hr>
                <div v-if="" class="row">
                    <div class="col-md-12 ">
                        <button @click="NextStage()"  class="btn btn-block btn-success btn-lg" style="padding: 15px;width:230px" >  التالى</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DocumentsManagementSection.vue",

        data () {
            return{
                LoadingSpinner:false,
                Transaction : this.$parent.Transaction,
                RequiredDocuments : [],
            }
        },
        created() {
            this.FetchDocuments(route('documents.index',this.Transaction.id))
        },
        methods : {
            FetchDocuments(endpoint){
                this.LoadingSpinner = true;
                axios.get(endpoint)
                    .then(({data}) => {
                        this.RequiredDocuments.push(...data.RequiredDocuments);
                    }).catch((error)=>{
                    console.log(error);
                    this.$toast.error('خطأ','يرجى اعادة المحاولة',{timout:2000});
                    });
                this.LoadingSpinner = false;
            },
            NextStage(){
                this.$toast.success('.',
                    'قد تم رفع الملفات بنجاح '
                    ,{timout:2000});
                this.$parent.SectionStage++;
            }
        }
    }
</script>

<style scoped>

</style>
