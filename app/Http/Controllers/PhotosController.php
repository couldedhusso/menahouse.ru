<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Images;
use App\Thumbnail;
use Illuminate\Support\Facades\Input;
use Menahouse\Contracts\ImageManipulationInterface;
use Illuminate\Session\TokenMismatchException;


class PhotosController extends Controller
{

   
    protected $imageRepos;
    public function __construct(ImageManipulationInterface $clsImageHelper){
        $this->imageRepos = $clsImageHelper;
    }

    public function destroy($id){
        $photo = Images::find($id);

        if ($photo) $photo->delete();
        return redirect()->back();
    }

    public function updateImage(Request $request){
     
        
        try{

            $photo = Thumbnail::where('obivlenie_id', $request->input('thumnail_id'))->first();
            $file = $request->file('thumb');

            $valid = (null !== $photo && $request->hasFile('thumb'));       

            if (!$valid) return redirect()->back();

            dd($photo);

            if ($photo) $photo->delete();

        }catch(TokenMismatchException $e){
            return redirect()->back();
        }


        
        return redirect()->back();
    }
}
