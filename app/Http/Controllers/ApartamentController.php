<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Apartament;

class ApartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request); */
        
        $request->validate([
            'title' => 'required|string|max:255',
            'beds_number' => 'required|integer|min:1',
            'bathrooms_number' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);

        $requestArray = $request->toArray();

        $new_apartment = new Apartament();
        $new_apartment->fill($requestArray);  
        $new_apartment->is_active = 1;
        $new_apartment->is_advertised = 0;
        $new_apartment->latitude = $request->lat;
        $new_apartment->longitude = $request->lng;

        $new_apartment->save();

        return redirect()->route('home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
