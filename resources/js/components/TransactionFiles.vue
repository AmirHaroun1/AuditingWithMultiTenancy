<template>
    <v-card style="padding: 25px">
        <!-- <div v-if="LoadingSpinner" class="overlay">
        </div> -->
        <v-card-title class="mb-3">
            <span class="mr-3 ml-3"> الملفات الخاصة بالمراجعة </span>
        </v-card-title>
        <v-card-text>
            <v-data-table
                :loading="LoadingSpinner"
                loading-text="Loading... Please wait"
                :headers="headers"
                :items="documents"
            >
                <template v-slot:item.transactions="{ item }">
                    <a
                        v-for="DocumentInfo in item.transactions"
                        :key="DocumentInfo.pivot.DocumentPath"
                        :href="
                            DownloadDocumentLink(
                                DocumentInfo.pivot.DocumentPath,
                                DocumentInfo.pivot.original_name
                            )
                        "
                        target="_blank"
                        ><br />{{ DocumentInfo.pivot.original_name }}</a
                    >
                    <h4 v-if="!item.transactions.length" class="text-danger">
                        <i class="fa fa-warning"></i> لا يوجد
                    </h4>
                </template>
                <template v-slot:item.id="{ item }">
                    <div class="col-md-9">
                        <textarea
                            style="height:50px;width:100%"
                            v-if="item.transactions.length"
                            class="form-control"
                            v-model="item.transactions[0].pivot.comment"
                        ></textarea>
                    </div>
                    <div class="col-md-3">
                        <button
                            class="btn btn-success"
                            v-if="item.transactions.length"
                            @click="
                                UpdateTransactionDocument(
                                    item.transactions[0].pivot.comment,
                                    item.id
                                )
                            "
                        >
                            حفظ
                        </button>
                    </div>
                </template>
            </v-data-table>

            <!-- <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>كود الملف</th>
                        <th>أسم الملف</th>
                        <th>رابط الملف</th>
                        <th class="text-center">التعليق</th>
                    </tr>
                    <tr v-for="(document, index) in documents" :key="index">
                        <td>{{ document.code }}</td>
                        <td>{{ document.name }}</td>
                        <td>
                            <a
                                v-for="DocumentInfo in document.transactions"
                                :key="DocumentInfo"
                                :href="
                                    DownloadDocumentLink(
                                        DocumentInfo.pivot.DocumentPath,
                                        DocumentInfo.pivot.original_name
                                    )
                                "
                                target="_blank"
                                ><br />{{ DocumentInfo.pivot.original_name }}</a
                            >
                            <h4
                                v-if="!document.transactions.length"
                                class="text-danger"
                            >
                                <i class="fa fa-warning"></i> لا يوجد
                            </h4>
                        </td>
                        <td>
                            <div class="col-md-9">
                                <textarea
                                    style="height:50px;width:100%"
                                    v-if="document.transactions.length"
                                    class="form-control"
                                    v-model="
                                        document.transactions[0].pivot.comment
                                    "
                                ></textarea>
                            </div>
                            <div class="col-md-3">
                                <button
                                    class="btn btn-success"
                                    v-if="document.transactions.length"
                                    @click="
                                        UpdateTransactionDocument(
                                            document.transactions[0].pivot
                                                .comment,
                                            document.id
                                        )
                                    "
                                >
                                    حفظ
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> -->
        </v-card-text>
        <div class="row">
            <div class="box-body"></div>
        </div>
    </v-card>
</template>

<script>
export default {
    name: "TransactionFiles",
    props: {
        Transaction: ""
    },
    data() {
        return {
            LoadingSpinner: "",
            documents: [],
            headers: [
                {
                    text: this.$t("fileCode"),
                    align: "start",
                    value: "code"
                },
                {
                    text: this.$t("fileName"),
                    value: "name"
                },
                {
                    text: this.$t("fileLink"),
                    value: "transactions"
                },
                {
                    text: this.$t("comment"),
                    value: "id"
                }
            ]
        };
    },
    created() {
        this.FetchDocuments(route("documents.index", this.Transaction.id));
    },
    methods: {
        FetchDocuments(endpoint) {
            this.LoadingSpinner = true;
            axios
                .get(endpoint)
                .then(({ data }) => {
                    this.LoadingSpinner = false;
                    this.documents.push(...data.RequiredDocuments);
                })
                .catch(error => {
                    this.$toast.error(".", "حدث خطأ, يرجى اعادة المحاولة");
                });
        },
        UpdateTransactionDocument(documentComment, documentID) {
            let formData = new FormData();
            formData.append("_method", "PATCH");
            formData.append("comment", documentComment);
            formData.append("TransactionId", this.Transaction.id);
            formData.append("DocumentId", documentID);
            axios
                .post(route("TransactionDocument.Update"), formData)
                .then(res => {
                    this.$toast.success(".", "تمت أضافة التعليق بنجاح", {
                        timeout: 3000
                    });
                })
                .catch(error => {
                    console.log(error);
                    this.$toast.error(".", "خطأ يرجى اعادة المحاولة", {
                        timeout: 3000
                    });
                });
        },
        DownloadDocumentLink(path, name) {
            path = path.replace("InstitutionsDocuments/", "");
            return route("TransactionDocuments.DownloadDocument", [path, name]);
        }
    }
};
</script>

<style scoped></style>
