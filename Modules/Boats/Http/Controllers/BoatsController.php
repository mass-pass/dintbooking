<?php

namespace Modules\Boats\Http\Controllers;

use App\Models\Boat;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BoatsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        exit();
        return view('boats::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('boats::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('boats::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('boats::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    private function get_intend_url() {
        $guestDomain = config('services.domain.guest');
        return redirect()->to($guestDomain . "/dashboard"); 
    }

    public function dashboard(Request $request)
    {
        // go to main dashboard
        return $this->get_intend_url();
        
        $data = [
            'title' => "Boats Dashboard"
        ];

        $data['boats'] = Boat::where('owner_id', auth()->id())
            ->latest()
            ->paginate();

        return view('boats::dashboard', $data);
    }

    public function myBoats()
    {
        $data['title'] = "My Boats";
        $data['records'] = Boat::where('owner_id', auth()->id())
            ->latest()
            ->paginate();

        return view('boats::my_boats', $data);
    }
}
