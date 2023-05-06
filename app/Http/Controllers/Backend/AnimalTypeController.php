<?php

namespace App\Http\Controllers\Backend;

use App\AnimalAttribute;
use App\Http\Controllers\Controller as Controller;
use App\AnimalType;
use App\Http\Controllers\Backend\AnimaltypeController as BackendAnimaltypeController;
use App\TypeAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimaltypeController extends Controller
{
    public function index()
    {
        $typeAttributes = DB::table('type_attributes')
            ->leftJoin('animal_types', function ($join) {
                $join->on('animal_types.id', '=', 'type_attributes.animal_types_id');
            })
            ->leftJoin('animal_attributes', function ($join) {
                $join->on('animal_attributes.id', '=', 'type_attributes.animal_attributes_id');
            })
            //->leftJoin('animal_types', 'animal_types.id', 'type_attributes.animal_types_id')
            //->leftJoin('animal_attributes', 'animal_attributes.id', 'type_attributes.animal_attributes_id')
            ->select(
                'animal_types.name',
                'animal_types.name_en',
                'animal_attributes.animal_attributes_name',
                'animal_attributes.animal_attributes_name_en',
                'animal_attributes.animal_attributes_unit',
                'animal_types.id'
            )
            ->get();

        $animalTypes = DB::table('animal_types')->get();

        // $animaltype = new AnimalType();
        // $animaltype->type = AnimalType::all();
        // $animaltype->attr = $typeAttributes;
        // dd($animaltype);


        //dd($typeAttributes);
        return view('backend.animalType.index', [
            //'animaltype' => AnimalType::all(),
            'animaltype' =>  $animalTypes,
            'attributes' => $typeAttributes,
            'animalattribute' => AnimalAttribute::all(),
            // 'typeattribute' => TypeAttribute::all(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.animalType.form');
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
            $animaltype = AnimalType::find($request->id);
            $animaltype->name = $request->name;
            $animaltype->name_en = $request->name_en;
            $animaltype->update();
            $notification = array(
                'message' => 'The data was updated successfully.',
                'alert-type' => 'success'
            );
        } else {
            $animaltype = new AnimalType();
            $animaltype->name = $request->name;
            $animaltype->name_en = $request->name_en;
            $animaltype->save();

            //dd($user->id);
            $notification = array(
                'message' => 'The data was created successfully.',
            );
        }
        return redirect()->route('animal-type.index')->with($notification);
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
        $animaltype = AnimalType::find($id);
        // return view('backend.animalType.form', compact('animaltype'));
        return view('backend.animalType.edit', compact('animaltype'));
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
    public function destroy(AnimalType $animaltype)
    {
        $animaltype->delete();

        return redirect()->route('animal-type.index');
    }
    public function delete(Request $request)
    {
        $animaltype = Animaltype::find($request->id);
        if ($animaltype->delete()) {
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
        //dd($admin);
        $animaltype = AnimalType::find($request->id);
        if ($animaltype && $animaltype->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
