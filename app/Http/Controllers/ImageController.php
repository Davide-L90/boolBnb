<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Image;

class ImageController extends Controller
{
    public function fileStore(Request $request, $apartment_id)
    {
        
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        
        $imageUpload = new Image();
        $imageUpload->title = $imageName;
        $imageUpload->apartament_id = $apartment_id; 
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        Image::where('title',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;       
        
    }
}
