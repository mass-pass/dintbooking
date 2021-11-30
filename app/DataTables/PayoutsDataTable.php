<?php
namespace App\DataTables;
use App\Models\User;
use App\Models\Withdrawal;
use Yajra\DataTables\Services\DataTable;
use Auth;
use Request;

class PayoutsDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
        ->eloquent($this->query())
        ->addColumn('payment_method_id', function ($withDrawal) {
            if ($withDrawal->payment_method_id == 4) {

                return 'Bank';
            } else {
                return 'PayPal';
            }
        })

        ->addColumn('user_id', function ($withDrawal) {
            $userName = ucfirst(isset($withDrawal->user->first_name) ? $withDrawal->user->first_name : ' ').' '.ucfirst(isset($withDrawal->user->last_name) ? $withDrawal->user->last_name : '');
            return $userName;
        })

        
        ->addColumn('subtotal', function ($withDrawal) {
            if ($withDrawal->status == 'Success') {
                $subtotal = $withDrawal->amount;
            } else {
                $subtotal = $withDrawal->subtotal;
            }
            return $subtotal;
        })
        ->addColumn('currency_id', function ($withDrawal) {
            $currency = $withDrawal->currency->code;
            return $currency;
        })
        ->addColumn('action', function ($withDrawal) {
            if ($withDrawal->status == 'Pending') {
                return '<a href="' . url('admin/payouts/edit/' . $withDrawal->id) . '" class="btn btn-xs btn-primary" title="Edit payout"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
            }else{
                return '<a href="' . url('admin/payouts/details/' . $withDrawal->id) . '" class="btn btn-xs btn-primary" title="Details"><i class="glyphicon glyphicon-tasks"></i></a>&nbsp;';

            }
            
        })

        ->rawColumns(['action'])
        ->make(true);
    }

    public function query()
    {
        $status   = isset(request()->status) ? request()->status : null;
        $from     = isset(request()->from) ? setDateForDb(request()->from) : null;
        $to       = isset(request()->to) ? setDateForDb(request()->to) : null;

        $user_id  = Request::segment(4);
        $query    = Withdrawal::select();
        if (isset($user_id)) {
            $query->where('user_id', '=', $user_id);
        }

        if (!empty($from)) {
         $query->whereDate('created_at', '>=', $from);
        }

        if (!empty($to)) {
            $query->whereDate('created_at', '<=', $to);
        }

        if (!empty($status)) {
            $query->where('status', '=', $status);
        }

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
        ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID', 'visible' => false])
        ->addColumn(['data' => 'user_id', 'name' => 'user_id', 'title' => 'User Name'])
        ->addColumn(['data' => 'currency_id', 'name' => 'currency_id', 'title' => 'Currency'])
        ->addColumn(['data' => 'payment_method_id', 'name' => 'payment_method_id', 'title' => 'Payment Method'])
            // ->addColumn(['data' => 'bank_name', 'name' => 'bank_name', 'title' => 'Bank Name'])
        ->addColumn(['data' => 'account_number', 'name' => 'account_number', 'title' => 'Account Number'])
        ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            // ->addColumn(['data' => 'swift_code', 'name' => 'swift_code', 'title' => 'Swift Code'])
        ->addColumn(['data' => 'subtotal', 'name' => 'subtotal', 'title' => 'Amount'])
        ->addColumn(['data' => 'status', 'name' => 'status', 'title' => 'Status'])
        ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])

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

                // add your columns

            'created_at',
            'updated_at',
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'payoutsdatatables_' . time();

    }
}
