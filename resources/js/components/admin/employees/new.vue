<template>
<v-form v-model="valid" enctype='multipart/form-data'>
    <v-card>
    <v-card-title>
        {{$t('newEmployee')}}
    </v-card-title>
        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="user.national_id" name="national_id" :rules="numbersRules" autocomplete="national_id" label="رقم الهويه" required></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                        <v-menu v-model="menu2" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                            <template v-slot:activator="{ on, attrs2 }">
                                <v-text-field v-model="user.national_id_date" name="national_id_date" label="تاريخ الهويه" prepend-icon="mdi-calendar" readonly v-bind="attrs2" v-on="on"></v-text-field>
                            </template>
                            <v-date-picker v-model="user.national_id_date" @input="menu2 = false"></v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                        <v-text-field v-model="user.phone" name="phone" :rules="numbersRules" autocomplete="phone" label="الحوال"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-autocomplete v-model="user.role" name="role" :items="items" label="الوظيفه" />
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field v-model="user.name" name="name" :rules="required" autocomplete="name" label="الاسم" required></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-menu v-model="menu" :close-on-content-click="false" :nudge-right="40" transition="scale-transition" offset-y min-width="auto">
                            <template v-slot:activator="{ on, attrs }">
                                <v-text-field v-model="user.birth_date" name="birth_date" label="تاريخ الميلاد" prepend-icon="mdi-calendar" readonly v-bind="attrs" v-on="on"></v-text-field>
                            </template>
                            <v-date-picker v-model="user.birth_date" @input="menu = false"></v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field v-model="user.email" name="email" :rules="emailRules" autocomplete="email" label="الايميل"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field v-model="user.password" name="password" type="password" :rules="required" autocomplete="password" label="كلمة المرور"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field v-model="user.password_confirmation" name="password_confirmation" type="password" :rules="required" autocomplete="password_confirmation" label="تأكيد كلمة المرور"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-text-field v-model="user.code" name="code" :rules="required" autocomplete="code" label="الرمز"></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6">
                    </v-col>
                    <v-col cols="12" sm="6">
                        <v-file-input ref="signature" name="signature" v-model="user.signature" :rules="required" accept=".APNG,.AVIF,.GIF,.JPEG,.PNG,.SVG" />
                    </v-col>
                    <v-col cols="12" sm="6">
                    </v-col>
                </v-row>
            </v-container>
            <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="close()">
                Close
            </v-btn>
            <v-btn color="blue darken-1" text @click="submit()">
                Save
            </v-btn>
        </v-card-actions>
    </v-card>
</v-form>
</template>

<script>
export default {
    data() {
        return {
            valid: false,
            file: null,
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
            menu: false,
            menu2: false,
            date: null,
            date2: null,
            user: {

            },
            items: [
                'سكرتير',
                'مدقق',
                'مراجع فني',
                'مدير مراجعة',
                'سكرتير تنفيذي',
                'شريك اداري',
                'مدير أداري',
            ],
        }
    },
    methods: {
        close() {
            this.$emit('close')
        },
        submit() {

            axios.post(route('employees.store'), this.user).then(res => {
                console.log('res', res)
            })
        }
    },
}
</script>
