<?php
/**
 * Created by PhpStorm.
 * User: Lihini Avanthika
 * Date: 9/16/2016
 * Time: 2:23 PM
 */
namespace App\Http\Controllers;

class MedicalCheckupController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('medicalCheckup');
    }

}