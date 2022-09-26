<?php

namespace App\Traits;

use Illuminate\Http\Request;

/**
 *
 */
trait UploadReelTrait
{
    public function uploadReel(Request $request, $folder, $fileName)
    {
        //$image = $request->file('reel')->getClientOriginalName();
        $path = $request->file('reel_path')->storeAs($folder, $fileName, 'reels');
        return $path;
    }
}

