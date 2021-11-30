<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Withdrawal;
use App\Models\PayoutSettings;
use Yajra\DataTables\Services\DataTable;
use Auth;

class PayoutListDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())

            ->addColumn('payment_method_id', function ($withDrawal) {
                
                return $withDrawal->payment_methods['name'];
            })
            ->addColumn('user_id', function ($withDrawal) {
                $userName = ucfirst($withDrawal->user->first_name).' '.ucfirst($withDrawal->user->last_name);
                return $userName;
            })


            ->addColumn('subtotal', function ($withDrawal) {
                if ($withDrawal->status == 'Success') {
                        $subtotal = moneyFormat($withDrawal->currency->org_symbol, $withDrawal->amount);
                    } else {
                        $subtotal = moneyFormat($withDrawal->currency->org_symbol, $withDrawal->subtotal);
                    }
                    return $subtotal;
                })

            ->addColumn('created_at', function ($withDrawal) {
            $dateFormat = dateFormat($withDrawal->created_at);
            return $dateFormat;
            })
                
            ->rawColumns(['payment_method_id','user_id','currency_id','subtotal','created_at'])
            ->make(true);
            
    }

    public function query()
    {
        $from     = isset(request()->from) ? setDateForDb(request()->from) : null;
        $to       = isset(request()->to) ? setDateForDb(request()->to) : null;
 
        $query    = Withdrawal::where(['user_id' => Auth::user()->id]);

        if (!empty($from)) {
            $query->whereDate('withdrawals.created_at', '>=', $from);
        }

        if (!empty($to)) {
            $query->whereDate('withdrawals.created_at', '<=', $to);
        }
 
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID', 'visible' => false])
             ->addColumn(['data' => 'user_id', 'name' => 'user_id', 'title' => trans('messages.utility.account')])
             ->addColumn(['data' => 'payment_method_id', 'name' => 'payment_method_id', 'title' => trans('messages.utility.payment_method')])
            ->addColumn(['data' => 'subtotal', 'name' => 'subtotal', 'title' => trans('messages.account_transaction.amount')])
            ->addColumn(['data' => 'status', 'name' => 'status', 'title' => trans('messages.account_transaction.status')])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => trans('messages.account_transaction.date')])
             ->parameters([
                'dom' => 'lBfrtip',
                'buttons' => [],
                'order' => [0, 'desc'],
                'pageLength' => \Session::get('row_per_page'),
            ]);
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
        return 'payoutsettingsdatatables_' . time();
    }
}
