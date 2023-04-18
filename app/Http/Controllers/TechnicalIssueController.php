<?php

namespace App\Http\Controllers;

use App\Models\TechnicalIssue;
use App\Models\ApsevaApp;
use Illuminate\Http\Request;
use DB;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Http;
class TechnicalIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technicalIssues = DB::select("SELECT t.id,t.portal,t.mandal_name,t.request_id,t.service_name,t.remarks,t.description FROM technical_issues t inner join apseva_apps a on t.request_id=a.app_number order by t.mandal_name");
        return view('technical_issues',compact('technicalIssues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
        'appid' => 'required',
        'service_name' => 'required',
        'mandal_name' => 'required',
        'app_number' => 'required',
        'portal' => 'required',
        'remarks' => 'required',
    ],['appid.required' => 'Application Id is missing',
        'service_name.required'=>'Service name is missing',
        'mandal_name.required'=>'Mandal name is missing',
        'app_number.required'=>"Request number is missing",
        'portal.required'=>"Please select issue portal",
        'remarks.required'=>"Please enter Issue Remarks"
    ]);
        $technicalIssue = new TechnicalIssue();
        $technicalIssue->portal = $request->get('portal');
        $technicalIssue->mandal_name = $request->get('mandal_name');
        $technicalIssue->request_id = $request->get('app_number');
        $technicalIssue->service_name = $request->get('service_name');
        $technicalIssue->remarks = $request->get('remarks');
        $technicalIssue->save();
        return redirect('/apseva_linelist')->with('status', 'Remarks Updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TechnicalIssue  $technicalIssue
     * @return \Illuminate\Http\Response
     */
    public function show(TechnicalIssue $technicalIssue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TechnicalIssue  $technicalIssue
     * @return \Illuminate\Http\Response
     */
    public function edit(TechnicalIssue $technicalIssue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TechnicalIssue  $technicalIssue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $technicalIssue = TechnicalIssue::find($request->id);
        $technicalIssue->remarks = $request->remarks; 

        $technicalIssue->save();
        return response()->json(['success'=>'Updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TechnicalIssue  $technicalIssue
     * @return \Illuminate\Http\Response
     */
    public function destroy(TechnicalIssue $technicalIssue,$issue)
    {
        $technicalIssue = TechnicalIssue::find($issue);
        $technicalIssue->delete();
         return redirect('/technical_issues')->with('status', 'Deleted successfully');
        
    }

    public function getCasteIncomeReport(){
        $url="http://36.255.253.208/castecertificate.aspx";
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $client = new \GuzzleHttp\Client(['cookies' => $jar]);
        $response = $client->get($url); 
        $cookie = $jar->getCookieByName('ASP.NET_SessionId');
        //dd($cookie->getValue());
        //dd($response->getBody()->getContents());      
        $htmlString = $response->getBody()->getContents();
        //add this line to suppress any warnings
        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->preserveWhiteSpace = false; 
        $doc->loadHTML($htmlString);
        $viewstategenerator=$doc->getElementById('__VIEWSTATEGENERATOR')->getAttribute('value');
        $viewstate=$doc->getElementById('__VIEWSTATE')->getAttribute('value');
        $eventvalidation=$doc->getElementById('__EVENTVALIDATION')->getAttribute('value');
        $postdata=[
            '__VIEWSTATE'=>$viewstate,
            '__VIEWSTATEGENERATOR'=>$viewstategenerator,
            '__EVENTVALIDATION'=>$eventvalidation,
            '__EVENTTARGET'=>'ctl00$ContentPlaceHolder1$GridView2$ctl04$LinkButton2'

        ];
       // dd($postdata);
        $request = $client->request('POST',$url,['form_params'=>$postdata]);        
        
        $doc->loadHTML($request->getBody()->getContents());
        $tables = $doc->getElementsByTagName('table');
        $rows = $tables->item(0)->getElementsByTagName('tr'); 

        $data=[];
        foreach ($rows as $row) {

            $cols = $row->getElementsByTagName('td');             
            if(is_object($cols ->item(0))) {
            $temp = [];
            $temp['sno'] = $cols[0]->nodeValue;
            $temp['mandal'] = $cols[1]->nodeValue;
            $temp['total_students'] = $cols[2]->nodeValue;
            $temp['updated_students'] = $cols[3]->nodeValue;
            $temp['having_old_cert'] = $cols[4]->nodeValue;
            $temp['applied_new'] = $cols[5]->nodeValue;
            $temp['balance'] = $cols[2]->nodeValue - $cols[3]->nodeValue;
            $temp['percentage'] = number_format(100 * ($cols[3]->nodeValue/$cols[2]->nodeValue),2);
            //var_dump($cols[0]->nodeValue);
            array_push($data,$temp);
            }
        }
        $div_mandals=["ANANTAPUR (URBAN)","TADIPATRI (URBAN)","TADIPARTRI","PEDDAPAPPUR","ATMAKUR","KUDERU","GARLADINNE","SINGANAMALA","PUTLUR","YELLANUR","NARPALA","BUKKARAYASAMUDRAM","ANANTHAPURAM RURAL","RAPTHADU"];
        $data=array_filter($data,function($var) use($div_mandals){
            foreach ($div_mandals as $value) {
                //var_dump($value);
                //var_dump($var);
                if(trim($var['mandal'])==$value){
                    return $var;
                }
            }
        });
        $percentage  = array_column($data, 'percentage');
        array_multisort($percentage, SORT_ASC, $data);
        return view('castereport',compact('data'));
    }

    public function getLocalCasteIncomeReport(){
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->preserveWhiteSpace = false;
        $doc->loadHTMLFile("tempdata.html");
        $tables = $doc->getElementsByTagName('table');
        $rows = $tables->item(0)->getElementsByTagName('tr'); 
        

        $data=[];
        foreach ($rows as $row) {

            $cols = $row->getElementsByTagName('td');             
            if(is_object($cols ->item(0))) {
            $temp = [];
            $temp['sno'] = $cols[0]->nodeValue;
            $temp['mandal'] = $cols[1]->nodeValue;
            $temp['total_students'] = $cols[2]->nodeValue;
            $temp['updated_students'] = $cols[3]->nodeValue;
            $temp['having_old_cert'] = $cols[4]->nodeValue;
            $temp['applied_new'] = $cols[5]->nodeValue;
            $temp['balance'] = $cols[2]->nodeValue - $cols[3]->nodeValue;
            $temp['percentage'] = number_format(100 * ($cols[3]->nodeValue/$cols[2]->nodeValue),2);
            //var_dump($cols[0]->nodeValue);
            array_push($data,$temp);
            }
        }
        $div_mandals=["ANANTAPUR (URBAN)","TADIPATRI (URBAN)","TADIPARTRI","PEDDAPAPPUR","ATMAKUR","KUDERU","GARLADINNE","SINGANAMALA","PUTLUR","YELLANUR","NARPALA","BUKKARAYASAMUDRAM","ANANTHAPURAM RURAL","RAPTHADU"];
        $data=array_filter($data,function($var) use($div_mandals){
            foreach ($div_mandals as $value) {
                //var_dump($value);
                //var_dump($var);
                if(trim($var['mandal'])==$value){
                    return $var;
                }
            }
        });
        $percentage  = array_column($data, 'percentage');
        array_multisort($percentage, SORT_ASC, $data);

        return view('castereport',compact('data'));
    }
}
