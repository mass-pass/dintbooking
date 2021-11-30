<?php

namespace App\DataTables;

use App\Models\Comment;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Request;

class CommentsDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('uname', function ($comment) {
                $userName = '<a href="' . url('admin/edit_member/' . $comment->users->id) . '" ><h5>'. ucfirst($comment->users->name) . '</h5></a>';
                return $userName;
            })
            ->rawColumns(['uname'])
            ->make(true);
    }

    public function query()
    {
        $id    = Request::segment(3);
        $query = Comment::where('photo_id', $id)->select();

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'comment', 'name' => 'comments.comment', 'title' => 'Comment'])
            ->addColumn(['data' => 'uname', 'name' => 'uname', 'title' => 'User Name'])
            ->addColumn(['data' => 'created_at', 'name' => 'comments.created_at', 'title' => 'Created At'])
            ->addColumn(['data' => 'updated_at', 'name' => 'comments.updated_at', 'title' => 'Updated At'])
            ->parameters($this->getBuilderParameters());
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
