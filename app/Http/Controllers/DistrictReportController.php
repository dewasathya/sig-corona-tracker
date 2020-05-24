<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\District;

class DistrictReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = DB::table('district_reports')
        ->join('districts', 'district_reports.district_id', '=', 'districts.id')
        ->select('district_reports.*', 'districts.district_name')
        ->get();

        // Return View
        return view('district_report.index', ['reports' => $reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $districts = District::pluck('district_name', 'id');
        $districts = DB::table('districts')->get();

        return view('district_report.create', ['districts' => $districts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'report_date' => 'required',
            'district' => 'required',
            'foreign_travel_agent_foreign' => 'required',
            'foreign_travel_agent_indonesian' => 'required',
            'domestic_travel_agent' => 'required',
            'local_transmission' => 'required',
            'other_positive' => 'required',
            'total_positive' => 'required',
            'treated' => 'required',
            'recovered' => 'required',
            'died' => 'required'
        ]);

        // Insert to table
        DB::table('district_reports')->insert([
            'report_date' => $request->report_date,
            'district_id' => $request->district,
            'foreign_travel_agent_foreign' => $request->foreign_travel_agent_foreign,
            'foreign_travel_agent_indonesian' => $request->foreign_travel_agent_indonesian,
            'domestic_travel_agent' => $request->domestic_travel_agent,
            'local_transmission' => $request->local_transmission,
            'other_positive' => $request->other_positive,
            'total_positive' => $request->total_positive,
            'treated' => $request->treated,
            'recovered' => $request->recovered,
            'died' => $request->died
        ]);

        // Redirect to Index
        return redirect()->route('report.index')->with('status', 'Data Laporan Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Edit
        $report = DB::table('district_reports')->where('id', $id)->first();
        $districts = DB::table('districts')->get();

        return view('district_report.edit', ['report' => $report, 'districts' => $districts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $this->validate($request, [
            'report_date' => 'required',
            'district' => 'required',
            'foreign_travel_agent_foreign' => 'required',
            'foreign_travel_agent_indonesian' => 'required',
            'domestic_travel_agent' => 'required',
            'local_transmission' => 'required',
            'other_positive' => 'required',
            'total_positive' => 'required',
            'treated' => 'required',
            'recovered' => 'required',
            'died' => 'required'
        ]);

        // Update table
        DB::table('district_reports')->where('id', $request->id)->insert([
            'report_date' => $request->report_date,
            'district_id' => $request->district,
            'foreign_travel_agent_foreign' => $request->foreign_travel_agent_foreign,
            'foreign_travel_agent_indonesian' => $request->foreign_travel_agent_indonesian,
            'domestic_travel_agent' => $request->domestic_travel_agent,
            'local_transmission' => $request->local_transmission,
            'other_positive' => $request->other_positive,
            'total_positive' => $request->total_positive,
            'treated' => $request->treated,
            'recovered' => $request->recovered,
            'died' => $request->died
        ]);

        // Redirect to Index
        return redirect()->route('report.index')->with('status', 'Data Laporan Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
