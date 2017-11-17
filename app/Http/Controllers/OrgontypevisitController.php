<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Orgontypevisit;
use App\Organ;
use Carbon\Carbon;
use DB;

class OrgontypevisitController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $organ = Orgontypevisit::all();
        $organ1 = Organ::all();
        return \view('orgontypevisits.index', compact('organ', 'organ1'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('orgontypevisits.create');
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
        $max = Orgontypevisit::where('nic', $nic)->max('updated_at');
        $count = Orgontypevisit::where('nic', $nic)->count('updated_at');
        $created = new Carbon($max);
        $mytime = Carbon::now();

        $curtime = $mytime->toDateTimeString();

        $diff = $curtime - $max;
        $difference = $mytime->diff($created)->days;
        if ($max == null) {
            $create = Orgontypevisit::create($input);
            return redirect('orgontypevisits');
        }

        return \view('orgontypevisits.test')->with('nic', $nic)->with('max', $max)->with('mytime', $mytime)->with('difference', $difference);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $organ = Orgontypevisit::find($id);
        $organ1 = Organ::find($id);
        return \view('orgontypevisits.show', compact('organ', 'organ1'));

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

    public function visitchart() {
        $blood = DB::table('orgontypevisits')
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

    public function organchart() {
        $blood = DB::table('orgontypevisits')
                ->select(
                        DB::raw("part as part"), DB::raw("count(nic) as total_id")
                )
                ->orderBy("part")
                ->groupBy(DB::raw("part"))
                ->get();

        $result[] = ['Part', 'Quantity'];
        foreach ($blood as $key => $value) {
            $result[++$key] = [$value->part, (int) $value->total_id];
        }

        return view('organ.bloodchart')->with('blood', json_encode($result));
    }

}
