<?php

namespace App\Http\Controllers\Backend;

use App\AnimalAttribute;
use App\AnimalType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class AnimalAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.animalattribute.index', [
            'animalattribute' => AnimalAttribute::all(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.animalattribute.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //dd($request->all())
        if ($request->has('id')) {
            $animalattribute= AnimalAttribute::find($request->id);
            $animalattribute->name = $request->name;
            $animalattribute->name_en = $request->name_en;
            $animalattribute->unit = $request->unit;
            $animalattribute->update();
            $notification = array(
                'message' => 'The data was updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('animalattribute.index')->with($notification);
        } else {
            $animalattribute = new AnimalAttribute();
            $animalattribute->name = $request->name;
            $animalattribute->name_en = $request->name_en;
            $animalattribute->unit = $request->unit;
            $animalattribute->save();
            $notification = array(
                'message' => 'The data was created successfully.',
                'alert-type' => 'success'
            );
        }
        return redirect()->route('animalattribute.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animalattribute = AnimalAttribute::find($id);
        return view('backend.animalattribute.form', compact('animalattribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnimalAttribute $animalattribute)
    {
        $animalattribute->delete();

        return redirect()->route('animalattribute.index');
    }
    public function delete(Request $request)
    {
        $animalattribute = Animalattribute::find($request->id);
        if ($animalattribute->delete()) {
            $notification = array(
                'message' => 'The data was deleted successfully.',
                'type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'The data was delete failed.',
                'type' => 'error'
            );
        }

        return response()->json($notification);
    }

    public function deleteByAjax(Request $request)
    {
        $animalattribute = AnimalAttribute::find($request->id);
        if ($animalattribute && $animalattribute->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    
    }

}