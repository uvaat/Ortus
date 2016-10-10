<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\EquipmentType;

use App\Http\Requests;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::paginate(10);
        return view('equipment.index', ['equipments' => $equipments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipmentTypes = EquipmentType::all();
        return response()->view('equipment.create', ['equipmentTypes' => $equipmentTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'equipmentType' => 'required',
        ]);

        $equipment = new Equipment();
        $equipmentType = EquipmentType::find($request->equipmentType);

        if(!$equipmentType){

            $request->session()->flash('error', 'Le type d\'équipement n\'existe pas');
            return redirect()->back();

        }

        $equipment->name = ucfirst($request->name);
        $equipment->slug = str_slug($equipment->name, '-');

        $equipmentType->equipments()->save($equipment);

        $equipment->save();

        $request->session()->flash('success', 'L\'équipement à bien été créé');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipment = Equipment::find($id);
        return view('equipment.show', ['equipment' => $equipment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = Equipment::find($id);
        $equipmentTypes = EquipmentType::all();
        return view('equipment.edit', ['equipment' => $equipment, 'equipmentTypes' => $equipmentTypes]);
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'equipmentType' => 'required',
        ]);

        $equipment = Equipment::find($id);
        $equipmentType = EquipmentType::find($request->equipmentType);

        if(!$equipmentType){

            $request->session()->flash('error', 'Le type d\'équipement n\'existe pas');
            return redirect()->back();

        }

        if(!$equipment){

            $request->session()->flash('error', 'L\'équipement n\'existe pas');
            return redirect()->back();

        }

        $equipment->name = ucfirst($request->name);
        $equipment->slug = str_slug($equipment->name, '-');

        $equipmentType->equipments()->save($equipment);

        $request->session()->flash('success', 'L\'équipement à bien été créé');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Equipment::find($id)->delete();
        return redirect()->back();
    }
}
