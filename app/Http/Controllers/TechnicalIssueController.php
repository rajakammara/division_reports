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
        $technicalIssues = DB::select("SELECT t.id,t.portal,t.mandal_name,t.request_id,t.service_name,t.remarks,t.description,t.pending_with,t.pending_reason FROM technical_issues t inner join apseva_apps a on t.request_id=a.app_number order by t.mandal_name");
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
        'pending_with'=>'required',
        'pending_reason'=>'required'
    ],['appid.required' => 'Application Id is missing',
        'service_name.required'=>'Service name is missing',
        'mandal_name.required'=>'Mandal name is missing',
        'app_number.required'=>"Request number is missing",
        'portal.required'=>"Please select issue portal",
        'remarks.required'=>"Please enter Issue Remarks",
        'pending_with.required'=>"Please select request pending with",
        'pending_reason.required'=>"Please select pending reason",
    ]);
        $technicalIssue = new TechnicalIssue();
        $technicalIssue->portal = $request->get('portal');
        $technicalIssue->mandal_name = $request->get('mandal_name');
        $technicalIssue->request_id = $request->get('app_number');
        $technicalIssue->service_name = $request->get('service_name');
        $technicalIssue->remarks = $request->get('remarks');
        $technicalIssue->pending_reason = $request->get('pending_reason');
        $technicalIssue->pending_with = $request->get('pending_with');
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
        //return response()->json($request->all());
        $technicalIssue = TechnicalIssue::find($request->id);
        $technicalIssue->remarks = $request->remarks;
        $technicalIssue->pending_with = $request->pending_with;
        $technicalIssue->pending_reason = $request->pending_reason;
        $technicalIssue->portal = $request->portal;
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
         return back()->with('status', 'Deleted successfully');
        
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
