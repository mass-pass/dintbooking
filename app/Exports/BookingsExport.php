<?php

namespace App\Exports;

use App\Models\Bookings;
use DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class BookingsExport implements FromArray,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $to                 = setDateForDb(request()->to);
        $from               = setDateForDb(request()->from);
        $status             = isset(request()->status) ? request()->status : null;
        $property           = isset(request()->property) ? request()->property : null;
        $customer           = isset(request()->customer) ? request()->customer : null;
        $bookings           = $this->getAllBookingsCSV();
        if (isset($id)) {
            $bookings->where('bookings.user_id', '=', $id);
        }
        if ($from) {
            $bookings->whereDate('bookings.created_at', '>=', $from);
        }

        if ($to) {
            $bookings->whereDate('bookings.created_at', '<=', $to);
        }
        if ($property) {
            $bookings->where('bookings.property_id', '=', $property);
        }
        if ($customer) {
            $bookings->where('bookings.user_id', '=', $customer);
        }
        if ($status) {
            $bookings->where('bookings.status', '=', $status);
        }
        $bookingList = $bookings->get();
        if ($bookingList->count()) {
            foreach ($bookingList as $key => $value) {
                    $data[$key]['Host Name']     = $value->host_name;
                    $data[$key]['Guest Name']    = $value->guest_name;
                    $data[$key]['Property Name'] = $value->property_name;
                    $data[$key]['Currency']      = $value->currency_name;
                    $data[$key]['Total Amount']  = $value->total_amount;
                    $data[$key]['Payouts'] = ($value->check_host_payout == "yes") ? "Yes" : "No";

                if ($value->status == 'Accepted') {
                    $status = 'Accepted';
                } elseif ($value->status == 'Pending') {
                    $status = 'Pending';
                } else {
                    if ($value->check_guest_payout == 'yes') {
                        $status = $value->status." (Refund)";
                    } else {
                        $status = $value->status;
                    }
                }
                    $data[$key]['Status']       = $status;
                    $data[$key]['Date']         = dateFormat($value->created_at);
            }
        } else {
            $data = null;
        }

        return $data;
    }

    public function getAllBookingsCSV()
    {
        $allBookings = Bookings::join('properties', function ($join) {
            $join->on('properties.id', '=', 'bookings.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'bookings.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'bookings.currency_code');
        })
        ->leftJoin('users as u', function ($join) {
                $join->on('u.id', '=', 'bookings.host_id');
        })
        ->select(['bookings.id as id', 'u.first_name as host_name', 'users.first_name as guest_name', 'properties.name as property_name', DB::raw('bookings.total AS total_amount'), 'bookings.currency_code as currency_name','bookings.status', 'bookings.created_at as created_at', 'bookings.updated_at as updated_at', 'bookings.start_date', 'bookings.end_date', 'bookings.guest', 'bookings.host_id', 'bookings.user_id', 'bookings.total', 'bookings.currency_code', 'bookings.service_charge', 'bookings.host_fee'])
        ->orderBy('bookings.id', 'desc');
        return $allBookings;
    }

    public function headings(): array
    {
        return [
            'Host Name',
            'Guest Name',
            'Property Name',
            'Currency',
            'Total Amount',
            'Payouts',
            'Status',
            'Date',
        ];
    }
}
