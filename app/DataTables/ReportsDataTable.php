<?php

namespace App\DataTables;

use App\Models\Reports;
use App\Models\Photo;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTable extends DataTable
{
    public function ajax()
    {
        $report = $this->query();

        return datatables()
            ->of($report)
            ->make(true);
    }

    
    public function query()
    {
         $reports = Reports::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'reports.property_id');
         })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'reports.user_id');
                        })
                       
                        ->select(['properties.name as property_name', 'users.first_name as host_name', 'reports.message as message', 'reports.status as status', 'reports.created_at']);

        return $this->applyScopes($reports);
    }

    public function html()
    {
         return $this->builder()
        ->addColumn(['data' => 'host_name', 'name' => 'host_name', 'title' => 'Host Name'])
        ->addColumn(['data' => 'property_name', 'name' => 'property_name', 'title' => 'Property Name'])
        ->addColumn(['data' => 'message', 'name' => 'message', 'title' => 'Message'])
        ->addColumn(['data' => 'status', 'name' => 'reports.status', 'title' => 'Status'])
        ->addColumn(['data' => 'created_at', 'name' => 'reports.created_at', 'title' => 'Date'])
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
        return 'membersdatatables_' . time();
    }
}
