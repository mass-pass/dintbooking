<?php

namespace App\DataTables;

use App\Models\Banners;
use Yajra\DataTables\Services\DataTable;

class BannersDataTable extends DataTable
{
    public function ajax()
    {
        $banners = $this->query();

        return datatables()
            ->of($banners)
            ->addColumn('image', function ($banners) {
                return '<img src="' . $banners->image_url . '" width="200" height="100">';
            })
            ->addColumn('action', function ($banners) {
                return '<a target="_blank" href="' . url('admin/settings/edit-banners/' . $banners->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a href="' . url('admin/settings/delete-banners/' . $banners->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->rawColumns(['image','action'])
            ->make(true);
    }

    
    public function query()
    {
        $banners = Banners::select();
        return $this->applyScopes($banners);
    }

    public function html()
    {
        return $this->builder()
        ->columns([
            'heading',
            'subheading',
            'image',
        ])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
        ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => [],
            'pageLength' => \Session::get('row_per_page'),
        ]);
    }
}
