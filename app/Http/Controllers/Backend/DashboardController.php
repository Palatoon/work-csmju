<?php

namespace App\Http\Controllers\Backend;

use App\Area;
use App\Building;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = [];
        $buildings = Building::all();
        foreach ($buildings as $key1 => $value1) {
            $items[$key1] = $value1;
            $items[$key1]->area = Area::where('building_id', $value1->id)->get();
            foreach ($items[$key1]->area as $key2 => $value2) {
                $items[$key1]->area[$key2] = $value2;
                $items[$key1]->area[$key2]->room = Room::where('area_id', $value2->id)->get();
            }
        }
        return view('backend.dashboard.index', [
            'buildings' => $items
        ]);
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
