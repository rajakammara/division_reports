<?php

namespace App\Http\Controllers;

use App\Models\ApsevaApp;
use App\Models\ApsevaAbstract;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApsevaAppController extends Controller
{
    //Fetch apseva revenue report
    public function fetch_apseva_report()
    {
        $currentDate = date('d/m/Y');
        $revenue_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Transaction%20Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Revenue&Service=All&FromDate=06/01/2022&ToDate=" . $currentDate;

        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($revenue_url);

        $response = json_decode($response, true);
        $data = [];
        //dd($response);
        $keys = array_keys($response);
        // echo json_encode($keys[0]);
        foreach ($response['result'] as $key => $result) {
            $keys = array_keys($result);
            //echo var_dump($keys);  
            // echo json_encode($keys);
            // echo json_encode($result);   
            //    echo $result[$keys[4]] . ' '. $result[$keys[5]] . $result[$keys[6]] . ' '. $result[$keys[7]] . ' '. $result[$keys[14]] . ' '. $result[$keys[17]] . ' '. $result[$keys[22]] . ' '. $result[$keys[15]] . ' '.$result[$keys[13]] .'<br>'; 

            $temp = array("mandal_name" => $result[$keys[4]], "sec_name" => $result[$keys[5]], "department" => $result[$keys[6]], "service_name" => $result[$keys[7]], "app_number" => $result[$keys[14]], "sla_status" => $result[$keys[17]], "rural_urban" => $result[$keys[22]], "app_date" => $result[$keys[15]], "sla" => $result[$keys[13]]);
            array_push($data, $temp);
        }
        // Civil supplies
        $cs_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Transaction%20Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Civil%20Supplies&Service=All&FromDate=01/01/2023&ToDate=" . $currentDate;
        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($cs_url);

        $response = json_decode($response, true);
        foreach ($response['result'] as $key => $result) {
            $keys = array_keys($result);
            //echo var_dump($keys);  
            // echo json_encode($keys);
            // echo json_encode($result);   
            //    echo $result[$keys[4]] . ' '. $result[$keys[5]] . $result[$keys[6]] . ' '. $result[$keys[7]] . ' '. $result[$keys[14]] . ' '. $result[$keys[17]] . ' '. $result[$keys[22]] . ' '. $result[$keys[15]] . ' '.$result[$keys[13]] .'<br>'; 

            $temp = array("mandal_name" => $result[$keys[4]], "sec_name" => $result[$keys[5]], "department" => $result[$keys[6]], "service_name" => $result[$keys[7]], "app_number" => $result[$keys[14]], "sla_status" => $result[$keys[17]], "rural_urban" => $result[$keys[22]], "app_date" => $result[$keys[15]], "sla" => $result[$keys[13]]);
            array_push($data, $temp);
        }

        //dd($response);
        DB::table('apseva_apps')->delete();
        ApsevaApp::insert($data);
        DB::table('apseva_apps as a')->join('mandalmasters as m', 'a.mandal_name', '=', 'm.mandal')->update(['a.new_mandal_name' => DB::raw("m.new_mandal"), 'a.div_name' => DB::raw("m.division")]);
        
       // return $data;
        return "Report Updated successfully";
    }
    

    //Fetch apseva revenue abstract report
    public function fetch_abstract_report()
    {
        $currentDate = date('d/m/Y');
        $rev_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Mandal%20Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Revenue&Service=All&FromDate=02/04/2022&ToDate=" . $currentDate;

        $cs_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Mandal%20Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Civil%20Supplies&Service=All&FromDate=02/04/2022&ToDate=" . $currentDate;
        //Revenue
        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($rev_url)->body();
        $response = json_decode($response,true);
       // dd($response);
        $data = [];    
        
        foreach ($response['result'] as $key => $result) {
            $keys = array_keys($result);
            $temp = array("mandal_name" => $result[$keys[4]], "department" => "Revenue", "total_req" => $result[$keys[8]], "beyond_sla" => $result[$keys[9]], "within_sla" => $result[$keys[10]], "lapsing24hrs" => $result[$keys[18]], "lapsing48hrs" => $result[$keys[19]],"rural_urban" => $result[$keys[22]]);
            array_push($data,$temp);
        }
        // CS
        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($cs_url)->body();
        $response = json_decode($response,true);
         foreach ($response['result'] as $key => $result) {
            $keys = array_keys($result);
            $temp = array("mandal_name" => $result[$keys[4]], "department" => "Civil Supplies", "total_req" => $result[$keys[8]], "beyond_sla" => $result[$keys[9]], "within_sla" => $result[$keys[10]], "lapsing24hrs" => $result[$keys[18]], "lapsing48hrs" => $result[$keys[19]],"rural_urban" => $result[$keys[22]]);
            array_push($data,$temp);
        }

        DB::table('apseva_abstracts')->delete();
        ApsevaAbstract::insert($data);
        DB::table('apseva_abstracts as a')->join('mandalmasters as m', 'a.mandal_name', '=', 'm.mandal')->update(['a.new_mandal_name' => DB::raw("m.new_mandal"), 'a.div_name' => DB::raw("m.division")]);
       // return json_encode($data);
        return "Report Updated successfully";
    }
    //Get Apseva Abstract report
    public function get_apseva_mandal_abstract(){
        $query='SELECT new_mandal_name,sum(case when department="Revenue" then beyond_sla else 0 end) "bsla_rev_req",sum(case when department="Revenue" then lapsing24hrs else 0 end) "lapsing24hrs_rev_req",sum(case when department="Revenue" then lapsing48hrs else 0 end) "lapsing48hrs_rev_req",sum(case when department="Civil Supplies" then beyond_sla else 0 end) "bsla_cs_req",sum(case when department="Civil Supplies" then lapsing24hrs else 0 end) "lapsing24hrs_cs_req",sum(case when department="Civil Supplies" then lapsing48hrs else 0 end) "lapsing48hrs_cs_req" FROM `apseva_abstracts` WHERE div_name="ATP" group by new_mandal_name
        union all
        SELECT "Total" as new_mandal_name,sum(case when department="Revenue" then beyond_sla else 0 end) "bsla_rev_req",sum(case when department="Revenue" then lapsing24hrs else 0 end) "lapsing24hrs_rev_req",sum(case when department="Revenue" then lapsing48hrs else 0 end) "lapsing48hrs_rev_req",sum(case when department="Civil Supplies" then beyond_sla else 0 end) "bsla_cs_req",sum(case when department="Civil Supplies" then lapsing24hrs else 0 end) "lapsing24hrs_cs_req",sum(case when department="Civil Supplies" then lapsing48hrs else 0 end) "lapsing48hrs_cs_req" FROM `apseva_abstracts` WHERE div_name="ATP"';
        $apseva_abstract = DB::select($query);
        return view('apseva',compact('apseva_abstract'));
    }

    
    //service name as heading
    public function apseva_abstract()
    {

        //dd($data);
        $service_names = DB::table('apseva_apps')->distinct()->pluck('service_name');
        $service_pivot = "";
        foreach ($service_names as $key => $service_name) {
            $service_pivot .= 'sum(case when(service_name="' . $service_name . '") then 1 else 0 end) as ' . '"' . $service_name . '"' . ',';

        }
        $service_pivot = 'select mandal_name,' . substr($service_pivot, 0, -1) . ' from apseva_apps group by mandal_name';
        $apseva_abstract = DB::select($service_pivot);
        $columnHeadings = 'mandal_name,' . $service_names;
        return view('apseva', compact('apseva_abstract', 'columnHeadings'));
    }
    //mandal name as heading
    public function apseva_service_abstract()
    {

        //dd($data);
        $columnHeadings = DB::table('apseva_apps')->where("new_mandal_name", "!=", "null")->orderBy("new_mandal_name")->distinct()->pluck('new_mandal_name');
        $mandal_pivot = "";
        foreach ($columnHeadings as $key => $mandal_name) {
            $mandal_pivot .= 'sum(case when(new_mandal_name="' . $mandal_name . '") then 1 else 0 end) as ' . '"' . $mandal_name . '"' . ',';

        }
        $pivottotal = $mandal_pivot;
        $mandal_pivot = 'select service_name,' . substr($mandal_pivot, 0, -1) . ',count(new_mandal_name) as "Total" from apseva_apps where div_name="ATP" group by service_name';
        //dd($mandal_pivot);
        $mandal_total_pivot = 'select "Total" as service_name,' . substr($pivottotal, 0, -1) . ',count(new_mandal_name) as "Total" from apseva_apps where div_name="ATP"';
        //dd($mandal_total_pivot);
        $apseva_abstract = DB::select($mandal_pivot);

        $mandal_total_pivot = DB::select($mandal_total_pivot);
        //dd($mandal_total_pivot);

        return view('apseva_mandal', compact('apseva_abstract', 'columnHeadings', 'mandal_total_pivot'));
    }

    //apseva linelist
    public function apseva_linelist(){
        $query= 'SELECT a.id,a.new_mandal_name,a.sec_name,a.service_name,a.app_number,a.sla_status,t.remarks FROM apseva_apps a left join technical_issues t on a.app_number=t.request_id WHERE a.department="Revenue" and a.div_name="ATP" order by a.new_mandal_name';
        $apseva_linelist=DB::select($query);
        return view('apseva_linelist',compact('apseva_linelist'));
    }
}