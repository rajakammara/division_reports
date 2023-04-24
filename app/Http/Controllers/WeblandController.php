<?php

namespace App\Http\Controllers;

use App\Models\ApsevaApp;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeblandController extends Controller
{
  public function mutation_report($color=null){
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
    $mtc_response = json_decode($response,true);

    $postdata = [
      "Status"=>'MD',
      "DistCode"=>"12",
      "Division"=>"2",
      "Mandal"=>'',
      "Fromdate"=>"01/05/2022",
      "Enddate"=>"$currentDate",
      "ProcedureName"=>"MutationTransactions_DatesWise",
    ];
    $response = Http::withHeaders(['Content-type'=>'application/json;charset=UTF-8'])->post($postUrl,$postdata)->body();
    $mtt_response = json_decode($response,true);

    if ($color==1) {
      return view('webland_color',compact('mtt_response','mtc_response'));
    } else {
      return view('webland',compact('mtt_response','mtc_response'));
    }
    
    
  }
  public function otc_report(){
    $distpostdata = [
      "ProcedureName"=>'exec Land_Conversion_Go226_Sp DIV,12, 0, 0',
      "DistCode"=>"12",      
    ];
     $divpostdata = [
      "ProcedureName"=>'exec Land_Conversion_Go226_Sp MD,12, 2, 0',
      "DistCode"=>"12",      
    ];
    $postUrl = "http://uatwebland.ap.gov.in/WeblandDashboard/WtaxProgress/MCR";
    $response = Http::withHeaders(['Content-type'=>'application/json;charset=UTF-8'])->post($postUrl,$distpostdata)->body();
    //dd($response);
    //dist report
    $lc_dist_response = json_decode($response,true);    
    $response = Http::withHeaders(['Content-type'=>'application/json;charset=UTF-8'])->post($postUrl,$divpostdata)->body();
    $lc_div_response = json_decode($response,true);
    //dd( $lc_div_response);

    //OTC
    $currentDate = date('d/m/Y');
    $otcUrl = "http://uatwebland.ap.gov.in/WeblandDashboard/WtaxProgress/OTC";
    $distpostdata = [
      "ProcedureName"=>'DIV',
      "DistCode"=>"12",  
      "Division"=>"",
      "Mandal"=>"",
      "Village"=>"",
      "Fromdate"=>"11-11-2021",
      "Enddate"=>"$currentDate",    
    ];
    $divpostdata = [
      "ProcedureName"=>'MD',
      "DistCode"=>"12",  
      "Division"=>"2",
      "Mandal"=>"",
      "Village"=>"",
      "Fromdate"=>"11-11-2021",
      "Enddate"=>"$currentDate",    
    ];
    $response = Http::withHeaders(['Content-type'=>'application/json;charset=UTF-8'])->post($otcUrl,$distpostdata)->body();
    $otc_dist_response = json_decode($response,true); 

    $response = Http::withHeaders(['Content-type'=>'application/json;charset=UTF-8'])->post($otcUrl,$divpostdata)->body();
    $otc_div_response = json_decode($response,true); 


    return view('otc',compact('lc_dist_response','lc_div_response','otc_dist_response','otc_div_response'));

  }
}