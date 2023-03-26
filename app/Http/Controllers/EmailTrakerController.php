<?php

namespace App\Http\Controllers;

use App\Models\EmailTraker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EmailTrakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //

        // $name = storage_path() . "/app/attachmens/CuvLf3z6fNI3RNoQsfkyFAMmbD3Xd6TBOS9HxcYu.png";
        // $img = imagecreatefrompng($name);
        // imagealphablending($img, false);
        // imagesavealpha($img, true);
        if($id){
            $tracker = EmailTraker::where('massage_id',$id)->first();
            if(!empty($tracker)){
                $tracker->delivered = 1;
                $tracker->opend = 1;
                $tracker->views = ($tracker->views+1) ;
                $tracker->save();
            }
        }
        // header('Content-Type: image/png');
        // header('Cache-control: max-age=3600');
        // imagepng($img);
        // imagedestroy($img);
        // return response("", 200, ['Content-Type' => "image/png"]);
        // return redirect('https://app.consultile.com/1x1-00000000.png');
        return  response()->file(public_path().'1x1-00000000.png', ['Content-Type' => 'image/png']);
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
     * @param  \App\Models\EmailTraker  $emailTraker
     * @return \Illuminate\Http\Response
     */
    public function show(EmailTraker $emailTraker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailTraker  $emailTraker
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailTraker $emailTraker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailTraker  $emailTraker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailTraker $emailTraker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailTraker  $emailTraker
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailTraker $emailTraker)
    {
        //
    }
}
