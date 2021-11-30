<?php

namespace App\DataTables;

use App\Models\Penalty;
use Yajra\DataTables\Services\DataTable;
use DB;

class GuestPenaltyDataTable extends DataTable
{
    public function ajax()
    {
        $penalty = $this->query();

        return datatables()
            ->of($penalty)
            ->make(true);
    }

    public function query()
    {
        $gusetPenalty = Penalty::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'penalty.property_id');
        })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'penalty.user_id');
                        })
                        ->join('currency', function ($join) {
                                $join->on('currency.code', '=', 'penalty.currency_code');
                        })
                        ->where('penalty.user_type', 'Guest')
                        ->select(['properties.name as property_name', 'users.first_name as host_name', 'penalty.amount as amount', 'penalty.booking_id', 'penalty.status as status', 'penalty.created_at', 'penalty.updated_at', 'penalty.currency_code']);

        return $this->applyScopes($gusetPenalty);
    }

    public function html()
    {
         return $this->builder()
        ->addColumn(['data' => 'host_name', 'name' => 'host_name', 'title' => 'Host Name'])
        ->addColumn(['data' => 'property_name', 'name' => 'property_name', 'title' => 'Property Name'])
        ->addColumn(['data' => 'booking_id', 'name' => 'penalty.booking_id', 'title' => 'Booking Id'])
        ->addColumn(['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'])
        ->addColumn(['data' => 'status', 'name' => 'penalty.status', 'title' => 'Status'])
        ->addColumn(['data' => 'created_at', 'name' => 'penalty.created_at', 'title' => 'Date'])
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
        return 'guestpenaltydatatables_' . time();
    }
}
