<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Messages;
use App\Models\Properties;
use App\Models\Bookings;
use App\Models\Admin;
use Yajra\DataTables\Services\DataTable;
use Auth;
use DB;
class MessagesDataTable extends DataTable
{
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', function ($message) {
                $edit   = $delete = '';
                $edit   = \Helpers::has_permission(Auth::guard('admin')->user()->id, 'edit_messages') ?'<a href="'.url('admin/send-message-email/'.$message->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;':'';
                

                return $edit;
            })
            ->addColumn('sender_id', function ($message) {
                return ucfirst($message->sender->first_name). ' ' . ucfirst($message->sender->last_name);
            })
            ->addColumn('receiver_id', function ($message) {
                return ucfirst($message->receiver->first_name). ' ' . ucfirst($message->receiver->last_name);
            })
            ->addColumn('property_id', function ($message) {
                return ucfirst($message->properties->name);
            })

          ->addColumn('message', function ($message) {
                return '<a href="'.url('admin/messaging/host/'.$message->bookings->id).'">'.wordwrap($message->message,25,"<br>\n").'</a>';
            })
                ->addColumn('created_at', function ($message) {
                return dateFormat($message->created_at);
            })
            ->rawColumns(['action','sender_id','receiver_id','property_id','message'])
            ->make(true);
    }

    public function query()
    {   
       

        $query = Messages::with('properties','sender','receiver')->whereRaw('id in (select max(id) from messages group by (booking_id))');

        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'id', 'title' => 'Message No '])
            ->addColumn(['data' => 'booking_id', 'name' => 'booking_id', 'title' => 'Booking Id '])
            ->addColumn(['data' => 'sender_id', 'name' => 'sender_id', 'title' => 'Sender '])
            ->addColumn(['data' => 'sender_id', 'name' => 'sender.first_name', 'title' => 'Sender', 'visible' => false])
            ->addColumn(['data' => 'sender_id', 'name' => 'sender.last_name', 'title' => 'Sender', 'visible' => false])
            ->addColumn(['data' => 'receiver_id', 'name' => 'receiver_id', 'title' => 'Receiver '])
            ->addColumn(['data' => 'receiver_id', 'name' => 'receiver.first_name', 'title' => 'Receiver', 'visible' => false])
            ->addColumn(['data' => 'receiver_id', 'name' => 'receiver.last_name', 'title' => 'Receiver', 'visible' => false])
            ->addColumn(['data' => 'property_id', 'name' => 'property_id', 'title' => 'Property Name '])
            ->addColumn(['data' => 'message', 'name' => 'message', 'title' => 'Messages'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At', 'orderable' => false,])
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
        return 'messagesdatatables_' . time();
    }
}
