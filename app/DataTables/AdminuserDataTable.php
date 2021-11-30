<?php


namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Services\DataTable;

class AdminuserDataTable extends DataTable
{
    public function ajax()
    {
        $admin = $this->query();

        return datatables()
            ->of($admin)
            ->addColumn('action', function ($admin) {
                $edit = '<a href="' . url('admin/edit-admin/' . $admin->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                $delete = '<a href="' . url('admin/delete-admin/' . $admin->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
                return $edit . $delete;
            })
            ->addColumn('username', function ($admin) {
                return '<a href="' . url('admin/edit-admin/' . $admin->id) . '">' . $admin->username . '</a>';
            })
            ->rawColumns(['username','action'])
            ->make(true);
    }
 
    public function query()
    {
        $admin = Admin::join('role_admin', function ($join) {
                                $join->on('role_admin.admin_id', '=', 'admin.id');
        })
                        ->join('roles', function ($join) {
                                $join->on('roles.id', '=', 'role_admin.role_id');
                        })
                        ->select(['admin.id as id', 'username', 'email', 'roles.display_name as role_name', 'status']);

        return $this->applyScopes($admin);
    }
    
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'username', 'name' => 'admin.username', 'title' => 'Username'])
            ->addColumn(['data' => 'email', 'name' => 'admin.email', 'title' => 'Email'])
            ->addColumn(['data' => 'role_name', 'name' => 'roles.display_name', 'title' => 'Role Name'])
            ->addColumn(['data' => 'status', 'name' => 'admin.status', 'title' => 'Status'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
            ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => [],
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
        return 'admindatatables_' . time();
    }
}
