<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

use App\Images ;
use App\Categorie ;
use App\Nedvizhimosts ;
use Auth ;

use Redirect;
use Request;



class NedvizhimostsController extends Controller
{

    public function __contruct(){
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function additem(Request $request)
    {

            // $file = Input::file('file');
            // dd($file) ;

        if(Request::ajax()) { // Becuase you are uploading with ajax / dropzone
          $file = Input::file('file');
          dd($file) ;
          // // $destinationPath = public_path() . '/uploads/';
          // $filename = $file->getClientOriginalName();
          // $upload_success = Input::file('files')->move($storage_path, $filename);
          // if ($upload_success) {
          //     return Response::json('success', 200);
          // } else {
          //     return Response::json('error', 400);
          // }
        }
    }

  /*  public function user_photos_path(){
      return public_path() .'/images/'.Auth::user()->id. '/' ;
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // $user_photos_path = public_path().'/images/'.Auth::user()->id.'/' ;

      // if (!empty($_FILES)) {
      //     $file[] =  $_FILES['files']['tmp_name'];
      // }



      // $file[] = Input::file('file');
    //  dd($file);

      // if (Request::ajax()) {
      //       $file[] = Input::file('files');
      //       dd($file);
      //
      //     //   var_dump($file);
      //     //   $extension = File::extension($file[0]->getClientOriginalName());
      //     //  /* $directory = 'img/profile_pics/' . Auth::user()->username;
      //     //   $filename = "profile." . $extension;*/
      //     //   echo $extension;
      // }
      //
      // dd(Input::get('images'));

      $user_id = Auth::user()->id ;
      $path = base_path();
      $storage_path = public_path().'/storage/'.$user_id ;

      if(! File::exists($storage_path)) {
          File::makeDirectory($storage_path);
      }

      //  $files[] = Input::file('pics');
      //  dd($files);
      //  if(Input::hasFile('pics')){
          foreach(Input::file('pics') as $file){
              echo $file->getClientOriginalName()." ";
          }



    //  }
      // // $destinationPath = public_path() . '/uploads/';
      // $filename = $file->getClientOriginalName();
      // $upload_success = Input::file('file')->move($storage_path, $filename);
      // if ($upload_success) {
      //     return Response::json('success', 200);
      // } else {
      //     return Response::json('error', 400);
      // }

      // if(Request::ajax()) { // Becuase you are uploading with ajax / dropzone
      //   $file = Input::file('files');
      //   dd($file) ;
      //   // $destinationPath = public_path() . '/uploads/';
      //   $filename = $file->getClientOriginalName();
      //   $upload_success = Input::file('files')->move($storage_path, $filename);
      //   if ($upload_success) {
      //       return Response::json('success', 200);
      //   } else {
      //       return Response::json('error', 400);
      //   }
      // }

      // if (Input::file('image')->isValid()) {
      //     $destinationPath = $user_photos_path. $filename ; // upload path
      //     $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
      //
      //   //  $fileName = rand(11111,99999).'.'.$extension; // renameing image
      //     Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
      //     // sending back with message
      //
      //     Session::flash('success', 'Upload successfully');
      //     return Redirect::to('upload');
      //   }
      //   else {
      //     // sending back with error message.
      //     Session::flash('error', 'uploaded file is not valid');
      //     return Redirect::to('upload');
      //   }

        ///$dest = $path.'/public/storage/'.$user_id .'/'.$filename ;

        //
        // $nedvizhimosts = Nedvizhimosts::create([
        //     'adressa' =>Input::get('adressa'),
        //     'gorod' =>Input::get('gorod'),
        //     'kolitchestvo_komnat' =>Input::get('kolitchestvo_komnat'),
        //     'etajnost_doma' =>Input::get('etajnost_doma') ,
        //     'zhilaya_ploshad' =>Input::get('zhilaya_ploshad') ,
        //     'obshaya_ploshad' => Input::get('obshaya_ploshad') ,
        //     'ploshad_kurhnia' =>Input::get('ploshad_kurhnia')  ,
        //     'etazh' => Input::get('etazh'),
        //     'price' =>Input::get('price') ,
        //     'opicanie' =>Input::get('opicanie'),
        //     'user_id' => $user_id,
        //     'categorie_id' => $this->getCategoriesById(Input::get('Categories'))
        // ]);

        // $file =  Input::file('files') ;
        //
        // dd($file) ;

        // foreach ($file as $imgvalue) {
        //
        //    $filename = date('Y-m-d')."-".str_random(8)."-".$imgvalue->getClientOriginalName();
        //
        //    if( $imgvalue->isValid() ){
        //         $imgvalue->move($storage_path, $filename);
        //
        //         $img = new Images ;
        //         $img = $nedvizhimosts->images()->create(array('path' => $filename));
        //         $nedvizhimosts->images()->save($img);
        //
        //    }
        //   # code...
        // }

      //   $filename = date('Y-m-d')."-".str_random(8)."-".$file->getClientOriginalName();
      //
      // //  $image = Image::make($file->getRealPath());
      //
      //   $path_save = $storage_path. $filename ;
      //
      //   if(Input::file('image')->isValid()){
      //     $file->move($storage_path, $filename);
      //   }
      //
      //
      //   $img = new Images ;
      //   $img = $nedvizhimosts->images()->create(array('path' => $filename));
      //   $nedvizhimosts->images()->save($img);

        //$nedvizhimosts->image = $path_save ;
        //$nedvizhimosts->categorie = Input::get('Categories') ;

        //appliquer un resize image
        //$iamge->save($path_save);

      // return Redirect('/home');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        nedvizhimosts::destroy($id);
        return Redirect('/dashboard/nedvizhimosts');
    }

    public function getCategoriesById($categorie)
    {
      $allcategorie = Categorie::wherename($categorie)->get();
      return $allcategorie[0]->id ;
    }
}
