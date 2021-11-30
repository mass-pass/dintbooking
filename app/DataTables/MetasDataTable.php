<?php

namespace App\DataTables;

use App\Models\Meta;
use Yajra\DataTables\Services\DataTable;

class MetasDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($seoMetas) {

                $edit = '<a href="' . url('admin/settings/edit_meta/' . $seoMetas->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';

                return $edit;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = Meta::select();
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'url', 'name' => 'seo_metas.url', 'title' => 'Url'])
            ->addColumn(['data' => 'title', 'name' => 'seo_metas.title', 'title' => 'Title'])
            ->addColumn(['data' => 'description', 'name' => 'seo_metas.description', 'title' => 'Description'])
            ->addColumn(['data' => 'keywords', 'name' => 'seo_metas.keywords', 'title' => 'Keywords'])
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
        return 'campaignsdatatables_' . time();
    }
}
