<?php namespace Menahouse\Repositories;

use Menahouse\Contracts\ImageManipulationInterface;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;

use Storage;

class ImageManipulationRepository implements ImageManipulationInterface 
{


    protected $IMAGES_PATH = 'dev/images';
    protected $THUMBNAIL_PATH = 'dev/thumbs';

    private static function setStorageDirectory($DirectoryName)
    {

        $directories = Storage::directories($DirectoryName);
        if(!in_array($DirectoryName, $directories)) {
            
            Storage::makeDirectory($DirectoryName);
        }
        return true;
    }


    public function storeImage($filename, $contents){

        $path = $this->IMAGES_PATH.'/'.$filename;

        $this->setStorageDirectory($this->IMAGES_PATH);
        $this->store($path , $contents);

        return true;
        
     //   is_null($directories)
        
    }

    public function UploadToS3($filename, $contents){

        $s3 = Storage::disk('s3');
        $s3->put($filename, $contents, 'public');
        // $path = $this->THUMBNAIL_PATH.'/'.$filename;

        // $this->setStorageDirectory($this->THUMBNAIL_PATH);
        // $this->store($path, $contents);
        return true;
    }

    public function storeThumnailImage($filename, $contents){

        $path = $this->THUMBNAIL_PATH.'/'.$filename;

        $this->setStorageDirectory($this->THUMBNAIL_PATH);
        $this->store($path, $contents);
        return true;
    }

    private function store($path, $contents){
         $typeStorage = Storage::disk('s3');
         $typeStorage->put($path, $contents);

    }

    public function getStorageDirectory()
    {

      
      $baseDir = public_path().'/storage/';
      $storagePath = 'picture';
      $thumbnailsStoragePath = $baseDir.'thumbnail';

      Storage::makeDirectory($baseDir.$storagePath);

     // dd(Storage::disk('local')->directories($storagePath));

      $dir = ['pictures', 'thumbnail'];



       if(! File::exists($storagePath)) {
          $ret =  $this->setStorageDirectory($storagePath);
       }

       if(! File::exists($thumbnailsStoragePath)) {
           $ret = $this->setStorageDirectory($thumbnailsStoragePath);
       }

       return
       [
         /*
         |----------------------------------------------------------------------
         | Repertoire des images de tailles normales
         |----------------------------------------------------------------------
         */
         "storage" => $storagePath,
         /*
         |----------------------------------------------------------------------
         | Repertoire des images de tailles reduitess
         |----------------------------------------------------------------------
         */
         "thumbs" => $thumbnailsStoragePath
       ];
    }


    // public function setImageServer(){

    // }
}
