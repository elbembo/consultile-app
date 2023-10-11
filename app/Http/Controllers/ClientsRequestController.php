<?php

namespace App\Http\Controllers;

use App\Models\ClientsRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Models\WebhookCall;

class ClientsRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $requests = WebhookCall::where('approved', '<', '3')->where('name', 'zoho-forms')->orderBy('id', 'desc')->paginate(30);
        // dd($requests->links());
        return view('projects.client-request.index', compact('requests'));
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
        $request->validate([
            'first_name' => 'required',
            'email' => 'required',
        ]);
        if(Contact::create($request->all())):;
            WebhookCall::find($request->call_id)->update(array('approved' => "1"));
        endif;
        return redirect()->back()->with('success', 'Request Sent Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientsRequest  $clientsRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ClientsRequest $clientsRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientsRequest  $clientsRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientsRequest $clientsRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientsRequest  $clientsRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientsRequest $clientsRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientsRequest  $clientsRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebhookCall $clientsRequest)
    {
        //
        $clientsRequest->approved = "3";
        $clientsRequest->save();
        return redirect()->back();
    }
}
