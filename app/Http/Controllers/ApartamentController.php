<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Apartament;
use App\Model\Feature;
use Illuminate\Support\Facades\Auth;

class ApartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $request->validate([
            'address' => 'required|string|max:255'
            ]);
            
        $apartments = new Apartament();
        
        $address_searched = $request->address;
        
        if (!empty($request->beds_number)) {        
            $apartments = $apartments->where('beds_number', '>=', $request->beds_number);
        }
        if (!empty($request->bathrooms_number)) {        
            $apartments = $apartments->where('bathrooms_number', '>=', $request->bathrooms_number);
        }
        if (!empty($request->features)) {
            
            $featuresDB = Feature::all();

            foreach ($request->features as $featureId) {
                
                if($featuresDB->contains('id', $featureId))
                {
                    $apartments = $apartments->whereHas('features', function ($query) use($featureId) {
                        $query->where('feature_id', $featureId);
                    });
                }
                else
                {
                    return view('publicViews.welcome', ['features' => $featuresDB]);
                }
            }
        }
        /* $apartments = $apartments->where('bathrooms_number', $request->features); */
        /* dd($apartments); */

        $apartments = $apartments->get();

        $distanceToSearch = 20; //Distance search default value
        
        if(!empty($request->distance))
        {
            $distanceToSearch = $request->distance;
        }
        
        $apartmentsToShow = [];
        

        foreach ($apartments as $apartment) {
            $distance = $this->distance($request->lat, $request->lng, $apartment['latitude'], $apartment['longitude']);
            
            if($distance < $distanceToSearch){
               
                $apartmentsToShow[] = [
                    'apartment' => $apartment,
                    'distance' => $distance
                ];
            }
        }

        //Sort result by distance
        usort($apartmentsToShow, function($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });
        
        return view('publicViews.apartmentFinder', [
            'apartmentsToShow' => $apartmentsToShow,
            'address_searched' => $address_searched]);
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
        $userId = Auth::user()->id;
        
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
        $new_apartment->user_id = $userId;

        $features = $request->features;

        $new_apartment->save();
                
        $new_apartment->features()->sync($features);

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
        
        $request->validate([
            'title' => 'required|string|max:255',
            'beds_number' => 'required|integer|min:1',
            'bathrooms_number' => 'required|integer|min:1',
            'price' => 'required|integer|min:1'
        ]);

        $modified_apartment = Apartament::find($id);
        /*
            If isActive exist the update method will change only this value, otherwise
            all other fields will be update
        */
        if (!($request->has('isActive'))) {
            $requestArray = $request->toArray();
            $modified_apartment->fill($requestArray);  
            $modified_apartment->is_advertised = 0;
            $modified_apartment->latitude = $request->lat;
            $modified_apartment->longitude = $request->lng;
        } else {
            $modified_apartment->is_active = $request->isActive;  
        }
        
        $features = $request->features;

        $modified_apartment->save();

        $modified_apartment->features()->sync($features);

        return redirect()->route('home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment_to_delete = Apartament::find($id);

        $apartment_to_delete->features()->detach(); //Reletions into pivot table will be delete
        $apartment_to_delete->delete();

        return redirect()->route('home');
    }

    // Method to calculate distance between two point by lat and lng
    public function distance($lat1, $lon1, $lat2, $lon2) {
       
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lon1 *= $pi80;
        $lat2 *= $pi80;
        $lon2 *= $pi80;
    
        $r = 6372.797; // mean radius of Earth in km
        $r_meters = $r * 1000;
        $dlat = $lat2 - $lat1;
        $dlon = $lon2 - $lon1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        
        $km = $r * $c;
        
        return $km;
    }
}
