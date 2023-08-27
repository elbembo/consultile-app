<?php

namespace App\Http\Controllers;

use App\Models\ClientsRequest;
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
        $requests = WebhookCall::where('id', '>', '0')->orderBy('id', 'desc')->paginate(30);
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
    public function destroy(ClientsRequest $clientsRequest)
    {
        //
    }
}
