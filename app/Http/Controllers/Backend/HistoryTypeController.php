<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use App\HistoryType;
use Illuminate\Http\Request;

class HistoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historytype = HistoryType::all();
        return view('backend.history_type.index', [
            'historytype' => $historytype
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.history_type.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('id')) {
            $h = HistoryType::find($request->id);
            $h->name = $request->name;
            $h->detail = $request->detail;
            $h->type = 'NULL';
            $h->update();
            $notification = array(
                'message' => 'The data was updated successfully.',
                'alert-type' => 'success'
            );
        } else {
            $h = new HistoryType();
            $h->name = $request->name;
            $h->detail = $request->detail;
            $h->type = 'NULL';
            $h->save();

            //dd($user->id);
            $notification = array(
                'message' => 'The data was created successfully.',
            );
        }
        return redirect()->route('historytype.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HistoryType  $historyType
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryType $historyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoryType  $historyType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $historytype = HistoryType::find($id);
        return view('backend.history_type.form', compact('historytype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoryType  $historyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryType $historyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoryType  $historyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryType $historytype)
    {
        $historytype->delete();

        return redirect()->route('historytype.index');
    }
    public function delete(Request $request)
    {
        $historytype = HistoryType::find($request->id);
        if ($historytype->delete()) {
            return 'true';
            $notification = array(
                'message' => 'The data was deleted successfully.',
                'type' => 'success'
            );
        } else {
            return 'false';
            $notification = array(
                'message' => 'The data was delete failed.',
                'type' => 'error'
            );
        }

        //return response()->json($notification);
    }
}
