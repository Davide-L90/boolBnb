<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feature;

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

        $data = [
            'form_data' => [
                'id' => 'apartment_search_form',
                'class' => 'form-horizontal',
                'action' => route('apartments.results'),
                'method' => 'GET',
                'request_field' => [],
                'chek_notcheck_feat' => $checked_and_notChecked,
            ]
        ];

        return view('publicViews.welcome', ['data' => $data]);
    }
}
