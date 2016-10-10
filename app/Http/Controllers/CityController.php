<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Square;
use App\Crawler\CrawlerLyon;

use App\Http\Requests;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::paginate(10);
        return view('city.index', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('city.create');
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
            'zip' => 'required'
        ]);

        $city = new City();
        $city->name = ucfirst($request->name);
        $city->slug = str_slug($city->name, '-');
        $city->zip = $request->zip;

        $city->save();

        $request->session()->flash('success', 'La ville a bien été ajouté');
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
        $city = City::find($id);
        return view('city.show', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        return view('city.edit', ['city' => $city]);
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
            'zip' => 'required'
        ]);

        $city = City::find($id);

        if(!$city){

            $request->session()->flash('error', 'La ville n\'éxiste pas');
            return redirect()->back();

        }

        $city->name = ucfirst($request->name);
        $city->slug = str_slug($city->name, '-');
        $city->zip = $request->zip;

        $city->save();

        $request->session()->flash('success', 'La ville a bien été modifiée');
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
        City::find($id)->delete();
        return redirect()->back();
    }

    public function crawler(Request $request, $id)
    {
        
        $city = City::find($id);
        
        if(!$city){

            $request->session()->flash('error', 'La ville n\'éxiste pas');
            return redirect()->back();

        }

        if($city->name == 'Lyon'){

            CrawlerLyon::request(function($square) use ($city){
                

                $isExist = Square::where('slug', '=', str_slug($square->name))->count();
                if(!$isExist){
                    
                    $s = new Square();
                    $s->name   = $square->name;
                    $s->slug   = str_slug($s->name);
                    $s->adress = $square->adress;
                    $s->lat    = $square->lat;
                    $s->lng    = $square->lng;

                    $city->squares()->save($s);

                    $s->save();
                    
                }


            });
            
        }


    }

}
