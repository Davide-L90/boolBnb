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
        /* dd($apartments); */
        $data = [
            'form_data' => [
                'id' => 'apartment_search_form',
                'class' => [
                    'form' => 'form-horizontal filter_form_validation',
                    'field_cnt' => 'col-md-8',
                    'label' => '',
                    'input_cnt' => '',
                    'input' => '',
                    'filter_cnt' => '',
                    'check_label' => '',
                    'check_input' => ''
                ],
                'action' => route('apartments.results'),
                'method' => 'GET',
                'request_field' => [],
                'chek_notcheck_feat' => $checked_and_notChecked,
            ]
        ];

        return view('publicViews.welcome', ['data' => $data]);
    }
}
