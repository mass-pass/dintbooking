<?php

namespace App\DataTables;

use App\Models\Backup;
use Yajra\DataTables\Services\DataTable;

class BackupsDataTable extends DataTable
{
    public function ajax()
    {
        $backup = $this->query();

        return datatables()
            ->of($backup)
            ->addColumn('action', function ($backup) {
                $edit = '<a href="' . url('admin/backup/download/' . $backup->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-download"></i></a>';
                return $edit;
            })
                ->addColumn('created_at', function ($backup) {
                return dateFormat($backup->created_at);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $backup = Backup::orderBy('created_at', 'desc');
        return $this->applyScopes($backup);
    }

    public function html()
    {
        return $this->builder()
                    ->addColumn(['data' => 'id', 'name' => 'backups.id', 'title' => 'Id'])
                    ->addColumn(['data' => 'name', 'name' => 'backups.name', 'title' => 'Name'])
                    ->addColumn(['data' => 'created_at', 'name' => 'backups.created_at', 'title' => 'Date'])
                    ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
                    ->parameters([
                        'dom' => 'lBfrtip',
                        'buttons' => [],
                        'order' => [0, 'desc'],
                        'pageLength' => \Session::get('row_per_page'),
                    ]);
    }
}
