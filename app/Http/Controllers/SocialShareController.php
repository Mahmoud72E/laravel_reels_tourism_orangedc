<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Jorenvh\Share\ShareFacade as Share;
use Share;

class SocialShareController extends Controller
{
    public function index($id){
        $socialShare = Share::page('http://localhost/instant/reels-project/public/reel/'. $id, 'name')
        ->facebook()
        ->twitter()
        ->whatsapp()
        ->telegram()->getRawLinks();
        //dd($socialShare);
        return view('reels.socialshare', compact('socialShare'));
    }
}
