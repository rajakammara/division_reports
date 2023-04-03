<?php

namespace App\Http\Controllers;

use App\Models\TechnicalIssue;
use App\Models\ApsevaApp;
use Illuminate\Http\Request;
use DB;
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
}
