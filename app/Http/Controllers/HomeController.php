<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feature;
use App\Model\Apartament;
use App\Model\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::all();

        $checked_and_notChecked = [];

        foreach ($features as $feature) {
            
            $temp = [
                'id' => $feature['id'],
                'name' => $feature['name'],
                'isChecked' => false
            ];

            $checked_and_notChecked[] = $temp;

        }

        $apartments = new Apartament();
        $apartments = $apartments->where('is_active', 1);
        $apartments = $apartments->whereHas('advertisements', function($query){
            $query->where('valid_until', '>', Carbon::now());
        })->get();        

        $aprtmentsToShow = [];

        if ($apartments->isNotEmpty()) {
            foreach ($apartments as $apartment) {

                $thumbnail = $this->setThumbnail($apartment->id);
    
                $apartmentsToShow[] = [
                    'apartment' => $apartment,
                    'distance' => -1,
                    'thumbnail' => $thumbnail,
                    'is_advertised' => false
                ];
            }
        } else {
            $apartmentsToShow[] = [
                'apartment' => [],
                'distance' => 0,
                'thumbnail' => [],
                'is_advertised' => false
            ];
        }        

        return view('publicViews.welcome', [
            'check_not_check' => $checked_and_notChecked,
            'apartmentsToShow' => $apartmentsToShow
        ]);
    }

    //Method to find the apartment thumbnail.
    private function setThumbnail($apartment_id){
        $thumbnail = Image::where('apartament_id', $apartment_id)->first();
    
        if( !(is_null($thumbnail))  && (Storage::disk('public')->exists($thumbnail->filename)) ){
                $thumbnail = $thumbnail->filename;     
            }
        else{
            $thumbnail = 'placeholder.jpg';
        }

        return $thumbnail;
    }
}
