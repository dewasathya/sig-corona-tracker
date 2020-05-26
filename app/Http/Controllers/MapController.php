<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Date
        $date = "2020/04/01";
        // $date = date("Y/m/d");

        // Coloring
        $gradient = array("step" => 6, "min" => "#00BAE5", "max" => "#BF2300");

        // DB get reports
        $reports = DB::table('district_reports')
        ->join('districts', 'district_reports.district_id', '=', 'districts.id')
        ->select('district_reports.*', 'districts.district_name')
        ->whereDate('report_date', $date)
        ->orderBy('district_id', 'asc')
        ->get();

        // Find & Replace and save to bali-seperated-live
        $message = [
            '"name": "Jembrana", "total": ',
            '"name": "Tabanan", "total": ',
            '"name": "Badung", "total": ',
            '"name": "Denpasar", "total": ',
            '"name": "Gianyar", "total": ',
            '"name": "Bangli", "total": ',
            '"name": "Klungkung", "total": ',
            '"name": "Karangasem", "total": ',
            '"name": "Buleleng", "total": '
        ];

        $write_path = public_path() . '/js/bali-seperated-live.js';

        // Read original
        $str = file_get_contents(asset('js/bali-seperated.js'));

        foreach($reports as $report) {
            if ($report->district_id > 0 && $report->district_id < 10) {
                $str = str_replace($message[$report->district_id - 1] . '0', $message[$report->district_id - 1] . $report->total_positive, $str);
            }
        }

        file_put_contents($write_path, $str);

        return view('map', ['reports' => $reports, 'gradient' => $gradient]);
    }
}
