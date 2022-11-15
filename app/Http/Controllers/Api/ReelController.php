<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReelResource;
use App\Models\Comment;
use App\Models\Place;
use App\Models\Reel;
use App\Traits\UploadReelTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    use apiResponseTrait, UploadReelTrait;

    /**
     * Get Places
     * Return api JSON
     */
    public function places(){
        $places = Place::get();
        return $this->apiResponse($places, 'success', 200);
    }
   /**
     * Get Reels
     * Return api JSON
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'placeId'=>'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $id = $request->placeId;
        if($id){
            $reels = Reel::all()->where('place_id', '=', $id);
            return $this->apiResponse(ReelResource::collection($reels), 'success', 200);
        }
        return $this->apiResponse(null, 'Not Found', 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reel  $reel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reel = Reel::find($id);
        if($reel){
            return $this->apiResponse(new ReelResource($reel), 'success', 200);
        }
        return $this->apiResponse(null, 'Not Found', 404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'description' => 'required',
            'reel_path' => 'required|mimes:jpg,mp4,png',
            'place_id' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $user = 'ali'; // Auth::user()->username
        $image = time().'_'.$request->file('reel_path')->getClientOriginalName();
        $path = $this->uploadReel($request, $user, $image);
        $reel = Reel::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'reel_path'=>$path,
            'place_id' =>$request->place_id,
            // 'user_id' => Auth::user()->id,
        ]);
        if($reel){
            return $this->apiResponse(new ReelResource($reel), 'ok', 201);
        }
        return $this->apiResponse(null, 'Not Save', 400);
    }

    /**
     * Get Comments
     * Return api JSON
     */
    public function comments(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reel_id'=>'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }
        $id = $request->reel_id;
        $reel = Reel::find($id);
        if($reel){
            $comments = Comment::get()->where('reel_id', '=', $id);
            if($comments){
                return $this->apiResponse($comments , 'success', 200);
            }else {
                return $this->apiResponse(null, 'Not Found Comments', 404);
            }
        }
        return $this->apiResponse(null, 'Not Found This Reel', 404);
    }

    /**
     * Store a newly created Comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment'=>'required',
            'user_id'=>'required|integer|min:1',
            'reel_id'=>'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);
        }

        $comment = Comment::create([
            'user_id'=>$request->user_id,
            'reel_id'=>$request->reel_id,
            'comment'=>$request->comment,
        ]);
        if($comment){
            return $this->apiResponse($comment , 'ok', 201);
        }
        return $this->apiResponse(null, 'Not Save', 400);
    }


}
