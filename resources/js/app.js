/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';

import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';

import Vue from 'vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import { VueEditor } from "vue2-editor";
import Vuetify from 'vuetify';
   Vue.use(Vuetify); 

   const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
   
});
import VueHtmlToPaper from 'vue-html-to-paper'

/* This will change according to your server */
let basePath= 'http://localhost:8080';

import VueExcelEditor from 'vue-excel-editor'
Vue.use(VueExcelEditor)


Vue.use(VueHtmlToPaper);


Vue.use(VueIziToast);

Vue.component('v-select', vSelect)
Vue.component('vue-editor', VueEditor)


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);
Vue.component('transaction-files', require('./components/TransactionFiles.vue').default);
Vue.component('transaction-accounts', require('./components/TransactionAccounts.vue').default);
Vue.component('transaction-financial-statements', require('./components/TransactionFinancialStatements.vue').default);
Vue.component('transaction-clearance-of-clearances', require('./components/TransactionClearanceOfClearances.vue').default);
Vue.component('transaction-clearances', require('./components/TransactionClearances.vue').default);
Vue.component('upload-excel-accounts', require('./components/UploadExcelAccounts.vue').default);
Vue.component('transaction-info', require('./components/TransactionInfo.vue').default);
Vue.component('employee-signature', require('./components/EmployeeSignature').default);

/**
 * Secretary Components
 */

Vue.component('new-transaction', require('./components/Secretary/NewTransaction/NewTransaction.vue').default);
Vue.component('new-agent-form', require('./components/Secretary/NewTransaction/NewAgentForm.vue').default);
Vue.component('new-company-form', require('./components/Secretary/NewTransaction/NewCompanyForm.vue').default);
Vue.component('new-TradeRegister-form', require('./components/Secretary/NewTransaction/NewTradeRegisterForm.vue').default);
Vue.component('documents-management-section', require('./components/Secretary/DocumentsManagementSection.vue').default);
Vue.component('manage-document-form', require('./components/Secretary/ManageDocumentForm.vue').default);
Vue.component('payment-details-form', require('./components/Secretary/NewTransaction/PaymentDetailsForm.vue').default);
Vue.component('existing-company-form', require('./components/Secretary/NewTransaction/ExistingCompanyForm.vue').default);
Vue.component('edit-agent-form', require('./components/Secretary/EditAgentForm.vue').default);
Vue.component('secretary-transactions-table', require('./components/Secretary/SecretaryTransactionsTable.vue').default);
Vue.component('clearance-table', require('./components/ClearanceTable.vue').default);
Vue.component('clearance-of-clearances-table', require('./components/ClearanceOfClearancesTable.vue').default);
Vue.component('account-statements-sample', require('./components/TransactionAccountStatementsSample.vue').default);

Vue.component('secretary-edit-transaction-section', require('./components/Secretary/EditTransaction/EditTransactionSection.vue').default);
Vue.component('edit-transaction-data', require('./components/Secretary/EditTransaction/EditTransactionData.vue').default);

/**
 * Reviser Components
 */
Vue.component('reviser-transactions-table', require('./components/Reviser/ReviserTransactionTable.vue').default);
Vue.component('reviser-edit-transaction', require('./components/Reviser/ReviserEditTransaction.vue').default);

/**
 * auditor Components
 */
Vue.component('auditor-transactions-table', require('./components/auditor/AuditorTransactionsTable.vue').default);
Vue.component('auditor-edit-transaction', require('./components/auditor/AuditorEditTransaction.vue').default);

/**
 * RevisingManager Components
 */
Vue.component('revising-manager-transactions-table', require('./components/RevisingManager/RevisingManagerTransactionTable').default);
Vue.component('revising-manager-edit-transaction', require('./components/RevisingManager/RevisingManagerEditTransaction.vue').default);


/**
 * Managing partner Components
 */
Vue.component('partner-transactions-table', require('./components/Partner/PartnerTransactionsTable').default);
Vue.component('partner-edit-transaction', require('./components/Partner/PartnerEditTransaction').default);

/**
 * Admin Components
 */

Vue.component('drop-downs-management', require('./components/DropDownsManagement.vue').default);
Vue.component('account-charts-management', require('./components/admin/AccountChartsManagement').default);
Vue.component('revising-guid-management', require('./components/admin/RevisingGuidManagement').default);

Vue.component('financial-groups-management', require('./components/admin/FinancialGroupsManagement').default);

Vue.component('office-info', require('./components/admin/OfficeInfo').default)
Vue.component('dash-board', require('./components/admin/DashBoard').default)

/**
 * Archive Components
 */
Vue.component('archive-transactions-table', require('./components/ArchiveSecretary/ArchiveTransactionsTable').default);
Vue.component('archive-edit-transaction', require('./components/ArchiveSecretary/ArchiveEditTransaction').default);

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy),
    },
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
