<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VisitorDatatable;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VisitorDatatable $dataTable)
    {
        return $dataTable->render('admin.visitors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $visitor = Visitor::with('visitorSearches')->findOrFail($id);
        return view('admin.visitors.show',compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Visitor::where('id',$id)->delete();
        $this->helper->one_time_message('success', 'Deleted Successfully');
        return redirect('admin/visitors');
    }
}
