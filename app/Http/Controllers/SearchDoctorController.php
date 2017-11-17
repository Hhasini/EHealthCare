<?php
/**
 * Created by PhpStorm.
 * User: Lihini Avanthika
 * Date: 9/11/2016
 * Time: 7:00 PM
 */
namespace App\Http\Controllers;

class SearchDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('searchDoctor');
    }

}

