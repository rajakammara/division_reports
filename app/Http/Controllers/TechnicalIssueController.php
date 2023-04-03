<?php

namespace App\Http\Controllers;

use App\Models\TechnicalIssue;
use Illuminate\Http\Request;

class TechnicalIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technicalIssues = TechnicalIssue::all();
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
        //
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
    public function destroy(TechnicalIssue $technicalIssue)
    {
        //
    }
}
