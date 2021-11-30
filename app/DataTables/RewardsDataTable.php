<?php

namespace App\DataTables;

use App\Models\PointsLog;
use App\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RewardsDataTable extends DataTable
{
    public function ajax()
    {
        $rows = $this->query();

        return datatables()
            ->of($rows)    
            ->addColumn('id', function ($rows) {
                return ($rows->id);
            })
            ->addColumn('points', function ($rows) {
                return ($rows->points);
            })
            ->addColumn('created_at', function ($rows) {
                return dateFormat($rows->created_at);
            })
            ->addColumn('mode', function ($rows) {
                return ucwords(strtolower($rows->mode));
            })
            ->rawColumns(['id','points','mode', 'created_at'])
            ->make(true);
    }

    public function query()
    {
        $user_id  = Request::segment(4);
        $status   = isset(request()->status) ? request()->status : null;
        $from     = isset(request()->from) ? setDateForDb(request()->from) : null;
        $to       = isset(request()->to) ? setDateForDb(request()->to) : null;
        $property = isset(request()->property) ? request()->property : null;
        $customer = isset(request()->customer) ? request()->customer : null;
        $bookings = PointsLog::join('bookings', function ($join) {
                                $join->on('points_log.pointable_id', '=', 'bookings.id');
        })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'points_log.user_id');
                        })
                        ->join('currency', function ($join) {
                                $join->on('currency.code', '=', 'bookings.currency_code');
                        })
                        ->select(['points_log.id as id', 'bookings.id as booking_id', 'points_log.points as points',  'bookings.property_id as property_id', 'points_log.mode', 'points_log.created_at as created_at', 'points_log.updated_at as updated_at', 'bookings.start_date', 'bookings.end_date']);
        if (isset($user_id)) {
            $bookings->where('points_log.user_id', '=', $user_id);
        }
        if (!empty($from)) {
             $bookings->whereDate('points_log.created_at', '>=', $from);
        }
        if (!empty($to)) {
             $bookings->whereDate('points_log.created_at', '<=', $to);
        }
        if (!empty($property)) {
            $bookings->where('bookings.property_id', '=', $property);
        }
        if (!empty($status)) {
            $bookings->where('points_log.mode', '=', $status);
        }

        return $this->applyScopes($bookings);
    }
    
    public function html()
    {

        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'ID', 'visible' => false])
            ->addColumn(['data' => 'points', 'name' => 'points', 'title' => 'Points'])
            ->addColumn(['data' => 'mode', 'name' => 'mode', 'title' => 'Status'])
            ->addColumn(['data' => 'created_at', 'name' => 'points_log.created_at', 'title' => 'Date'])
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

    protected function filename()
    {
        return 'rewardsdatatables_' . time();
    }
}
