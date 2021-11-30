<?php

namespace App\Exports;

use App\Models\Reviews;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ReviewsExport implements FromArray,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $to                 = request()->to;
        $from               = request()->from;
        $reviewer = isset(request()->reviewer) ? request()->reviewer : null;
        $property = isset(request()->property) ? request()->property : null;
        $reviews           = $this->getAllReviews();
        if ($from) {
            $reviews->whereDate('reviews.created_at', '>=', $from);
        }
        if ($to) {
            $reviews->whereDate('reviews.created_at', '<=', $to);
        }
        if ($property) {
            $reviews->where('properties.id', '=', $property);
        }
        if ($reviewer) {
            $reviews->where('reviews.reviewer', '=', $reviewer);
        }

        $reviewList = $reviews->get();
        if ($reviewList->count()) {
            foreach ($reviewList as $key => $value) {
                    $data[$key]['Property Name'] = $value->property_name;
                    $data[$key]['Sender']        = $value->sender;
                    $data[$key]['Receiver']      = $value->receiver;
                    $data[$key]['Reviewer']      = $value->reviewer;
                    $data[$key]['Message']       = $value->message;
                    $data[$key]['Date']          = dateFormat($value->created_at);
            }
        } else {
            $data = null;
        }

        return $data;
    }

    public function getAllReviews()
    {
        $reviews = Reviews::join('properties', function ($join) {
            $join->on('properties.id', '=', 'reviews.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'reviews.sender_id');
        })
        ->join('users as receiver', function ($join) {
                $join->on('receiver.id', '=', 'reviews.receiver_id');
        })
        ->select(['reviews.id as id', 'booking_id', 'properties.name as property_name', 'properties.id as property_id', 'users.first_name as sender', 'receiver.first_name as receiver', 'reviewer', 'message', 'reviews.created_at as created_at', 'reviews.updated_at as updated_at'])
        ->orderBy('reviews.id', 'desc');
        return $reviews;
    }

    public function headings(): array
    {
        return [
            'Property Name',
            'Sender',
            'Receiver',
            'Reviewer',
            'Message',
            'Date'
        ];
    }
}
