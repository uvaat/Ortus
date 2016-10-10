<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EquipmentType;

use App\Http\Requests;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = EquipmentType::paginate(10);
        return view('equipment-type.index', ['equipments' => $equipments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('equipment-type.create');
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
        ]);

        $equipment = new EquipmentType();
        $equipment->name = ucfirst($request->name);
        $equipment->slug = str_slug($equipment->name, '-');

        $equipment->save();

        $request->session()->flash('success', 'Le type a bien été ajouté');
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
        $equipment = EquipmentType::find($id);
        return view('equipment-type.show', ['equipment' => $equipment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipment = EquipmentType::find($id);
        return view('equipment-type.edit', ['equipment' => $equipment]);
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
        ]);

        $equipment = EquipmentType::find($id);

        if(!$equipment){

            $request->session()->flash('error', 'Le type d\'équipement n\'éxiste pas');
            return redirect()->back();

        }

        $equipment->name = ucfirst($request->name);
        $equipment->slug = str_slug($equipment->name, '-');
        $equipment->save();

        $request->session()->flash('success', 'Le type à bien été modifier');
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
        EquipmentType::find($id)->delete();
        return redirect()->back();
    }
}
