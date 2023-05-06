<?php

namespace App\Http\Controllers\Backend;

use App\AnimalAttribute;
use App\AnimalType;
use App\TypeAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Room;

class TypeAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.animalType.index', [
            // 'attributes' => TypeAttribute::all(),
            // 'animaltype' => AnimalType::all(),
            // 'animalattribute' => AnimalAttribute::all(),
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
        //  dd($request->all());
        if ($request->attr) {
           
            foreach ($request->attr as $item) {
                 $ta = new TypeAttribute();
                $ta->animal_types_id = $request->animal_id;
                $ta->animal_attributes_id = $item;
                $ta->save();
            }
            return redirect()->route('animal-type.index');
        }

        // $animaltypes = AnimalType::all($request->animaltypes);
        // $animalattributes = AnimalAttribute::all($request->animalattributes);
        
        // if($request->has('id')){
        //     $typeattribute = TypeAttribute::find($request->id);
        //     $typeattribute->animal_types_id = $request->animal_types_id;
        //     $typeattribute->animal_attributes_id = $request->animal_attribute_id;
        //     $typeattribute->update();
        // }else{
        //     $typeattribute = TypeAttribute::find($request->id);
        //     $typeattribute->animal_types_id = $request->id;
        //     $typeattribute->animal_attributes_id = $request->id;
        //     $typeattribute->save();
        // }
        //  return redirect()->route('typeattribute.index');
       
        // $animal_id = $request->get("animal_id");
        // $typeattribute = \App\AnimalType::find($request->id);
        // foreach ($request->get('attr') as $key => $value) {
        //     $typeattribute->typeAttribute()->attach($request->attr);
        //     $typeattribute->save();
        // return redirect()->route('typeattribute.index');
// }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeAttribute  $typeAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeAttribute  $typeAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
        // $attributeForType = TypeAttribute::where('animal_types_id', $id)->get();
        // return view('backend.animalType.index', ['attributeForType' => $attributeForType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeAttribute  $typeAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeAttribute $typeAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeAttribute  $typeAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeAttribute $typeAttribute)
    {
        //
    }
}
