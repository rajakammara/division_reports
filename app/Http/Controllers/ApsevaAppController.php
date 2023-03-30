<?php

namespace App\Http\Controllers;

use App\Models\ApsevaApp;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApsevaAppController extends Controller
{
    //Fetch apseva revenue report
    public function fetch_revenue_report()
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
        //Self::fetch_cs_report();
        return $data;
    }
    //Fetch apseva civil supplies report
    public function fetch_cs_report()
    {
        $currentDate = date('d/m/Y');
        $cs_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Transaction Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Civil Supplies&Service=All&FromDate=01/01/2023&ToDate=" . $currentDate;

        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($cs_url);
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
        //dd($response);
        //DB::table('apseva_apps')->delete();
        // ApsevaApp::insert($data);
        return $response;
    }

    //Fetch apseva revenue abstract report
    public function fetch_revenue_abstract_report()
    {
        $currentDate = date('d/m/Y');
        $cs_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Mandal%20Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Revenue&Service=All&FromDate=29/03/2023&ToDate=" . $currentDate;

        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($cs_url);
        return $response;
    }
    //Fetch apseva cs abstract report
    public function fetch_cs_abstract_report()
    {
        $currentDate = date('d/m/Y');
        $cs_url = "https://api.vswsonline.ap.gov.in/reports/api/CSPServiceDashboard/GetCSPServiceDashboardData?FlagName=Mandal%20Wise&DistrictID=502&RUrban=All&MandalId=All&SecCode=All&Department=Civil%20Supplies&Service=All&FromDate=29/03/2023&ToDate=" . $currentDate;

        $response = Http::withHeaders(["ocp-apim-subscription-key" => "36491518b58b42cfbffa854fde92f134"])->accept('application/json')->get($cs_url);
        return $response;
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
    public function apseva_abstract_mandal()
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
}