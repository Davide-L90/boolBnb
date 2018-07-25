<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Feature;

class HomeController extends Controller
{
    public function index()
    {
        $features = Feature::all();

        return view('publicViews.welcome', ['features' => $features]);
    }
}
