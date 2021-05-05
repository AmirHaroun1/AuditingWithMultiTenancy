<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeBranch extends Model
{
    //
    protected $table = 'branches';
    public function scopeWithOfficeTransactionsStats($query){

        $query->addSelect(['AllTransactions' => function ($query) {
            $query->selectRaw('count(*)  From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['LateTransactions' => function ($query) {
            $query ->selectRaw('count(case when time_status="unacceptable" and status !="rejected" and status !="withdrawn" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['LateTransactionAtSecretary' => function ($query) {
            $query->selectRaw('count(case when secretary_time < secretary_actualTime then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['LateTransactionAtReviser' => function ($query) {
            $query->selectRaw('count(case when reviser_time < reviser_actualTime then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['LateTransactionAtAuditor' => function ($query) {
            $query->selectRaw('count(case when auditor_time < auditor_actualTime then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['LateTransactionAtRevisingManager' => function ($query) {
            $query->selectRaw('count(case when revisingManager_time < revisingManager_actualTime then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['LateTransactionAtManagingPartner' => function ($query) {
            $query->selectRaw('count(case when Managing_partner_time < Managing_partner_actualTime then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['TransactionsUnderReview' => function ($query) {
            $query->selectRaw('count(case when status="under_review" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['TransactionsWithReviser' => function ($query) {
            $query->selectRaw('count(case when status="reviser" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['TransactionsWithAuditor' => function ($query) {
            $query->selectRaw('count(case when status="auditor" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);

        $query->addSelect(['TransactionsWithRevisingManager' => function ($query) {
            $query->selectRaw('count(case when status="revising_manager" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);

        $query->addSelect(['TransactionsWithManagingPartner' => function ($query) {
            $query->selectRaw('count(case when status="managing_partner" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);

        $query->addSelect(['FinishedTransactions' => function ($query) {
            $query->selectRaw('count(case when status="finished" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['rejectedTransactions' => function ($query) {
            $query->selectRaw('count(case when status="rejected" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['WithdrawnTransactions' => function ($query) {
            $query->selectRaw('count(case when status="withdrawn" then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);


        $query->addSelect(['TransactionsAuditorIsChanged' => function ($query) {
            $query->selectRaw('count(case when auditor_is_changed then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);

        $query->addSelect(['CurrentYearTransactions' => function ($query) {
            $query->selectRaw('count(case when YEAR(created_at) = YEAR(CURRENT_TIMESTAMP) then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);
        $query->addSelect(['PastYearTransactions' => function ($query) {
            $query->selectRaw('count(case when YEAR(created_at) = YEAR(CURRENT_TIMESTAMP)-1 then 1 end ) From Transactions where branches.id = transactions.branch_office_id');
        }]);

        $query->addSelect(['TotalValueAVG' => function ($query) {
            $query->selectRaw('AVG(total_value) From Transactions where branches.id = transactions.branch_office_id');
        }]);



    }
}
