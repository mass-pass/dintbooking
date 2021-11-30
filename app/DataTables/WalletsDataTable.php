<?php



namespace App\DataTables;



use App\Models\User;

use App\Models\Wallet;

use Yajra\DataTables\Services\DataTable;

use Auth;

use Request;


class WalletsDataTable extends DataTable

{

    public function ajax()

    {

        return datatables()
            ->eloquent($this->query())
            ->addColumn('created_at', function ($wallets) {
                return dateFormat($wallets->created_at);

            })
            ->addColumn('is_active', function ($wallets) {
                if ($wallets->is_active == '1') {
                    return 'Active';
                } else {

                    return 'Inactive';
                }
            })

            ->addColumn('user_id', function ($wallets) {
                $userName = ucfirst($wallets->user->first_name).' '.ucfirst($wallets->user->last_name);
                return $userName;
            })

            ->addColumn('currency_id', function ($wallets) {
                $currencyCode = $wallets->currency->code;
                return $currencyCode;
            })
            ->make(true);

    }

    public function query()
    {
        $user_id = Request::segment(4);
        $userWalltes = Wallet::where(['user_id' => $user_id]);
        return $this->applyScopes($userWalltes);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID'])
            ->addColumn(['data' => 'user_id', 'name' => 'user_id', 'title' => 'User Name'])
            ->addColumn(['data' => 'currency_id', 'name' => 'currency_id', 'title' => 'Currency'])
            ->addColumn(['data' => 'balance', 'name' => 'balance', 'title' => 'Balance'])
            ->addColumn(['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status', 'orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
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
        return 'walletsdatatables_' . time();
    }

}

