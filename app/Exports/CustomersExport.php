<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CustomersExport implements FromArray,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        
        $to                 = setDateForDb(request()->to);
        $from               = setDateForDb(request()->from);
        $status             = isset(request()->status) ? request()->status : null;
        $customer           = isset(request()->customer) ? request()->customer : null;

        $query = User::orderBy('id', 'desc')->select();
        if ($from) {
            $query->whereDate('created_at', '>=', $from);             
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to); 

        }               
        if ($status) {
            $query->where('status','=',$status);
        }
        if ($customer) {
            $query->where('id','=',$customer);
        }

        $customerList = $query->get();
        if ($customerList->count()) {
            foreach ($customerList as $key => $value)
                {
                    $data[$key]['Name']         = $value->first_name." ".$value->last_name;
                    $data[$key]['Email']        = $value->email;
                    $data[$key]['Status']       = $value->status;
                    $data[$key]['Created At']   = dateFormat($value->created_at);
                }
            }
        else {
            $data = null;
        }
        return $data;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Status',
            'Crated at',
        ];
    }
}
