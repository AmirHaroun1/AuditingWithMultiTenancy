<template>
<div>
    <v-form v-model="valid" @submit.prevent="UpdateAgent()">
        <v-card>
            <v-card-title>
                {{$t('officeInfoData')}}
            </v-card-title>
            <v-card-subtitle>
                {{$t('agentInfo')}}
            </v-card-subtitle>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="Agent.national_id" outlined :rules="numbersRules" autocomplete="idNumber" :label="$t('idNumber')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="Agent.national_id_date" :label="$t('idDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="Agent.national_id_date"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="Agent.name" outlined :rules="required" autocomplete="full name" :label="$t('fullName')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-menu :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                                <template v-slot:activator="{ on, attrs2 }">
                                    <v-text-field outlined v-model="Agent.birth_date" :label="$t('birthDate')" append-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="Agent.birth_date"></v-date-picker>
                            </v-menu>
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="Agent.email" outlined :rules="emailRules" autocomplete="email" :label="$t('email')" required />
                        </v-col>
                        <v-col cols="12" sm="6" md="6">
                            <v-text-field v-model="Agent.phone" outlined :rules="numberRules" autocomplete="phone" :label="$t('phone')" required />
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn type="submit" color="primary" dark>
                    {{$t('save')}}
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-form>
    <div v-if="LoadingSpinner" class="overlay">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
</div>
</template>

<script>
export default {
    name: "EditAgentForm",

    data() {
        return {
            LoadingSpinner: false,
            valid: false,
            Agent: this.$parent.Agent,
            ValidationErrors: '',
            numbersRules: [
                v => !!v || this.$t('requiredField'),
                v => /^\d+$/.test(v) || this.$t('numbersOnly'),
            ],
            emailRules: [
                v => !!v || this.$t('requiredField'),
                v => /.+@.+/.test(v) || this.$t('emailNotValid'),
            ],
            required: [
                v => !!v || this.$t('requiredField'),
            ],
        }
    },
    methods: {
        UpdateAgent() {
            this.LoadingSpinner = true;
            var formData = new FormData();

            formData.append('_method', 'PATCH');
            formData.append('national_id', this.Agent.national_id);
            formData.append('national_id_date', this.Agent.national_id_date);
            formData.append('name', this.Agent.name);
            formData.append('birth_date', this.Agent.birth_date);
            formData.append('email', this.Agent.email);
            formData.append('phone', this.Agent.phone);
            formData.append('role', 'مندوب شركة');

            axios.post(route('agent.update', this.Agent.id),
                formData
            ).then((res) => {
                this.LoadingSpinner = false;

                this.$toast.success('<i class="fas fa-thumbs-up"></i>',
                    'قد تم تسجيل بيانات ضابط الأتصال بنجاح ', {
                        timout: 2000
                    });
                this.ValidationErrors = '';
                this.$parent.SectionStage = 3;
                this.$parent.Agent = this.Agent;
            }).catch((error) => {
                this.LoadingSpinner = false;
                this.ValidationErrors = error.response.data.errors;
                this.$toast.error('خطأ', 'يرجى اعادة مراجعة البيانات', {
                    timout: 2000
                });
            });
        }
    },
}
</script>

<style scoped>

</style>
