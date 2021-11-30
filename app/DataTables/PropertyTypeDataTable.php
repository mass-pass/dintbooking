<?php

namespace App\DataTables;

use App\Models\PropertyType;
use Yajra\DataTables\Services\DataTable;

class PropertyTypeDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($propertyType) {

                $edit = '<a href="' . url('admin/settings/edit-property-type/' . $propertyType->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                $delete = '<a href="' . url('admin/settings/delete-property-type/' . $propertyType->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';

                return $edit . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = PropertyType::query();
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'name', 'name' => 'property_type.name', 'title' => 'Name'])
            ->addColumn(['data' => 'description', 'name' => 'property_type.description', 'title' => 'Description'])
            ->addColumn(['data' => 'status', 'name' => 'property_type.status', 'title' => 'Status'])
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
        return 'propertytypedatatables_' . time();
    }
}
