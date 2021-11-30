<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\HostPenaltyDataTable;
use App\DataTables\GuestPenaltyDataTable;
use App\Models\Penalty;
use Validator;
use App\Http\Helpers\Common;

class PenaltiesController extends Controller
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function host_penalty(HostPenaltyDataTable $dataTable)
    {
        return $dataTable->render('admin.penalty.host');
    }

    public function guest_penalty(GuestPenaltyDataTable $dataTable)
    {
        return $dataTable->render('admin.penalty.guest');
    }
}
