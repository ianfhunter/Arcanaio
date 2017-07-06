<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\Http\Requests;

class ReportController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type, $id)
    {
    	//
    	//  Validation
    	//
    	$this->validate($request, [
    	    'description' => 'required|string|max:1000',
    	]); 

    	$report = new Report;
    	$report->description = $request->input('description');
    	$report->type = $type;
    	$report->user_id = \Auth::id();
    	$report->item_id = $id;
    	$report->save();

        $request->session()->flash('status', 'Your report has been submitted!');

    	return back();

    }
}


