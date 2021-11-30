<?php


namespace App\DataTables;


use App\Models\Visitor;
use Yajra\DataTables\Services\DataTable;

class VisitorDatatable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($visitor) {
                $show = '<a href="' . route('visitors.show',$visitor->id) . '" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-eye-open"></i></a>';
//                $edit = '<a href="' . route('visitors.edit',$visitor->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                $delete = '<a href="' . route('visitors.destroy',$visitor->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
                return $show . ' ' . $delete;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function query()
    {
        $query = Visitor::select();

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'ip', 'name' =>'visitors.ip', 'title' => 'IP'])
            ->addColumn(['data' => 'city', 'name' =>'visitors.city', 'title' => 'City'])
            ->addColumn(['data' => 'country_name', 'name' =>'visitors.country_name', 'title' => 'Country'])
            ->addColumn(['data' => 'action', 'name' =>'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
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
        return 'visitordatatables_' . time();
    }
}