<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Campaign;
use App\Journal;
use Carbon\Carbon;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|string',
            'title' => 'required|string|max:240',
            'date' => 'required|date_format:"m/d/Y"',
            'elapsed_time' => 'numeric',
            'campaign_id' => 'numeric',
        ]);

        $campaign = Campaign::findOrFail($request->input('campaign_id'));

        $this->authorize('view', $campaign);

        if(!$request->input('elapsed_time')){
            $elapsed_time = 0;
        }else{
            $elapsed_time = $request->input('elapsed_time');
        }

        $date = Carbon::createFromFormat('m/d/Y', $request->input('date'))->toDateTimeString();

        $journal = new Journal;
        $journal->user_id = \Auth::id();
        $journal->campaign_id = $request->input('campaign_id');
        $journal->body = $request->input('body');
        $journal->title = $request->input('title');
        $journal->elapsed_time = $elapsed_time;
        $journal->created_at = $date;
        $journal->save();
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $journal = Journal::findOrFail($id);

        $this->authorize('update', $journal);

        return view('journal.edit', compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $journal = Journal::findOrFail($id);

        $this->authorize('update', $journal);

        $this->validate($request, [
            'body' => 'required|string',
            'title' => 'required|string|max:240',
            'elapsed_time' => 'numeric',
        ]);

        $journal->title = $request->input('title');
        $journal->body = $request->input('body');
        $journal->elapsed_time = $request->input('elapsed_time');

        $journal->update();
        
        $request->session()->flash('status', 'Your journal has been edited!');

        return redirect()->action('CampaignController@show', ['id' => $journal->campaign->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);
        $this->authorize('delete', $journal);
        $journal->delete();
        return back();
    }
}
