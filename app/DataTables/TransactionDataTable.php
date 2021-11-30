<?php
namespace App\DataTables;

use App\Models\{
    User,
    Withdrawal,
    Bookings
};
use Auth, Request, DB, Session;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
{
    public function ajax()
    {
        $transaction = $this->query();
        return datatables()
        ->of($transaction)

        ->addColumn('method', function ($transaction) {
            return $transaction->method;
        })

        ->addColumn('date', function ($transaction) {
            $date = dateFormat($transaction->date);
            return $date;
        })
        ->addColumn('username', function ($transaction) { 
           if (is_numeric($transaction->c)) {
                return $transaction->username;
            }
            return '<a href="../booking/receipt?code='.$transaction->code.'">'.$transaction->username.'</a>';
        })
        ->addColumn('type', function ($transaction) { 
            if (is_numeric($transaction->c)) {
                return 'Payouts';
            }
            return 'Bookings';
        })

        ->addColumn('amount', function ($transaction) { 
            return moneyFormat($transaction->symbol, $transaction->amount);

        })

        ->addColumn('symbol', function ($transaction) { 
            return $transaction->symbol;
        })
   
       ->rawColumns(['amount','username'])

        ->make(true);
    }

    public function query()
    {
        $user_id  = Auth::id();
        $from     = isset(request()->from) ? setDateForDb(request()->from) : null;
        $to       = isset(request()->to) ? setDateForDb(request()->to) : null;
        
        $withdrawals = Withdrawal::join('currency', function ($join) {
            $join->on('withdrawals.currency_id', '=', 'currency.id');
        })->join('payment_methods', function ($join) {
            $join->on('withdrawals.payment_method_id', '=', 'payment_methods.id');
        })->join("users","users.id","=","withdrawals.user_id")
        ->select(['withdrawals.id as id','users.first_name as username','withdrawals.uuid as code',  'withdrawals.amount AS amount', 'withdrawals.currency_id AS c', 'currency.symbol AS symbol', 'payment_methods.name AS method', 'withdrawals.created_at AS date'])->where('withdrawals.user_id', '=', $user_id)->where('withdrawals.status', '=', 'Success');

        if (!empty($from)) {
            $withdrawals->whereDate('withdrawals.created_at', '>=', $from);
        }

        if (!empty($to)) {
            $withdrawals->whereDate('withdrawals.created_at', '<=', $to);
        }

        $bookings = Bookings::join('currency', function ($join) {
            $join->on('bookings.currency_code', '=', 'currency.code');
        })
        ->join("users","users.id","=","bookings.user_id")
        ->join('payment_methods', function ($join) {
            $join->on('bookings.payment_method_id', '=', 'payment_methods.id');
        })->select(['bookings.id as id','users.first_name as username','bookings.code as code', DB::raw('(bookings.total - bookings.service_charge) as amount'), 'bookings.currency_code AS c', 'currency.symbol AS symbol', 'payment_methods.name AS method', 'bookings.created_at AS date'])->where('bookings.host_id', '=', $user_id)->where('bookings.status', '=', 'Accepted');
        
        if (!empty($from)) {
            $bookings->whereDate('bookings.created_at', '>=', $from);
        }

        if (!empty($to)) {
            $bookings->whereDate('bookings.created_at', '<=', $to);
        }
    
        $query = $withdrawals->union($bookings)->orderBy('date', 'desc');

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
        ->addColumn(['data' => 'username', 'name' => 'username', 'title' => trans('messages.property_single.guests')])
        ->addColumn(['data' => 'type', 'name' => 'type', 'title' => trans('messages.account_transaction.type')])
        ->addColumn(['data' => 'method', 'name' => 'method', 'title' => trans('messages.utility.payment_method')])
        ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => trans('messages.withdraw.amount')])
        ->addColumn(['data' => 'date', 'name' => 'date', 'title' => trans('messages.account_transaction.date')])
        ->parameters([
            'order' => [0, 'desc'], 
            'pageLength' => Session::get('row_per_page'),
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


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'transactiondatatables_' . time();

    }
}
