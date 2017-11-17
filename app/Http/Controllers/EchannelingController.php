<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Doctor;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB as DB;

class EchannelingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $specialisations=DB::table('doctors')
                ->distinct()
                 ->select('specialty')
                 ->get();
       

       return view('echanneling.index',array('specialisations'=>$specialisations));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
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
    

    public function showMoreDoctorSchedules($id=null,$date=null)
	{
            $doctors="";
            if($date!=null){
                $doctors = DB::table('doctors')->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                            ->select('doctors.name','doctors.doctor_id', 'doctors.email', 'doctors.specialty', 'e_schedules.shift_start', 'e_schedules.shift_end', 'e_schedules.schedule_id')
                            ->where('e_schedules.max_bookings', '>',0)
                            ->where('doctors.doctor_id', '=', $id)
                            ->where(DB::raw('DATE(e_schedules.shift_start)'), '=', $date)
                            ->orderby('e_schedules.shift_start')
                            ->get();
            }
            else{
                $doctors = DB::table('doctors')->join('e_schedules', 'doctors.doctor_id', '=', 'e_schedules.doc_id')
                            ->select('doctors.name','doctors.doctor_id', 'doctors.email', 'doctors.specialty', 'e_schedules.shift_start', 'e_schedules.shift_end', 'e_schedules.schedule_id')
                            ->where('e_schedules.max_bookings', '>',0)
                            ->where('doctors.doctor_id', '=', $id)
                            ->orderby('e_schedules.shift_start')
                            ->get();
            }

	return view('echanneling.showMoreDoctorSchedules',array('doctors'=>$doctors));
	}

}
