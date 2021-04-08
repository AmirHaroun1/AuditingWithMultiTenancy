<template>
<div id="DocumentsUploadSection">
    <v-data-table dense :headers="headers" :items="RequiredDocuments" :expanded.sync="expanded" show-expand>
        <template style="box-shadow:none;" v-slot:expanded-item="{ headers, item }">
            <td style="box-shadow:none;" :colspan="headers.length">
                <v-simple-table dense>
                    <tbody>
                        <tr v-for="(file) in item.transactions" :key="file.pivot.DocumentPath">
                            <td>{{file.pivot.original_name}}</td>
                            <td>
                                <a :href="DownloadDocumentLink(file.pivot.DocumentPath,file.pivot.original_name)">
                                    <v-icon small class="mr-2">
                                        mdi-download
                                    </v-icon>
                                </a>
                                <v-icon @click="DeleteDocuments(file.pivot)" small>
                                    mdi-delete
                                </v-icon>
                            </td>
                        </tr>
                    </tbody>
                </v-simple-table>

                <!-- <v-list subheader two-line>
                    <v-list-item v-for="file in item.transactions" :key="file.pivot.DocumentPath">

                        <v-list-item-content>
                            <v-list-item-subtitle v-text="file.pivot.original_name"></v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <a :href="DownloadDocumentLink(file.pivot.DocumentPath,file.pivot.original_name)">
                                <v-icon small class="mr-2">
                                    mdi-download
                                </v-icon>
                            </a>
                            <v-icon @click="DeleteDocuments(file.pivot)" small>
                                mdi-delete
                            </v-icon>
                        </v-list-item-action>
                    </v-list-item>
                </v-list> -->
            </td>
        </template>
        <template v-slot:item.action="{ item }">
            <v-icon @click="DeleteDocuments(file.pivot)" small>
                mdi-upload
            </v-icon>
        </template>
    </v-data-table>
    <div>

        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="box-header">
            <h2>تحميل ملفات الشركة</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <manage-document-form v-for="document in RequiredDocuments" :document="document" :key="document.id"></manage-document-form>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: "DocumentsManagementSection.vue",

    data() {
        return {
            LoadingSpinner: false,
            Transaction: this.$parent.Transaction,
            RequiredDocuments: [],
            expanded: [],
            headers: [{
                    text: this.$t('document'),
                    align: 'start',
                    value: 'name',
                },
                {
                    text: this.$t('action'),
                    value: 'action',
                },
            ],
        }
    },
    created() {
        this.FetchDocuments(route('documents.index', this.Transaction.id))
    },
    methods: {
        FetchDocuments(endpoint) {
            this.LoadingSpinner = true;
            axios.get(endpoint)
                .then(({
                    data
                }) => {
                    this.RequiredDocuments.push(...data.RequiredDocuments);
                }).catch((error) => {
                    console.log(error);
                    this.$toast.error('خطأ', 'يرجى اعادة المحاولة', {
                        timout: 2000
                    });
                });
            this.LoadingSpinner = false;
        },
        NextStage() {
            this.$toast.success('.',
                'قد تم رفع الملفات بنجاح ', {
                    timout: 2000
                });
            this.$parent.SectionStage++;
        },

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
                        .then(({
                            data
                        }) => {
                            this.UploadMessage = 'تم الرفع بنجاح';
                            this.UploadIsSuccess = true;
                            console.log(data);
                            this.UploadedDocuments.push({
                                'id': data.FileID,
                                'original_name': data.FileName,
                                'DocumentPath': data.FilePath
                            });
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
                .then((res) => {
                    this.DeleteMessage = 'تم الحذف بنجاح';
                    this.DeleteIsSuccess = true;
                    this.DeleteProgress = 100;
                    this.DeletedCount++;
                    this.UploadedDocuments.splice(this.UploadedDocuments.indexOf(file), 1);

                }).catch((error) => {
                    console.log(error);
                    this.DeleteMessage = 'خطأ لم يتم الحذف';
                    this.DeleteIsSuccess = false;
                });
        },
        DownloadDocumentLink(path, name) {
            path = path.replace('InstitutionsDocuments/', '');
            return route('TransactionDocuments.DownloadDocument', [path, name]);
        }
    }
}
</script>

<style>
.v-data-table>.v-data-table__wrapper tbody tr.v-data-table__expanded__content {
    box-shadow: none !important;
}
</style>
