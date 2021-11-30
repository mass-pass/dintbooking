<?php

namespace App\Exports;

use App\Models\Properties;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PropertiesExport implements FromArray,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $to         = isset(request()->to) ? setDateForDb(request()->to) : null;
        $from       = isset(request()->from) ? setDateForDb(request()->from) : null;
        $status     = isset(request()->status) ? request()->status : null;
        $space_type = isset(request()->space_type) ? request()->space_type : null;
        $properties = $this->getAllProperties();
        
        if (isset($id)) {
            $properties->where('properties.host_id', '=', $id);
        }
        if ($from) {
            $properties->whereDate('properties.created_at', '>=', $from);
        }
        if ($to) {
            $properties->whereDate('properties.created_at', '<=', $to);
        }
        if ($status) {
            $properties->where('properties.status', '=', $status);
        }
        if ($space_type) {
            $properties->where('properties.space_type', '=', $space_type);
        }
        $propertyList = $properties->get();
        if ($propertyList->count()) {
            foreach ($propertyList as $key => $value) {
                    $data[$key]['Name']         = $value->property_name;
                    $data[$key]['Host Name']    = $value->host_name;
                    $data[$key]['Space Type']   = $value->Space_type_name;
                    $data[$key]['Status']       = $value->property_status;
                    $data[$key]['Date']         = dateFormat($value->property_created_at);
            }
        } else {
            $data = null;
        }

        return $data;
    }

    public function getAllProperties()
    {
        $query = Properties::join('users', function ($join) {
            $join->on('users.id', '=', 'properties.host_id');
        })
            ->join('space_type', function ($join) {
                    $join->on('space_type.id', '=', 'properties.space_type');
            })

            ->select(['properties.id as properties_id', 'properties.name as property_name', 'properties.status as property_status', 'properties.created_at as property_created_at', 'properties.updated_at as property_updated_at','space_type.name as Space_type_name' , 'properties.*', 'users.*', 'space_type.*'])
            ->orderBy('properties.id', 'desc');
            return $query;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Host Name',
            'Space Type',
            'Status',
            'Date'
        ];
    }
}
