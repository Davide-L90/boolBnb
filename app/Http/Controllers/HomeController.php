<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feature;
use App\Model\Apartament;
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
        $apartments = $apartments->whereHas('advertisements', function($query){
            $query->where('valid_until', '>', Carbon::now());
        })->get();
        /* dd($checked_and_notChecked); */

        return view('publicViews.welcome', [
            'check_not_check' => $checked_and_notChecked,
            'apartments_advertised' => $apartments
        ]);
    }
}
