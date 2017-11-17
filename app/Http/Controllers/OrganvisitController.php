<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organvisit;
use App\Organ;
use DateTime;
use DB;
use Carbon\Carbon;
use Input;
use Illuminate\Http\Response;
use Validator;
use Redirect;
use Session;

class OrganvisitController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $organ = Organvisit::all();
        $organ1 = Organ::all();

        return \view('organvisit.index', compact('organ', 'organ1'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {



        return view('organvisit.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {


        $input = $request->all();
        $nic = $request->input('nic');
        $id = $request->input('id');
        $max = Organvisit::where('nic', $nic)->max('updated_at');
        $count = Organvisit::where('nic', $nic)->count('updated_at');
        $created = new Carbon($max);

        $mytime = Carbon::now();

        $curtime = $mytime->toDateTimeString();

        $diff = $curtime - $max;

        $difference = $mytime->diff($created)->days;
        if ($difference > 90 || $max == null) {
            $create = Organvisit::create($input);
            return redirect('organvisits');
        }
//        elseif ($count < 5 && $difference > 90) {
//             $create = Organvisit::create($input);
//              Session::flash('msg', 'Thanks for voting');
//            //return redirect('organvisits');
//        }
        elseif ($count >= 5 && $difference < 90) {
            return \view('organvisit.donorcard')->with('nic', $nic)->with('count', $count)->with('mytime', $mytime)->with('difference', $difference);
        } else {
            return \view('organvisit.test')->with('nic', $nic)->with('max', $max)->with('mytime', $mytime)->with('difference', $difference);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {

        $organ = Organvisit::find($id);
        $organ1 = Organ::find($id);




        return \view('organvisit.show', compact('organ', 'organ1'));


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

    public function add(Request $request) {

        $input = $request->all();
        $nic = $request->get('nic');

        return view('organvisit.test')->with('$nic', $nic);

        //
    }

    public function visitchart() {
        $blood = DB::table('organvisits')
                ->select(
                        DB::raw("nic as nic"), DB::raw("count(nic) as total_id")
                )
                ->orderBy("nic")
                ->groupBy(DB::raw("nic"))
                ->get();

        $result[] = ['Part', 'Quantity'];
        foreach ($blood as $key => $value) {
            $result[++$key] = [$value->nic, (int) $value->total_id];
        }

        return view('organ.bloodchart')->with('blood', json_encode($result));
    }

    public function bloodchart() {
        $blood = DB::table('organvisits')
                ->select(
                        DB::raw("bloodgroup as Bloodgroup"), DB::raw("count(nic) as total_id")
                )
                ->orderBy("bloodgroup")
                ->groupBy(DB::raw("bloodgroup"))
                ->get();

        $result[] = ['Bloodgroup', 'Quantity'];
        foreach ($blood as $key => $value) {
            $result[++$key] = [$value->Bloodgroup, (int) $value->total_id];
        }

        return view('organ.bloodchart')->with('blood', json_encode($result));
    }

    public function hospitals(Request $request) {
        $organ1 = Organ::all();
        $organ = Organvisit::all();
         $options = [
        'A' => 'A+',
        'B University' => 'B University',
        'C University' => 'C University',
        'D University' => 'D University',
    ];
          //$max = Organvisit::where('nic', $nic)->max('updated_at');
        $bloodgroup = $request->input('bloodgroup');
        $blood = Organvisit::select('bloodgroup')->distinct()->get();

//return View::make('page', array('options' => $options));
        return \view('organvisit.hospitals',array('blood' => $blood));
        //return view('organvisit.hospitals');
    //
    }

}
