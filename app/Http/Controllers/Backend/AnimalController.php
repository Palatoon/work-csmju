<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use App\Animal;
use App\AnimalAttribute;
use App\AnimalType;
use App\TypeAttribute;
use App\AnimalAttributeValue;
use App\AnimalHistory;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Component\VarDumper\Cloner\Data;

class AnimalController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->all());
        $animal = Animal::where('type_id', $request->type)->get();
        $animall  = Animal::select('animals.*', 'animal_types.name as name_type', 'animal_types.name_en as name_en_type')
            ->join('animal_types', 'animal_types.id', '=', 'animals.type_id')
            ->where('type_id', $request->type)
            ->get();
        return view('backend.animalAll.index', [
            'animal' => $animal,
            'type' => $request->type,
            'animall' => $animall,
        ]);
    }

    public function indexForm()
    {
        $animalTypes = DB::table('animal_types')->get();

        //dd($typeAttributes);
        return view('backend.animalAll.form', [
            'animaltype' =>  $animalTypes
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $typeAttributes = [];
        $animalTypes = DB::table('animal_types')->get();
        if ($request->has('type_id')) {
            // $typeAttributes = DB::table('type_attributes', $request->attribute) ->leftJoin('animal_types', function ($join) {
            //     $join->on('animal_types.id', '=', 'type_attributes.animal_types_id');
            // })
            // ->leftJoin('animal_attributes', function ($join) {
            //     $join->on('animal_attributes.id', '=', 'type_attributes.animal_attributes_id');
            // }) ->select(
            //     'animal_types.name',
            //     'animal_types.name_en',
            //     'animal_attributes.animal_attributes_name',
            //     'animal_attributes.animal_attributes_name_en',
            //     'animal_attributes.animal_attributes_unit',
            //     'animal_types.id'
            // )
            // ->get();
            $arr = TypeAttribute::where('animal_types_id', $request->type_id)->get();
            foreach ($arr as $key => $value) {
                $typeAttributes[] = AnimalAttribute::find($value->animal_attributes_id);
            }
            //dd( $typeAttributes);
        }
        //$animal = Animal::where('type_id', $request->type_id)->get();

        //->leftJoin('animal_types', 'animal_types.id', 'type_attributes.animal_types_id')
        //->leftJoin('animal_attributes', 'animal_attributes.id', 'type_attributes.animal_attributes_id')

        return view('backend.animalAll.form', [
            'animaltype' =>  $animalTypes,
            'attributes' => $typeAttributes,
            'type_attributes', $request->attribute,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $name_en = $request->name_en;
        $type_id = $request->animal_type;

        // Save animal name first.
        $animal = new Animal();
        $animal->name = $name;
        $animal->name_en = $name_en;
        $animal->type_id = $type_id;
        $animal->save();

        // After that save animal attrubutes value
        $arr = $request->values;
        $arr_length = count($arr);
        for ($i = 0; $i < $arr_length; $i++) {
            $att_id = array_keys($arr)[$i];
            $value = array_values($arr)[$i];
            $att_value = new AnimalAttributeValue();
            $att_value->animal_id = $animal->id;
            $att_value->animal_attributes_id = $att_id;
            $att_value->value = $value;
            $att_value->save();
        }

        $notification = array(
            'message' => 'The data was created successfully.',
        );

        return redirect()->route('animalall.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $animal = Animal::find($id);
        // $animaltype  = AnimalType::find($id);
        // $attributes = AnimalAttribute::find($id);
        // return response()->json([
        //     "animal" => $animal,
        //     "animaltype" => $animaltype,
        //     "attributes" => $attributes,
        // ]);
        $data = [];
        $animal = Animal::find($id);
        $data = Animal::find($id)->join('animal_attribute_values', 'animal_attribute_values.animal_id', '=', 'animals.id')->get();
        // $data  = AnimalType::find($id);
        // $data = AnimalAttribute::find($id);
        return response()->json([
            "animal" => $animal,
            "data" => $data,
        ]);
        // return view('backend.animalAll.form', compact('animal', 'animaltype', 'attributes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $animal = Animal::with(['attributes.attribute', 'type'])->where('id', $id)->first();
        $animal_data_test = [];
        foreach ($animal->attributes as $attribute) {
            $animal_data1[] = [
                'attributes_id' => $attribute->id,
                'animal_attributes_id' => $attribute->animal_attributes_id,
                'animal_id' => $attribute->animal_id,
                'animal_type_id' => $animal->type->id,
                'animal_name' => $animal->name,
                'animal_name_en' => $animal->name_en,
                'type_name' => $animal->type->name,
                'type_name_en' => $animal->type->name_en,
                'animal_attributes_name' => $attribute->animal_attributes_name,
                'attribute_value' => $attribute->value
            ];
        }
        

        $animal_id = 0;
        // dd();
        foreach ($animal_data1 as $item) {
            $animal_id = $item['animal_id'];
            if (!isset($animal_data[$animal_id])) {
                $animal_data[$animal_id] = [
                    "attributes_id" => $item['attributes_id'],
                    "animal_id" => $item['animal_id'],
                    "animal_type_id" => $item['animal_type_id'],
                    "animal_name" => $item['animal_name'],
                    "animal_name_en" => $item['animal_name_en'],
                    "type_name" => $item['type_name'],
                    "type_name_en" => $item['type_name_en'],
                    "animal_attributes" => [],
                ];
            }
            
            $animalAttribute = AnimalAttribute::find($item['animal_attributes_id']);

            $animal_data4[$animal_id]['animal_attributes'][] = [
                "animal_attributes_id" => $item['animal_attributes_id'],
                "animal_attributes_name" => $animalAttribute == null ? '' : $animalAttribute,
                "animal_attributes_name_en" => $animalAttribute == null ? '' : $animalAttribute->name_en,
                "attribute_value" => $item['attribute_value'],
            ];
            
            $last_index = count($animal_data4[$animal_id]['animal_attributes']);
            $last_index = $last_index == 0 ? 0 : $last_index -1;
            
            $animal_data[$animal_id]['animal_attributes'][] = [
                "animal_attributes_id" => $item['animal_attributes_id'],
                "animal_attributes_name" => $animalAttribute == null ? '' : $animal_data4[$animal_id]['animal_attributes'][$last_index]['animal_attributes_name']->animal_attributes_name,
                "attribute_value" => $item['attribute_value'],
            ];
        }
        return view('backend.animalAll.edit', compact('animal_data', 'animal_id'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();

        return redirect()->route('animal.index');
    }
    public function delete(Request $request)
    {
        $animal = Animal::find($request->id);
        if ($animal->delete()) {
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

    public function get_attribute(Request $request)
    {
        $typeAttributes = [];
        $arr = TypeAttribute::where('animal_types_id', $request->type_id)->get();
        foreach ($arr as $key => $value) {
            $typeAttributes[] = AnimalAttribute::find($value->animal_attributes_id);
        }
        return response()->json($typeAttributes);
    }
    public function get_attribute_value(Request $request)
    {
        $data = AnimalType::select('id')->get();
        return response()->json([
            "data" => $data
        ]);
    }
}
