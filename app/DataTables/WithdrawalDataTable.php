<?php

namespace App\DataTables;

use App\Models\Payment;
use App\Models\Photo;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\UserDetail;
use App\Http\Helpers\Common;
use Yajra\DataTables\Services\DataTable;

class WithdrawalDataTable extends DataTable
{
 
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($withdraw) {
                if ($withdraw->status != 'Accepted') {
                    $edit = '<a href="' . url('admin/withdrawals/approve/' . $withdraw->id) . '" class="btn btn-xs btn-primary">Authorize</a>&nbsp;';
                    return $edit;
                } else {
                    $edit = '&nbsp;';
                    return $edit;
                }
            })
            ->addColumn('uname', function ($withdraw) {
                $userName  = '<a href="' . url('admin/edit_member/' . $withdraw->users->id) . '" ><h5>' . ucfirst($withdraw->users->name) . '</h5></a>';
                return $userName;
            })
            ->addColumn('account_email', function ($withdraw) {
                $details          = UserDetail::where('user_id', $withdraw->user_id)->where('field', 'paypal_email')->first();
                $accountEmail    = isset($details->value) ? $details->value : '';
                return $accountEmail;
            })
            ->rawColumns(['action','uname','account_email'])
            ->make(true);
    }

    public function query()
    {
        $query = Withdraw::join('users', 'withdraws.user_id', '=', 'users.id')->select(['withdraws.*', 'users.*']);
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'uname', 'name' => 'users.name', 'title' => 'User Name','orderable' => false])
            ->addColumn(['data' => 'account_email', 'name' => 'account_email', 'title' => 'Payment Email','orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'amount', 'name' => 'withdraws.amount', 'title' => 'Amount'])
            ->addColumn(['data' => 'status', 'name' => 'withdraws.status', 'title' => 'Status'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
            ->parameters($this->getBuilderParameters());
    }

    protected function getColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename()
    {
        return 'membersdatatables_' . time();
    }
}
