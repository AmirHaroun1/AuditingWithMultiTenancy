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
    <div class="box" style="margin-top: 20px">
        <div class="box-header">
            <h2 class="pb-3"> بيانات ضابط الأتصال</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form @submit.prevent="UpdateAgent()" class="form-group">
                <div class="row">
                    <div id="NewAgentForTheCompany">
                        <div class="col-md-12">
                            <h3 class="header" style="padding-bottom: 10px"> ضابط الأتصال :</h3>
                        </div>
                        <div class="col-lg-6" style="padding-bottom: 20px">
                            <label class="float-right">رقم الهوية</label>
                            <input v-model="Agent.national_id" type="number" class="form-control pb-4"  style="padding-bottom: 20px"  placeholder="رقم الهوية">

                            <div v-if="ValidationErrors.national_id"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.national_id[0] }}
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-6" style="padding-bottom: 20px">
                            <div class="form-group ">
                                <label class="float-right pt-4">تاريخ الهوية</label>
                                <input v-model="Agent.national_id_date" type="date" class="form-control pb-5"  required>
                            </div>

                            <div v-if="ValidationErrors.national_id_date"   style="margin-top:10px">
                                <h4 class="  font-weight-bold" style="color:red">
                                    {{ ValidationErrors.national_id_date[0] }}
                                </h4>
                            </div>
                        </div>

                        <div class="col-lg-6" style="padding-bottom: 20px">
                            <div class="form-group ">
                                <label>الأسم بالكامل</label>
                                <input v-model="Agent.name" type="text" class="form-control"  placeholder="الأسم بالكامل" required>

                                <div v-if="ValidationErrors.name"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.name[0] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" style="padding-bottom: 20px">
                            <div class="form-group ">
                                <label>تاريخ الميلاد</label>
                                <input v-model="Agent.birth_date" type="date" class="form-control" required>

                                <div v-if="ValidationErrors.birth_date"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.birth_date[0] }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6" style="padding-bottom: 20px">
                            <div class="form-group ">
                                <label>الإيميل</label>
                                <input v-model="Agent.email" type="email" class="form-control pb-5" autocomplete="email" required>

                                <div v-if="ValidationErrors.email"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.email[0] }}
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6"style="padding-bottom: 20px">
                            <div class="form-group ">
                                <label>رقم الجوال</label>
                                <input v-model="Agent.phone" type="text" class="form-control pb-5" placeholder="رقم الجوال" required>

                                <div v-if="ValidationErrors.phone"   style="margin-top:10px">
                                    <h4 class="  font-weight-bold" style="color:red">
                                        {{ ValidationErrors.phone[0] }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row text-center ">
                    <div class="col-md-12 ">
                        <button class="btn btn-block btn-success btn-lg" style="padding: 15px;width:230px" >حفظ</button>
                    </div>
                </div>
            </form>
        </div>

        <div v-if="LoadingSpinner" class="overlay">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
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
