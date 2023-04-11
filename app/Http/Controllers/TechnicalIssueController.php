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
    public function update(Request $request, TechnicalIssue $technicalIssue)
    {
        //
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
        
        dd($request->getBody()->getContents());
        $doc->loadHTML($request->getBody()->getContents());
        //$table = $doc->getElementById('ctl00_ContentPlaceHolder1_GridView2');
        $tables = $doc->getElementsByTagName('table'); 
        dd($doc);
        $rows = $doc->getElementsByTagName('td');
       // dd($rows);
       $data=[];
       foreach ($rows as $row) {
        $cols = $row->getElementsByTagName('td');
        dd($row);
        echo 'Sno: '.$cols->item(0)->nodeValue.'<br />'; 
        echo 'Mandal: '.$cols->item(1)->nodeValue.'<br />'; 
        $temp=array('Sno'=>$cols->item(0)->nodeValue,'Mandal'=>$cols->item(1)->nodeValue);
        array_push($data,$temp);
    }
        return view('temp',compact('data'));
    }

    public function getLocalCasteIncomeReport(){
        $myfile = fopen("tempdata.txt","r") or die("Unable to open file");
        echo fread($myfile,filesize("tempdata.txt"));
        fclose($myfile);
    }
}
