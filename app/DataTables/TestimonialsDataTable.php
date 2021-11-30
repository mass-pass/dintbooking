<?php

namespace App\DataTables;

use App\Models\Testimonials;
use Yajra\DataTables\Services\DataTable;
use Request;
use App\Http\Helpers\Common;

class TestimonialsDataTable extends DataTable
{
    public function ajax()
    {
        $testimonials = $this->query();

        return datatables()
            ->of($testimonials)

            ->addColumn('action', function ($testimonials) {
                $edit = $delete = '';
                if (Common::has_permission(\Auth::guard('admin')->user()->id, 'edit_testimonial')) {
                    $edit = '<a href="' . url('admin/edit-testimonials/' . $testimonials->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                }
                if (Common::has_permission(\Auth::guard('admin')->user()->id, 'delete_testimonial')) {
                    $delete = '<a href="' . url('admin/delete-testimonials/' . $testimonials->id) . '" class="btn btn-xs     btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
                }
                return $edit . $delete;
            })

            ->addColumn('review', function($testimonials)  {
                $options = '';   
                for ($i = 1; $i <=5 ; $i++) { 
                    if ($i<=$testimonials->review) {
                        $options .= ' <i  class="icon icon-star icon-beach icon-click">';
                    }else{
                        $options .= ' <i  class="icon icon-star icon-light-gray icon-click" style="color:black">';
                    }
                };    
                return $options;
            })

            ->addColumn('created_at', function ($testimonials) {
                return dateFormat($testimonials->created_at);
            })

            ->addColumn('description', function ($testimonials) {
                return substr($testimonials->description, 0, 50);
            })
        ->rawColumns(['action','review'])
        ->make(true);
    }

    
    public function query()
    {
        $testimonials =Testimonials::select();
        return $this->applyScopes($testimonials);
    }

    public function html()
    {
        return $this->builder()
        ->columns([
            'id',
            'name',
            'designation',
            'description',
            'review',
            'status',
            'created_at'

        ])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
        ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => [],
            'pageLength' => \Session::get('row_per_page'),
        ]);
    }
}
