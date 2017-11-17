<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

	public function __construct()
	{
		$this->middleware('guest');
	}

	public function index()
	{
		return view('admin_panel');
	}
}
