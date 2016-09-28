<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Square;
use App\City;

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
        return response()->view('square.create', ['cities' => $cities]);
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
        $city = City::find($request->city);

        if(!$city){

            $request->session()->flash('error', 'La ville n\'éxiste pas');
            return redirect()->back();

        }

        $square->name = $request->name;
        $square->lat = $request->lat;
        $square->lng = $request->lng;

        $city->squares()->save($square);

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
        return view('square.edit', ['square' => $square, 'cities' => $cities]);
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
