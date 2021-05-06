<template>
    <v-container class="mt-20">
        <v-card class="rounded-lg pa-5">
            <v-row class="v-row">
                <v-card-title class="box-header">
                    العينة
                </v-card-title>
                <div v-if="LoadingSpinner" class="overlay">
                    <i class="fa fa-refresh fa-spin"> </i>
                </div>
                <v-card-text class="box-body" id="printHeading">
                    <div
                        v-for="(AccountStatement,
                        AccountStatementIndex) in AccountsStatements"
                        :key="AccountStatementIndex"
                    >
                        <v-card
                            class="indigo darken-1  grey--text text--lighten-5 col-md-12  mt-20 mb-20 cursor-pointer  content-between"
                            style=""
                            data-toggle="collapse"
                            :data-target="
                                '#' + 'collapse' + AccountStatement.id
                            "
                            aria-expanded="true"
                            :aria-controls="AccountStatement.id"
                        >
                            <v-card-title
                                style="width:100%"
                                class="cursor-pointer d-flex justify-center"
                            >
                                <div>
                                    {{ AccountStatement.name }}
                                </div>
                            </v-card-title>
                        </v-card>
                        <div
                            :id="'collapse' + AccountStatement.id"
                            class="collapse fade"
                            @click="
                                AccountsStatements.fourth_level_account_id !==
                                null
                                    ? GetInKindOfAccountStatement(
                                          AccountStatement
                                      )
                                    : ''
                            "
                        >
                            <!--------------- if the statement belongs to fourth level account--------->
                            <div
                                @change="
                                    GetInKindOfAccountStatement(
                                        AccountStatement
                                    )
                                "
                                v-if="
                                    AccountStatement.fourth_level_account_id !==
                                        null
                                "
                            >
                                <table
                                    class="mt-20 v-simple-table table-bordered"
                                >
                                    <thead>
                                        <tr>
                                            <th rowspan="2" colspan="1">
                                                الأسم
                                            </th>
                                            <th rowspan="2" colspan="1">
                                                رصيد
                                                {{
                                                    Transaction.end_financial_year
                                                }}
                                            </th>
                                            <th rowspan="2" colspan="1">
                                                رصيد
                                                {{
                                                    Transaction.FirstPastYearDate
                                                }}
                                            </th>
                                            <th
                                                class="text-center"
                                                rowspan="1"
                                                colspan="2"
                                            >
                                                عينة تفصيلية
                                                <br />
                                                من كشف حساب
                                                <br />
                                                {{ AccountStatement.name }}
                                            </th>

                                            <th
                                                class="text-center"
                                                rowspan="1"
                                                colspan="2"
                                            >
                                                عينة تجميعية
                                                <br />
                                                من كشف حساب
                                                <br />
                                                بنود اخري
                                            </th>
                                            <th
                                                class="text-center"
                                                rowspan="1"
                                                colspan="4"
                                            >
                                                نوع المستند
                                            </th>
                                            <th rowspan="2" colspan="1">
                                                الكود المقابل
                                            </th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">
                                                مدين
                                            </th>
                                            <th class="text-center">
                                                دائن
                                            </th>

                                            <th class="text-center">
                                                مدين
                                            </th>
                                            <th class="text-center">
                                                دائن
                                            </th>

                                            <th class="text-center">
                                                رقم المستند
                                            </th>
                                            <th class="text-center">
                                                تاريخ المستند
                                            </th>
                                            <th class="text-center">
                                                قبض
                                                <br />
                                                اشعار إضافة
                                            </th>
                                            <th class="text-center">
                                                صرف
                                                <br />
                                                اشعار خصم
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ AccountStatement.name }}
                                            </td>
                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountStatement.current_year
                                                        )
                                                    "
                                                ></p>
                                            </td>
                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountStatement.first_past_year
                                                        )
                                                    "
                                                ></p>
                                            </td>

                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountStatement.detailed_debit
                                                        )
                                                    "
                                                ></p>
                                            </td>
                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountStatement.detailed_credit
                                                        )
                                                    "
                                                ></p>
                                            </td>

                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountStatement.aggregated_debit
                                                        )
                                                    "
                                                ></p>
                                            </td>
                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountStatement.aggregated_credit
                                                        )
                                                    "
                                                ></p>
                                            </td>

                                            <td>-</td>
                                            <td>-</td>

                                            <td>
                                                <p
                                                    v-if="
                                                        AccountStatement.aggregated_debit !=
                                                            0
                                                    "
                                                >
                                                    debit
                                                </p>
                                            </td>
                                            <td>
                                                <p
                                                    v-if="
                                                        AccountStatement.aggregated_credit !=
                                                            0
                                                    "
                                                >
                                                    credit
                                                </p>
                                            </td>
                                            <td>-</td>
                                        </tr>
                                        <tr
                                            v-for="(AccountInKind,
                                            index) in AccountStatement.accounts_in_kind"
                                            :key="index"
                                        >
                                            <td colspan="3">
                                                <a
                                                    class="cursor-pointer"
                                                    @click="
                                                        OpenEditInKindModal(
                                                            AccountStatement,
                                                            AccountInKind,
                                                            index
                                                        )
                                                    "
                                                    >{{ AccountInKind.name }}</a
                                                >
                                            </td>

                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountInKind.detailed_debit
                                                        )
                                                    "
                                                ></p>
                                            </td>
                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountInKind.detailed_credit
                                                        )
                                                    "
                                                ></p>
                                            </td>

                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountInKind.aggregated_debit
                                                        )
                                                    "
                                                ></p>
                                            </td>
                                            <td>
                                                <p
                                                    v-text="
                                                        formatValue(
                                                            AccountInKind.aggregated_credit
                                                        )
                                                    "
                                                ></p>
                                            </td>

                                            <td>
                                                {{ AccountInKind.serial }}
                                            </td>
                                            <td>
                                                {{ AccountInKind.date }}
                                            </td>

                                            <td>
                                                <p
                                                    v-if="
                                                        AccountInKind.aggregated_debit !=
                                                            0
                                                    "
                                                >
                                                    debit
                                                </p>
                                            </td>
                                            <td>
                                                <p
                                                    v-if="
                                                        AccountInKind.aggregated_credit !=
                                                            0
                                                    "
                                                >
                                                    credit
                                                </p>
                                            </td>

                                            <td>
                                                {{
                                                    AccountInKind.corresponding_statement_code
                                                }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <v-btn
                                    color="primary"
                                    outlined
                                    @click="
                                        OpenAddModalOfInKind(AccountStatement)
                                    "
                                    class="col-md-12 text-center mt-20 cursor-pointer"
                                >
                                    <!-- style="border: 1px #3949ab dashed;" -->
                                    <h4>
                                        أضافة
                                        <i
                                            class="fa fa-plus"
                                            style="margin-right:5px"
                                        ></i>
                                    </h4>
                                </v-btn>
                            </div>
                            <!--------------- ./if the statement belongs to fourth level account--------->
                            <!--------------- else if the account has branched accounts ----------->
                            <div
                                @change="
                                    GetInKindOfBranchedAccountsStatementsOfParentAccount(
                                        AccountStatement
                                    )
                                "
                                v-else
                                class="mt-20"
                            >
                                <div
                                    v-if="
                                        AccountStatement.branched_statements
                                            .length
                                    "
                                    v-for="BranchedStatements in AccountStatement.branched_statements"
                                >
                                    <div class="mt-20">
                                        <table class=" table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" colspan="1">
                                                        الأسم
                                                    </th>
                                                    <th rowspan="2" colspan="1">
                                                        رصيد
                                                        {{
                                                            Transaction.end_financial_year
                                                        }}
                                                    </th>
                                                    <th rowspan="2" colspan="1">
                                                        رصيد
                                                        {{
                                                            Transaction.FirstPastYearDate
                                                        }}
                                                    </th>
                                                    <th
                                                        class="text-center"
                                                        rowspan="1"
                                                        colspan="2"
                                                    >
                                                        عينة تفصيلية
                                                        <br />
                                                        من كشف حساب
                                                        <br />
                                                        {{
                                                            AccountStatement.name
                                                        }}
                                                    </th>
                                                    <th
                                                        class="text-center"
                                                        rowspan="1"
                                                        colspan="2"
                                                    >
                                                        عينة تجميعية
                                                        <br />
                                                        من كشف حساب
                                                        <br />
                                                        بنود اخري
                                                    </th>
                                                    <th
                                                        class="text-center"
                                                        rowspan="1"
                                                        colspan="4"
                                                    >
                                                        نوع المستند
                                                    </th>
                                                    <th rowspan="2" colspan="1">
                                                        الكود المقابل
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">
                                                        مدين
                                                    </th>
                                                    <th class="text-center">
                                                        دائن
                                                    </th>

                                                    <th class="text-center">
                                                        مدين
                                                    </th>
                                                    <th class="text-center">
                                                        دائن
                                                    </th>

                                                    <th class="text-center">
                                                        رقم المستند
                                                    </th>
                                                    <th class="text-center">
                                                        تاريخ المستند
                                                    </th>
                                                    <th class="text-center">
                                                        قبض
                                                        <br />
                                                        اشعار إضافة
                                                    </th>
                                                    <th class="text-center">
                                                        صرف
                                                        <br />
                                                        اشعار خصم
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{
                                                            BranchedStatements.name
                                                        }}
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    BranchedStatements.current_year
                                                                )
                                                            "
                                                        ></p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    BranchedStatements.first_past_year
                                                                )
                                                            "
                                                        ></p>
                                                    </td>

                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    BranchedStatements.detailed_debit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    BranchedStatements.detailed_credit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>

                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    BranchedStatements.aggregated_debit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    BranchedStatements.aggregated_credit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>

                                                    <td>-</td>
                                                    <td>-</td>

                                                    <td>
                                                        <p
                                                            v-if="
                                                                BranchedStatements.aggregated_debit !=
                                                                    0
                                                            "
                                                        >
                                                            debit
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-if="
                                                                BranchedStatements.aggregated_credit !=
                                                                    0
                                                            "
                                                        >
                                                            credit
                                                        </p>
                                                    </td>
                                                    <td>-</td>
                                                </tr>
                                                <tr
                                                    v-for="(AccountInKind,
                                                    index) in BranchedStatements.accounts_in_kind"
                                                >
                                                    <td colspan="3">
                                                        <a
                                                            class="cursor-pointer"
                                                            @click="
                                                                OpenEditInKindModal(
                                                                    BranchedStatements,
                                                                    AccountInKind,
                                                                    index
                                                                )
                                                            "
                                                            >{{
                                                                AccountInKind.name
                                                            }}</a
                                                        >
                                                    </td>

                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    AccountInKind.detailed_debit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    AccountInKind.detailed_credit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>

                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    AccountInKind.aggregated_debit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-text="
                                                                formatValue(
                                                                    AccountInKind.aggregated_credit
                                                                )
                                                            "
                                                        ></p>
                                                    </td>

                                                    <td>
                                                        {{
                                                            AccountInKind.serial
                                                        }}
                                                    </td>
                                                    <td>
                                                        {{ AccountInKind.date }}
                                                    </td>

                                                    <td>
                                                        <p
                                                            v-if="
                                                                AccountInKind.aggregated_debit !=
                                                                    0
                                                            "
                                                        >
                                                            debit
                                                        </p>
                                                    </td>
                                                    <td>
                                                        <p
                                                            v-if="
                                                                AccountInKind.aggregated_credit !=
                                                                    0
                                                            "
                                                        >
                                                            credit
                                                        </p>
                                                    </td>

                                                    <td>
                                                        {{
                                                            AccountInKind.corresponding_statement_code
                                                        }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div
                                            @click="
                                                OpenAddModalOfInKind(
                                                    BranchedStatements
                                                )
                                            "
                                            class="col-md-12 text-center mt-20 cursor-pointer"
                                            style="border: 1px #00a65a dashed;margin-bottom:20px"
                                        >
                                            <h4>
                                                أضافة
                                                <i
                                                    class="fa fa-plus"
                                                    style="margin-right:5px"
                                                ></i>
                                            </h4>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                            <!--------------- ./if the account has branched accounts ----------->
                        </div>
                    </div>
                    <!------------ Add Inkind Hidden Modal  ---------->

                    <v-dialog
                        v-model="AddModalButton"
                        persistent
                        max-width="700px"
                    >
                        <v-card class="py-4">
                            <v-card-title>
                                <span class="headline">
                                    {{ $t("createAccount") }}</span
                                >
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-form
                                        ref="createAccountForm"
                                        @submit.prevent="StoreNewInKind()"
                                    >
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    outlined
                                                    v-model="AddedInKind.name"
                                                    :label="$t('name')"
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'name is required'
                                                    ]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field
                                                    outlined
                                                    :label="$t('detail_debit')"
                                                    v-model="
                                                        AddedInKind.detailed_debit
                                                    "
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'detailed debit is required',
                                                        rules.numeric
                                                    ]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field
                                                    outlined
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'detailed credit is required',
                                                        rules.numeric
                                                    ]"
                                                    :label="$t('detail_credit')"
                                                    v-model="
                                                        AddedInKind.detailed_credit
                                                    "
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    outlined
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'documment number is required',
                                                            rules.numeric
                                                    ]"
                                                    :label="
                                                        $t('documentNumber')
                                                    "
                                                    v-model="AddedInKind.serial"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-menu
                                                    v-model="main_datePicker"
                                                    :close-on-content-click="
                                                        false
                                                    "
                                                    :nudge-right="40"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="auto"
                                                >
                                                    <template
                                                        v-slot:activator="{
                                                            on,
                                                            attrs
                                                        }"
                                                    >
                                                        <v-text-field
                                                            hide-details
                                                            outlined
                                                            append-icon="mdi-calendar"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            :rules="[
                                                                v =>
                                                                    !!v ||
                                                                    'documment date is required'
                                                            ]"
                                                            :label="
                                                                $t(
                                                                    'documentDate'
                                                                )
                                                            "
                                                            v-model="
                                                                AddedInKind.date
                                                            "
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        v-model="
                                                            AddedInKind.date
                                                        "
                                                        @input="
                                                            main_datePicker = false
                                                        "
                                                    ></v-date-picker>
                                                </v-menu>
                                            </v-col>
                                            <v-col cols="12">
                                                <label>الكود المقابل</label>
                                                <v-select
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'code is required'
                                                    ]"
                                                    :options="V_SelectOptions"
                                                    v-model="
                                                        AddedInKind.CorrespCode
                                                    "
                                                    :clearable="false"
                                                    :required="true"
                                                ></v-select>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    depressed
                                    color="primary"
                                    type="submit"
                                    @click.native="StoreNewInKind()"
                                >
                                    {{ $t("create") }}
                                </v-btn>
                                <v-btn
                                    color="blue-grey lighten-3"
                                    outlined
                                    @click.native="resetAddModalButtonform()"
                                >
                                    {{ $t("close") }}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <!------------ /. Add Inkind Hidden Modal  ---------->
                    <!------------ Edit Inkind Hidden Modal  ---------->

                    <v-dialog
                        v-model="EditModalButton"
                        persistent
                        max-width="700px"
                    >
                        <v-card class="py-4">
                            <v-card-title>
                                <span class="headline">
                                    {{ $t("editAccount") }}</span
                                >
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <v-form
                                        ref="editAccountForm"
                                        @submit.prevent="EditInKind()"
                                    >
                                        <v-row>
                                            <v-col cols="12">
                                                <v-text-field
                                                    outlined
                                                    v-model="tempInKind.name"
                                                    :label="$t('name')"
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'name is required'
                                                    ]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field
                                                    outlined
                                                    :label="$t('detail_debit')"
                                                    v-model="
                                                        tempInKind.detailed_debit
                                                    "
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'detailed debit is required',
                                                        rules.numeric
                                                    ]"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="6">
                                                <v-text-field
                                                    outlined
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'detailed credit is required',
                                                        rules.numeric
                                                    ]"
                                                    :label="$t('detail_credit')"
                                                    v-model="
                                                        tempInKind.detailed_credit
                                                    "
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-text-field
                                                    outlined
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'documment number is required',
                                                            rules.numeric
                                                    ]"
                                                    :label="
                                                        $t('documentNumber')
                                                    "
                                                    v-model="tempInKind.serial"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12">
                                                <v-menu
                                                    v-model="main_datePicker"
                                                    :close-on-content-click="
                                                        false
                                                    "
                                                    :nudge-right="40"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="auto"
                                                >
                                                    <template
                                                        v-slot:activator="{
                                                            on,
                                                            attrs
                                                        }"
                                                    >
                                                        <v-text-field
                                                            hide-details
                                                            outlined
                                                            append-icon="mdi-calendar"
                                                            readonly
                                                            v-bind="attrs"
                                                            v-on="on"
                                                            :rules="[
                                                                v =>
                                                                    !!v ||
                                                                    'documment date is required'
                                                            ]"
                                                            :label="
                                                                $t(
                                                                    'documentDate'
                                                                )
                                                            "
                                                            v-model="
                                                                tempInKind.date
                                                            "
                                                        ></v-text-field>
                                                    </template>
                                                    <v-date-picker
                                                        v-model="
                                                            tempInKind.date
                                                        "
                                                        @input="
                                                            main_datePicker = false
                                                        "
                                                    ></v-date-picker>
                                                </v-menu>
                                            </v-col>
                                            <v-col cols="12">
                                                <label>الكود المقابل</label>
                                                <v-select
                                                    :rules="[
                                                        v =>
                                                            !!v ||
                                                            'code is required'
                                                    ]"
                                                    :options="V_SelectOptions"
                                                    v-model="
                                                        tempInKind.VSelectValues
                                                    "
                                                    :clearable="false"
                                                    :required="true"
                                                ></v-select>
                                            </v-col>
                                        </v-row>
                                    </v-form>
                                </v-container>
                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn
                                    depressed
                                    color="primary"
                                    type="submit"
                                    @click.native="EditInKind()"
                                >
                                    {{ $t("edit") }}
                                </v-btn>
                                <v-btn
                                    color="blue-grey lighten-3"
                                    outlined
                                    @click.native="resetEditAccountForm()"
                                >
                                    {{ $t("close") }}
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>

                    <!------------ /. Edit Inkind Hidden Modal  ---------->

                    <div class="pagination text-center">
                        <button
                            class="btn btn-default"
                            @click="GetAccountsThatHasInKind(current_page - 1)"
                            :disabled="prev_page_url == null"
                        >
                            السابق
                        </button>
                        <span
                            >صفحة
                            {{ current_page }}
                            من
                            {{ last_page }}
                        </span>
                        <button
                            class="btn btn-default"
                            @click="GetAccountsThatHasInKind(current_page + 1)"
                            :disabled="next_page_url == null"
                        >
                            التالي
                        </button>
                    </div>
                </v-card-text>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "TransactionAccountStatementsSample",
    props: {
        Transaction: ""
    },
    data() {
        return {
            LoadingSpinner: "",
            AccountsStatements: [],
            current_page: 1,
            last_page: "",
            next_page_url: "",
            prev_page_url: "",
            ArabicMonths: [
                { Number: 1, Name: "يناير" },
                { Number: 2, Name: "فبراير" },
                { Number: 3, Name: "مارس" },
                { Number: 4, Name: "أبريل" },
                { Number: 5, Name: "مايو" },
                { Number: 6, Name: "يونيو" },
                { Number: 7, Name: "يوليو" },
                { Number: 8, Name: "أغسطس" },
                { Number: 9, Name: "سبتمبر" },
                { Number: 10, Name: "أكتوبر" },
                { Number: 11, Name: "نوفمبر" },
                { Number: 12, Name: "ديسمبر" }
            ],
            AddedInKind: {},
            ParentAccountArray: [],
            V_SelectOptions: [],
            tempInKind: {},
            EditedInKind: {},
            AddModalButton: false,
            main_datePicker: false,
            EditModalButton: false,
            rules: {
                numeric: v =>
                    !!(v || "").match(/^[0-9]*$/) || "Please enter a number",
                required: v => !!v || "This field is required"
            }
        };
    },
    created() {
        this.GetAccountsThatHasInKind();
        this.GetEndDateOfTransactionInArabic();
    },
    methods: {
        resetAddModalButtonform() { 
            this.AddModalButton = false
            this.$refs.createAccountForm.reset()
        },
        resetEditAccountForm() { 
            this.AddModalButton = false
            this.$refs.editAccountForm.reset()
        },
        GetAccountsThatHasInKind(page) {
            this.LoadingSpinner = true;
            axios
                .get(
                    route("AccountsStatementsHaveInKind.index", {
                        TransactionID: this.Transaction.id,
                        page
                    })
                )
                .then(({ data }) => {
                    console.log(data);
                    this.current_page = data.current_page;
                    this.last_page = data.last_page;
                    this.next_page_url = data.next_page_url;
                    this.prev_page_url = data.prev_page_url;
                    this.AccountsStatements.push(...data.data);

                    this.AccountsStatements.forEach(AccountStatement => {
                        this.V_SelectOptions.push({
                            label:
                                AccountStatement.code +
                                " " +
                                "# " +
                                AccountStatement.name,
                            code: AccountStatement.code,
                            id: AccountStatement.id
                        });

                        if (
                            AccountStatement.hasOwnProperty(
                                "branched_statements"
                            ) &&
                            AccountStatement.branched_statements.length
                        ) {
                            AccountStatement.branched_statements.forEach(
                                BranchedStatement => {
                                    this.V_SelectOptions.push({
                                        label:
                                            BranchedStatement.code +
                                            " " +
                                            "# " +
                                            BranchedStatement.name,
                                        id: BranchedStatement.id
                                    });
                                }
                            );
                        }
                    });

                    this.LoadingSpinner = false;
                })
                .catch(error => {
                    console.log(error);
                    this.$toast.error(".", "حدث خطأ برجاء اعادة المحاولة", {
                        timout: 300
                    });
                    this.LoadingSpinner = false;
                });
        },
        GetInKindOfAccountStatement(Account) {
            this.LoadingSpinner = true;
            axios
                .get(route("AccountStatementInKind", Account.id))
                .then(res => {
                    console.log(res.data.AccountStatementInKind);
                    Account.accounts_in_kind = [];
                    Account.accounts_in_kind.push(
                        ...res.data.AccountStatementInKind
                    );
                    this.LoadingSpinner = false;
                })
                .catch(error => {
                    console.log(error);
                    this.LoadingSpinner = false;
                });
        },
        GetInKindOfBranchedAccountsStatementsOfParentAccount(ParentAccount) {
            ParentAccount.branched_statements.forEach(branchedStatement => {
                this.GetInKindOfAccountStatement(branchedStatement);
            });
        },
        GetEndDateOfTransactionInArabic() {
            var splitedDate = this.Transaction.end_financial_year.split("-");
            splitedDate[1] = this.ArabicMonths.find(Month => {
                if (Month.Number == splitedDate[1]) {
                    return Month;
                }
            });
            if (splitedDate[1]) {
                this.Transaction.end_financial_year =
                    splitedDate[2] +
                    " / " +
                    splitedDate[1].Name +
                    " / " +
                    splitedDate[0];
                this.Transaction.FirstPastYearDate =
                    splitedDate[2] +
                    " / " +
                    splitedDate[1].Name +
                    " / " +
                    (parseInt(splitedDate[0]) - 1);
                this.Transaction.SecondPastYearDate =
                    splitedDate[2] +
                    " / " +
                    splitedDate[1].Name +
                    " / " +
                    (parseInt(splitedDate[0]) - 2);
                this.Transaction.ThirdPastYearDate =
                    splitedDate[2] +
                    " / " +
                    splitedDate[1].Name +
                    " / " +
                    (parseInt(splitedDate[0]) - 3);
                this.Transaction.FourthPastYearDate =
                    splitedDate[2] +
                    " / " +
                    splitedDate[1].Name +
                    " / " +
                    (parseInt(splitedDate[0]) - 4);
            }
        },
        formatValue(value) {
            if (value == null || value == 0) {
                return 0;
            }
            let val = (value / 1).toFixed(0).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        OpenAddModalOfInKind(ParentStatement) {
            this.ParentStatement = ParentStatement;
            this.AddedInKind.statement_id = ParentStatement.id;
            this.AddModalButton = true;
        },
        async StoreNewInKind() {
            let isValid = await this.$refs.createAccountForm.validate();
            if (!isValid) {
                return;
            }
            console.log("test");
            let formData = new FormData();

            formData.append("name", this.AddedInKind.name);
            formData.append(
                "detailed_credit",
                this.AddedInKind.detailed_credit
            );
            formData.append("detailed_debit", this.AddedInKind.detailed_debit);
            formData.append("serial", this.AddedInKind.serial);
            formData.append("date", this.AddedInKind.date);
            this.AddedInKind.corresponding_statement_code = this.AddedInKind.CorrespCode.code;
            formData.append(
                "corresponding_statement_code",
                this.AddedInKind.corresponding_statement_code
            );
            formData.append(
                "corresponding_statement_id",
                this.AddedInKind.CorrespCode.id
            );
            formData.append("statement_id", this.ParentStatement.id);
            axios
                .post(route("AccountsInKind.store"), formData)
                .then(({ data }) => {
                    this.AddedInKind.id = data.id;

                    this.ParentStatement.accounts_in_kind.push({
                        ...this.AddedInKind
                    });
                    console.log(data);
                    this.$toast.success(".", "تمت اضافة بيانات الحساب بنجاح", {
                        timout: 2000
                    });
                })
                .catch(error => {
                    this.$toast.error(".", "حدث خطأ برجاء اعادة المحاولة", {
                        timout: 300
                    });
                    console.log(error);
                });
            this.resetAddModalButtonform()
        },
        OpenEditInKindModal(ParentStatement, InKind, index) {
            this.ParentStatement = ParentStatement;

            this.tempInKind = { ...InKind };

            this.tempInKind.index = index;

            this.EditedInKind = InKind;
            this.EditModalButton = true
        },
        async EditInKind() {
            let isValid = await this.$refs.editAccountForm.validate();
            if (!isValid) {
                return;
            }


            let formData = new FormData();

            formData.append("_method", "PATCH");

            formData.append("name", this.tempInKind.name);
            formData.append("detailed_credit", this.tempInKind.detailed_credit);
            formData.append("detailed_debit", this.tempInKind.detailed_debit);
            formData.append("serial", this.tempInKind.serial);
            formData.append("date", this.tempInKind.date);

            if (
                this.tempInKind.VSelectValues &&
                this.tempInKind.VSelectValues.hasOwnProperty("code")
            ) {
                this.tempInKind.corresponding_statement_code = this.tempInKind.VSelectValues.code;
                formData.append(
                    "corresponding_statement_code",
                    this.tempInKind.corresponding_statement_code
                );
                formData.append(
                    "corresponding_statement_id",
                    this.tempInKind.VSelectValues.id
                );
            }

            formData.append("statement_id", this.ParentStatement.id);

            axios
                .post(
                    route("AccountsInKind.update", this.tempInKind.id),
                    formData
                )
                .then(({ data }) => {
                    for (const property in this.tempInKind) {
                        this.EditedInKind[property] = this.tempInKind[property];
                    }

                    console.log(data);
                    this.$toast.success(".", "تم التعديل بنجاح", {
                        timout: 2000
                    });
                })
                .catch(error => {
                    this.$toast.error(".", "حدث خطأ برجاء اعادة المحاولة", {
                        timout: 300
                    });
                    console.log(error);
                });

            this.$refs.CloseEditInKindModal.click();
        },
        DeleteInKind() {
            axios
                .delete(
                    route("AccountsInKind.destroy", [
                        this.EditedInKind.id,
                        this.ParentStatement.id
                    ])
                )
                .then(res => {
                    this.$toast.success(".", "تم الحذف بنجاح", {
                        timout: 2000
                    });

                    this.ParentStatement.accounts_in_kind.splice(
                        this.tempInKind.index,
                        1
                    );
                })
                .catch(error => {
                    this.$toast.error(".", "حدث خطأ برجاء اعادة المحاولة", {
                        timout: 300
                    });
                });
            this.$refs.CloseEditInKindModal.click();
        }
    }
};
</script>

<style scoped></style>
