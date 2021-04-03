<template>
<v-navigation-drawer right permenant app dark class="primary">
    <h3 class="white--text text-center">
        {{authObject.role}}
    </h3>
        <!-- <v-img class="mainLogo my-2" src="https://toppng.com/uploads/preview/deezer-logo-white-png-spotify-icon-png-white-115628504321wsqwqfkog.png" height="75px"></v-img> -->
    <v-divider></v-divider>
    <v-list>
        <v-list-item v-for="item in items" :href="route(item.path)"  :key="item.title">
            <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title style="margin: 5px !important;">{{ item.title }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
    <template v-slot:append>
        <v-list dense>
            <v-divider></v-divider>
            <v-list-item @click="logout"> 
                <v-list-item-icon class="pl-0 ml-0 mr-3">
                    <v-icon>mdi-logout</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>تسجيل الخروج</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </template>
</v-navigation-drawer>
</template>

<script>
export default {
    data() {
        return {
            mini: true,
            expandOnHover: true,
            bottomItems: [{
                    title: 'اختيار اللغه',
                    icon: 'fas fa-globe',
                },
                {
                    title: 'تسجيل الخروج',
                    icon: 'mdi-logout',
                    path: '/logout',
                }
            ]
        };
    },
    props: {
        'auth': ''
    },
    methods: {
        logout () {
            axios.post(route('logout')).then(res => {
            location.reload();
            })
        }
    },
    computed: {
        authObject () {
            return JSON.parse(this.auth) 
        },
        items () {
            const adminItems =  [{
                    title: 'الرئيسية',
                    icon: 'fa fa-dashboard',
                    path: "dashboard"
                },
                {
                    title: 'الموظفين',
                    icon: 'fa fa-user',
                    path: "employees.index"
                },
                {
                    title: 'بيانات المكتب',
                    icon: 'fa fa-breifcase',
                    path: "system.officeInfo"
                },
                {
                    title: 'القوائم المنسدلة',
                    icon: 'fa fa-gears',
                    path: "system.DropDowns.index"
                },
                {
                    title: 'الدليل المحاسبي',
                    icon: 'fa fa-balance-scale',
                    path: "system.AccountCharts.index"
                },
                {
                    title: 'دليل المراجعة',
                    icon: 'fa fa-book',
                    path: "revisingGuid.manage.admin"
                },
                {
                    title: 'مجموعات القوائم المالية',
                    icon: 'fa fa-info',
                    path: "FinancialGroups.manage.admin"
                },
            ]
            const secItems = [
                {
                    title: 'المعاملات',
                    icon: 'fa fa-open',
                    path: "Transactions.index.Secretary"
                }
            ]
            const reviserItems = [
                {
                    title: 'المعاملات',
                    icon: 'fa fa-open',
                    path: "Transactions.index.reviser"
                }
            ]
            const auditorItems = [
                {
                    title: 'المعاملات',
                    icon: 'fa fa-open',
                    path: "Transactions.index.reviser"
                }
            ]
            const reviseManagerItems = [
                {
                    title: 'المعاملات',
                    icon: 'fa fa-open',
                    path: "Transactions.index.RevisingManager"
                }
            ]
            const partnerItems = [
                {
                    title: 'المعاملات',
                    icon: 'fa fa-open',
                    path: "Transactions.index.partner"
                }
            ]
            const archiveItems = [
                {
                    title: 'المعاملات',
                    icon: 'fa fa-open',
                    path: "Transactions.index.archive"
                }
            ]
            if (this.authObject.role == 'سوبر'){
                return adminItems
            }
            else if (this.authObject.role == 'سكرتير') {
                return secItems
            }
            else if (this.authObject.role == 'مراجع فني') {
                return reviserItems
            }
            else if (this.authObject.role == 'مدقق') {
                return auditorItems
            }
            else if (this.authObject.role == 'مدير مراجعة') {
                return reviseManagerItems
            }
            else if (this.authObject.role == 'شريك اداري') {
                return partnerItems
            }
            else if (this.authObject.role == 'سكرتير تنفيذي') {
                return archiveItems
            }
        }
    }
};
</script>

<style scoped>
.mainLogo {
    max-height: 150px;
    max-width: 150px;
    margin: 0 auto;
    display: block;
}

.pinIcon {
    right: 5px;
    top: 5px;
    position: absolute;
    z-index: 2;
}
</style>
