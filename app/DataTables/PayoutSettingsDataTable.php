<?php



namespace App\DataTables;



use App\Models\User;

use App\Models\PayoutSetting;

use Yajra\DataTables\Services\DataTable;

use Auth;



class PayoutSettingsDataTable extends DataTable

{

    public function ajax()

    {

        return datatables()

            ->eloquent($this->query())

            ->addColumn('action', function ($payoutSetting) {

                $edit = $delete = '';

              

                    $edit = '<a href="' . url('users/payout/edit-payout/' . $payoutSetting->id) . '" class=""><i class="fa fa-edit"></i></a>&nbsp;';

              

                    $delete = '<a href="' . url('users/payout/delete-payout/' . $payoutSetting->id) . '" class="delete-warning"><i style="color:red" class="fa fa-trash"></i></a>';

                

                return $edit . $delete;

            })

               ->addColumn('type', function ($payoutSetting) {

                if ($payoutSetting->type == '4') {
                    return 'Bank';
                }else{
                    return 'PayPal';

                }

              })
            ->rawColumns(['action'])
            ->make(true);

    }



    public function query()

    {

      

        

        $query    = PayoutSetting::where(['user_id' => Auth::user()->id]);



    

        

        return $this->applyScopes($query);

    }



    public function html()

    {

        return $this->builder()

            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID', 'visible' => false])



            // ->addColumn(['data' => 'user_id', 'name' => 'user_id', 'title' => 'User Name'])

            // ->addColumn(['data' => 'first_name', 'name' => 'first_name', 'title' => 'First Name', 'visible'=>false])

            // ->addColumn(['data' => 'last_name', 'name' => 'last_name', 'title' => 'Last Name', 'visible'=>false])

            ->addColumn(['data' => 'type', 'name' => 'type', 'title' => 'Payout Type'])

            // ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])

            ->addColumn(['data' => 'account_name', 'name' => 'account_name', 'title' => 'Account'])

            // ->addColumn(['data' => 'bank_branch_name', 'name' => 'bank_branch_name', 'title' => 'Bank Branch Name'])

            // ->addColumn(['data' => 'account_number', 'name' => 'account_number', 'title' => 'Account Number'])

            // ->addColumn(['data' => 'bank_branch_city', 'name' => 'bank_branch_city', 'title' => 'Bank Branch City'])

            // ->addColumn(['data' => 'bank_branch_address', 'name' => 'bank_branch_address', 'title' => 'Bank Branch Address'])

            //  ->addColumn(['data' => 'country', 'name' => 'country', 'title' => 'Country'])

            //  ->addColumn(['data' => 'swift_code', 'name' => 'swift_code', 'title' => 'Swift Code'])

            //  ->addColumn(['data' => 'bank_name', 'name' => 'bank_name', 'title' => 'Bank Name'])

            // ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])

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

            'created_at',

            'updated_at',

        ];

    }



    protected function filename()

    {

        return 'payoutsettingsdatatables_' . time();

    }

}

