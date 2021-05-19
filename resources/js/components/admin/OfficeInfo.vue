<template>
<div>
    <v-card>
        <v-container>
            <v-card-title>
                {{$t('officeInfo')}}
            </v-card-title>
            <v-form @submit.prevent="submitForm">
                <v-row>
                    <v-col cols="6">
                        <v-text-field v-model="officeData.name" outlined :label="$t('name')"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="officeData.name_english " outlined :label="$t('englishName')"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-file-input prepend-icon="" hide-details="" append-icon="mdi-camera" v-model="officeData.logo" outlined :label="$t('logo')"></v-file-input>
                    </v-col>
                    <v-col cols="6">

                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="officeData.bank_name" outlined :label="$t('bankName')"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="officeData.bank_name_english" outlined :label="$t('englishBankName')"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-text-field v-model="officeData.bank_account_number" outlined :label="$t('bankAccountNumber')"></v-text-field>
                    </v-col>
                </v-row>
                                <v-card>
                <v-alert type="primary" outlined>
                    <office-branches></office-branches>
                </v-alert>
                                </v-card>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="primary" dark>
                        {{$t('save')}}
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-form>
        </v-container>
    </v-card>
</div>
</template>

<script>
export default {
    name: "office-info",
    props: {
        'officeInfo': {},
    },
    data() {
        return {
            officeData: (this.officeInfo == null) ? {}: this.officeInfo,
        }
    },
    methods: {
        submitForm() {
            let formData = new FormData();
            for (const key in this.officeData) {
                if (Object.hasOwnProperty.call(this.officeData, key)) {
                    const element = this.officeData[key];
                    formData.append(key, element)
                }
            }
            if (!this.officeInfo.name) {
                axios.patch(route('system.officeInfo.store'), formData).then(res => {
                    console.log('res', res);
                }).catch(err => {
                    console.log('err', err);
                })
            } else {
                axios.post(route('system.officeInfo.store'), formData).then(res => {
                    console.log('res', res);
                }).catch(err => {
                    console.log('err', err);
                })
            }
        }
    },
}
</script>

<style scoped>

</style>
