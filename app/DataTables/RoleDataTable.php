<?php

namespace App\DataTables;

use App\Models\Roles;
use Yajra\DataTables\Services\DataTable;
use Auth;

class RoleDataTable extends DataTable
{
    public function ajax()
    {
        $role = $this->query();

        return datatables()
            ->of($role)
            ->addColumn('action', function ($role) {
                return '<a href="' . url('admin/settings/edit-role/' . $role->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a href="' . url('admin/settings/delete-role/' . $role->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('name', function ($role) {
                return '<a href="' . url('admin/settings/edit-role/' . $role->id) . '">' . $role->name. '</a>';
            })
            ->rawColumns(['action','name'])
            ->make(true);
    }

    public function query()
    {
        $role = Roles::select();
        return $this->applyScopes($role);
    }

    public function html()
    {
        return $this->builder()
            ->columns([
                'name',
                'display_name',
                'description',
            ])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
            ->parameters([
            'pageLength' => \Session::get('row_per_page'),
        ]);
    }
}
