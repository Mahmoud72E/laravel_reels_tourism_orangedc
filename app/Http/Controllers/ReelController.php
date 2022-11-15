<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Reel;
use App\Models\User;
use App\Traits\UploadReelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class ReelController extends Controller
{
    use UploadReelTrait;
    /**
     * Display a listing of the places.
     *
     * @returnview
     */
    public function places(){
        $places = Place::all();
        return view('reels.places', compact('places'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->place_id;
        $reels = Reel::all()->where('place_id', '=', $id);

        // GET User Name
        // $user = Reel::all();
        // $userid = $user->users;
       // return $userid;
        // Get Place Name
        // $place = Reel::all();
        // $placeid = $place->places;
        // 'userid', 'placeid'


        return view('reels.index', compact('reels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::all();
        return view('reels.create', compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description' => 'required',
            'reel_path' => 'required|mimes:jpg,mp4,png',
            'place_id' => 'required|integer|min:1'
        ]);
        $user = 'ali'; // Auth::user()->username
        $image = time().'_'.$request->file('reel_path')->getClientOriginalName();
        $path = $this->uploadReel($request, $user, $image);
        Reel::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'reel_path'=>$path,
            'place_id' =>$request->place_id,
            // 'user_id' => Auth::user()->id,
        ]);
        return response('Done Add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reel = Reel::findorFail($id);
        return view('reels.reel', compact('reel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function edit(Reel $reel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reel $reel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reel $reel)
    {
        //
    }
}
