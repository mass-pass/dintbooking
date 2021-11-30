<?php

namespace App\DataTables;

use App\Models\StartingCities;
use Yajra\DataTables\Services\DataTable;

class StartingCitiesDataTable extends DataTable
{
    protected $exportColumns = ['name', 'image'];

    public function ajax()
    {
        $startingCities = $this->query();

        return datatables()
            ->of($startingCities)
            ->addColumn('image', function ($startingCities) {
                return '<img src="' . $startingCities->image_url . '" width="200" height="100">';
            })
            ->addColumn('action', function ($startingCities) {
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-cities/' . $startingCities->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a href="' . url('admin/settings/delete-starting-cities/' . $startingCities->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('name', function ($startingCities) {
                return '<a target="_blank" href="' . url('admin/settings/edit-starting-cities/' . $startingCities->id) . '">' . $startingCities->name . '</a>';
            })
            ->rawColumns(['action','image','name'])
            ->make(true);
    }

    public function query()
    {
        $startingCities = StartingCities::select();
        return $this->applyScopes($startingCities);
    }

    public function html()
    {
        return $this->builder()
        ->columns([
            'name',
            'image',
        ])
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
        return 'spacetypedatatables_' . time();
    }
}
