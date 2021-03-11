<template>
    <div class="container box" style="margin-top: 20px">
        <div class="row">
            <div class="box-header">
                <h2>توقيع  <b >{{AuthUser.role}}</b></h2>
            </div>
            <div class="box-body">
                <form class="form-group justify-content-between" enctype="multipart/form-data" @submit.prevent="UpdateSignature()">
                    <div class="col-md-4">
                            <input ref="signature" class="form-control" type="file" accept=".APNG,.AVIF,.GIF,.JPEG,.PNG,.SVG" required>
                    </div>
                    <div class="col-md-3">
                        <button v-if="AuthUser.signature" class="btn btn-success ">تعديل</button>
                        <button v-else class="btn btn-success ">حفظ</button>
                    </div>
                    <div class="col-md-3">
                        <img :src="AuthUser.signatureImage" class="img-responsive">
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PartnerSignature",
        props:{
            'AuthUser' : '',
        },
        methods : {
            UpdateSignature(){
              let formData = new FormData();
              formData.append('_method',"PATCH");
              formData.append('signature',this.$refs.signature.files[0]);
              axios.post(route('employees.update.signature', [this.AuthUser.id]), formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                }).then(({data}) => {
                    console.log(data);
                    }).catch((error) => {

                })
            },
        }
    }
</script>

<style scoped>

</style>
