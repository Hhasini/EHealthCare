<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB as DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Patient;
use Session;

class PatientController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
         $user_id=\Auth::user()->user_id;
         $patients = DB::table('patients')
                 ->select('name', 'address', 'email','phone','id','nic','dob','sex')
                 ->where('member_id','=',$user_id)
                 ->get();
         
	return view('patients.index', array('patients' => $patients));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        //$acc_head = User::lists('name', 'designation');

        
        
        $this->validate($request, [
           
            'member_id' => 'required',
            'name' => 'required|regex:/^[a-z A-Z,.\'-]+$/i',
            'nic' => 'required|min:10',
            'dob' => 'required',
            'email' => 'required|email', 
            'address' => 'required',
            'phone' => 'required|min:10',
            'sex' => 'required'
           
                
        ]);
        
        $nic=$request->input('nic');
        $patients_check = DB::table('patients')
                 ->where('nic','=',$nic)
                 ->get();
        
        $user_id=\Auth::user()->user_id;
        $patients = DB::table('patients')
                 ->select('id','name', 'address', 'email','phone','nic')
                 ->where('member_id','=',$user_id)
                 ->get();
        
        if(!empty($patients_check))
        {
             Session::flash('flash_error', 'This nic is already in use by some one else! Please enter the correct nic');
             return redirect()->back();
             
        }
        
        else{
        
        $input = $request->all();

        Patient::create($input);
        
        Session::flash('flash_message', 'Your Patient details are successfully added!');
        }
        return redirect()->back();
//        return view('patients.index', array('patients' => $patients));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
	{
		$patient = Patient::find($id);
                $appointments=DB::table('bookings')->join('e_schedules', 'bookings.schedule_id', '=', 'e_schedules.schedule_id')
                        ->join('doctors', 'e_schedules.doc_id', '=', 'doctors.doctor_id')
                        ->join('ec_rooms', 'e_schedules.room', '=', 'ec_rooms.room_id')
                        ->select('bookings.booking_id','bookings.schedule_id','bookings.patient_id','doctors.name','e_schedules.shift_start','e_schedules.shift_end','ec_rooms.room_name','bookings.number','bookings.status')
                        ->where('bookings.patient_id','=',$id)
                        ->get();
                
               
                
		return view('patients.show', array('patient' => $patient,'appointments'=>$appointments));
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
    public function update($id, Request $request)
	{
		$patient = Patient::find($id);

		$this->validate($request, [
			'name',
			'nic',
			'email',
			'dob',
                        'phone',
                        'sex',
                        'address',
                        'member_id'
		]);

		$input = $request->all();

		$patient->fill($input)->save();

		Session::flash('flash_message', 'Patient successfully Updated!');

		return redirect()->back();
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
	{
		$patient=  Patient::findOrFail($id);
		$patient->delete();
		DB::table('patients')->where('id','=', $id)->delete();

		return redirect()->back();

	}


}
