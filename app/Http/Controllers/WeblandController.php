<?php

namespace App\Http\Controllers;

use App\Models\ApsevaApp;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeblandController extends Controller
{
  public function mtc_report(){
    $currentDate = date('d/m/Y');
    $postdata = [
      "Status"=>'MD',
      "DistCode"=>"12",
      "Division"=>"2",
      "Mandal"=>'',
      "Fromdate"=>"01/05/2022",
      "Enddate"=>"$currentDate",
      "ProcedureName"=>"MutationCorrections_DatesWise",
    ];
    $postUrl = "http://uatwebland.ap.gov.in/WeblandDashboard/WtaxProgress/MTRRD";
    $response = Http::withHeaders(['Content-type'=>'application/json;charset=UTF-8'])->post($postUrl,$postdata)->body();
    //dd($response);
    return $response;
  }
}