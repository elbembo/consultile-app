<?php

namespace App\Http\Controllers;

use App\Imports\DirectContactsImport;
use App\Models\Campaign;
use App\Models\CampaignContacts;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;

class CampaignContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Campaign $campaign)
    {
        //

        return view('campaign.direct.index',compact('campaign'));
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
    public function store(Request $request ,Campaign $campaign)
    {
        //
        $validated = $request->validate([
            'contacts' => 'max:3000|mimes:xlsx,xlsm,xltx,tsv,csv,xml,xlt,xls,xltm,xltx,xlsm'
        ]);
        if (!$validated)
            return back();
        $file = $request->file('contacts');
        $failures = [];
        try {
            $import = new DirectContactsImport($request->group_name);
            $import->import($file);
            $code = $import->code;
            $failures = $import->failures();
            if ($request->debug != 'debug')
                $failures = null;
            $campaign->target_audience = 'direct:'.$code;

            $headings = (new HeadingRowImport)->toArray($file);

            // The headers will be in the first array index
            $headers = $headings[0][0];
            $campaign->field_data = $headers;
            $campaign->save();
            return redirect()->route('campaigns.edit', [$campaign,'code' => $code]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            return view('campaign.direct.index', compact('failures','campaign'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CampaignContacts  $campaign_contacts
     * @return \Illuminate\Http\Response
     */
    public function show(CampaignContacts $campaign_contacts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CampaignContacts  $campaign_contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(CampaignContacts $campaign_contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CampaignContacts  $campaign_contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CampaignContacts $campaign_contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CampaignContacts  $campaign_contacts
     * @return \Illuminate\Http\Response
     */
    public function destroy(CampaignContacts $campaign_contacts)
    {
        //
    }
}
