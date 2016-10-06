<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Square;
use App\City;
use App\Equipment;

use App\Http\Requests;

class SquareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $squares = Square::paginate(10);
        return view('square.index', ['squares' => $squares]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $equipments = Equipment::all();
        return response()->view('square.create', [
            'cities' => $cities,
            'equipments' => $equipments
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
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'lat' => 'required',
            'lng' => 'required',
            'city' => 'required',
        ]);

        $square = new Square();

        $square->name = $request->name;
        $square->lat = $request->lat;
        $square->lng = $request->lng;

        $city = City::find($request->city);
        if(!$city){

            $request->session()->flash('error', 'La ville n\'éxiste pas');
            return redirect()->back();

        }

        $city->squares()->save($square);
        
        $square->save();

        if($request->equipments){

            foreach ($request->equipments as $equipmentId) {
                
                $equipment = Equipment::find($equipmentId);
                if(!$equipment){
                    
                    $request->session()->flash('error', 'Un des équipements n\'éxiste pas');
                    return redirect()->back();

                }

                $square->equipments()->attach($equipment);

            }
            
        }

        $request->session()->flash('success', 'Le square a bien été ajouté');
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
        $square = Square::find($id);
        return view('square.show', ['square' => $square]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $square = Square::find($id);
        $cities = City::all();
        $equipments = Equipment::all();
        $equipmentIds = array();

        if($square->equipments){
            foreach ($square->equipments as $equipment) {
                $equipmentIds[] = $equipment->id;
            }
        }

        return view('square.edit', [
            'square' => $square,
            'cities' => $cities,
            'equipmentIds' => $equipmentIds,
            'equipments' => $equipments
            ]);
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
            'lat' => 'required',
            'lng' => 'required',
            'city' => 'required',
        ]);

        $square = Square::find($id);
        $city = City::find($request->city);
        
        if(!$city){

            $request->session()->flash('error', 'La ville n\'éxiste pas');
            return redirect()->back();

        }

        if(!$square){

            $request->session()->flash('error', 'Le square n\'éxiste pas');
            return redirect()->back();

        }

        $square->name = $request->name;
        $square->lat = str_replace(',', '.', $request->lat);
        $square->lng = str_replace(',', '.', $request->lng);

        $square->save();
        $city->squares()->save($square);

        $square->equipments()->detach();

        if($request->equipments){

            foreach ($request->equipments as $equipmentId) {
                
                $equipment = Equipment::find($equipmentId);
                if(!$equipment){
                    
                    $request->session()->flash('error', 'Un des équipements n\'éxiste pas');
                    return redirect()->back();

                }

                $square->equipments()->attach($equipment);

            }
            
        }

        $request->session()->flash('success', 'Le square a bien été modifié');
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
        $square = Square::find($id)->delete();
        return redirect()->back();
    }
}
