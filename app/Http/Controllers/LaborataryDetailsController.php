<?php

namespace App\Http\Controllers;

class LaborataryDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('laboratary_details');
    }

}