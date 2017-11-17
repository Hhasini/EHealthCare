<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organ;
use DB;
use Session;

class OrganController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $organ = Organ::all();
        return \view('organ.index', compact('organ'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('organ.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {

        $input = $request->all();
        $id = $request->input('id');
        $max = Organ::where('id', $id)->max('updated_at');
        if ($max != null) {
            return \view('organ.error')->with('id', $id);
        } else {
            $create = Organ::create($input);
            return redirect('organs');
        }



        //Session::flash('flash_message', 'Doctor Added Successfully!');
        //$successmessage ='you have been successfully logged in!';
        //$request->session()->flash('success', $successmessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $organ = Organ::find($id);
        return \view('organ.show', compact('organ'));
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
//
    }

}
