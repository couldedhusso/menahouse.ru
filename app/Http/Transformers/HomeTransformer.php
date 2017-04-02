<?php namespace App\Http\Transformers;

use Auth;
use App\Obivlenie;
use App\Bookmarked;
use App\Http\Transformers\ImageTransformer;
use App\Http\Transformers\FavorisTransformer;
use League\Fractal\TransformerAbstract;

use Dingo\Api\Http\Response;



class HomeTransformer extends TransformerAbstract
{



    protected $availableIncludes = ['images', 'favoris'];
    // protected $availableIncludes = ['favoris'];


    public function transform(Obivlenie $home) {
        return [
            'id' => $home->id,
            'uuid' => $home->uuid,
            'dom' => $home->dom,
            'gorod' => $home->getVille($home->gorod)->name,
            'rayon' => (null !== $home->getDistrict($home->rayon, $home->gorod)) ? 
                                 $home->getDistrict($home->rayon, $home->gorod)->name  : '-',
            'metro' => $home->metro,
            'ulitsa' =>  $home->ulitsa,
            'rooms' => $home->kolitchestvo_komnat,
            'etazh' => $home->etazh,
            'san_usel' =>  $home->san_usel,
            'tekct_obivlenia' => $home->tekct_obivlenia,
            'etajnost_doma'  => $home->etajnost_doma,
            'roof' =>  $home->roof,
            'etage' =>  $home->etazh .'/'.$home->etajnost_doma,
            'superficie_living_room' => $home->zhilaya_ploshad,
            'superficie_totale' => $home->obshaya_ploshad,
            'superficie_cuisine' => $home->ploshad_kurhni,
            'price' => number_format($home->price,2, ',', ' '),
            'doplata' => number_format($home->doplata, 2, ',', ' ') ,
            'nbr_vue' => $home->numberclick,
            'owner' => $home->user_id,
            'date_favoris' => $this->dateFavoris($home),
            'data_pub' => $home->created_at->format('Y-m-d'),
            'link' => $this->appartUrl($home),
            'type_nedvizhimosti'=> $home->type_nedvizhimosti,
            'tseli_obmena'=> $home->tseli_obmena,
            'doplata_'=> $home->doplata,
            'mestopolozhenie_obmena' => $home->mestopolozhenie_obmena,
            'price_'=> $home->price,
            'thumb' => $home->getObvThumbnail($home->id),
            'status' => ($home->status == 1) ? 'Обмен' : 'Обмен продажа',
            'type_appart' => $this->HouseCategorie($home->kolitchestvo_komnat,
                                                    $home->type_nedvizhimosti),
            'entete_annonce' => $this->typeHouse($home->kolitchestvo_komnat,
                                                    $home->type_nedvizhimosti)
        ];
    }


    public function includeImages($model){
        $imagesObivlenie = $model->images()->get();
        return $this->collection($imagesObivlenie, new ImageTransformer);
    }


    public function dateFavoris($model){

        $favoris =  Bookmarked::where([
                                'user_id' => Auth::id(),
                                'obivlenie_id' => $model->id
                            ])->first();

        if (is_null($favoris)) {
            return "-";
        } else{
            return $favoris->created_at->format('Y-m-d');
        }

        
    }

    public function includeObvThumbnail(Oblivlenie $model){
        $thumbnailObivlenie = $model->obvthumbnail()->first();

        return $this->item($thumbnailObivlenie, new ImageTransformer);
    }


     private function typeHouse($number_room , $type_nedvizhimosti){

        $TYPE_OBJECT = ['2', '3'];

        $room = function() use($number_room){
          switch ($number_room) {
            case '1':

              $tpRoom = "однокомнатная ";
              break;
            case '2':

              $tpRoom = "2х комнатная ";
              break;
            case '3':

              $tpRoom = "3х комнатная ";
              break;
           case '4':

                $tpRoom = "4х комнатная ";
                break;

            default:

              $tpRoom = "Студия";
              break;
          }

          return $tpRoom;
        };

        $isStudio = function() use($number_room, $room){
             return ($room($number_room) === "Студия") ? true : false ;
        };

        if (in_array($type_nedvizhimosti, $TYPE_OBJECT)) {
            return  ($type_nedvizhimosti  === "2") ? "Комната" : "Дом" ;

        }else {

          $rm_object = $room($number_room);
          if ($type_nedvizhimosti  === "4") {
             $ret = (!$isStudio($number_room)) ? $rm_object."квартира в новостроике" : "Студия в новостроике" ;
          } else {
             $ret = (!$isStudio($number_room)) ? $rm_object."квартира" : "Студия" ;
          }

          return $ret;
        }
    }

    private function HouseCategorie ($nbr_rooms,  $type) {

        $tab_house = ['3' => 'Дом', '2' => 'Комната'];

        switch ($nbr_rooms) {
            case '1':

            $tproom = "1";
            break;
            case '2':

            $tproom = "2х";
            break;
            case '3':

            $tproom = "3х";
            break;
        case '4':

                $tproom = "4х";
                break;

            default:

            $tproom = "Студия";
            break;
      }


      if (1 == $type || 4 == $type){

          if ("Студия" !== $tproom){
                return $tproom .' ком. квартира';
          }else{
              return $tproom ;
          }
      }
       return $tab_house[$type];
    }


    public function appartUrl($model){

        $nbr_chambres =  [
                '1' => 'odnokomnatnye-kvartiry',
                '2' => 'dvuhkomnatnye-kvartiry',
                '3' => 'trehkomnatnye-kvartiry',
                '4' => 'chetyrehkomnatnye-kvartiry'
        ];

        $cities = [
            '1' => 'moskva',
            '2' => 'moskovskaya-oblast',
            '3' => 'novaya-Moskva',
        ];

        $st = [
            '1' => 'obmen',
            '2' => 'obmen-prodazha',
        ];
        
        if (3 == $model->type_nedvizhimosti){
            return $st[$model->status].'/'.strtolower($cities[$model->gorod]).'/'.'dom'.'='.$model->id;

        } else if (5 == $model->kolitchestvo_komnat){
            return $st[$model->status].'/'.strtolower($cities[$model->gorod]).'/'.'studia'.'='.$model->id;
        }

        return $st[$model->status].'/'.strtolower($cities[$model->gorod]).'/'.'kvartira'.'='.$model->id;

    }

    //  +"id": 164,
    //    +"metro": "Беляево",
    //    +"ulitsa": "ул. миклухо-маклаяб Д. 19",
    //    +"dom": null,
    //    +"stroenie": null,
    //    +"gorod": "Московская область",
    //    +"type_nedvizhimosti": "Частный дом",
    //    +"rayon": "-",
    //    +"tekct_obivlenia": "Укажите точную информацию о вашей квартире или доме в полном соответствии",
    //    +"kolitchestvo_komnat": null,
    //    +"etajnost_doma": 20,
    //    +"zhilaya_ploshad": 49,
    //    +"obshaya_ploshad": 170,
    //    +"ploshad_kurhni": 20,
    //    +"etazh": 3,
    //    +"price": 20000000,
    //    +"status": "Обмен",
    //    +"categorie_id": null,
    //    +"user_id": 45,
    //    +"created_at": "2016-09-12 15:50:26",
    //    +"updated_at": "2016-09-13 20:16:54",
    //    +"san_usel": "Совмещенный",
    //    +"rating": null,
    //    +"title": null,
    //    +"description": null,
    //    +"mestopolozhenie_obmena": "В_своём_районе",
    //    +"available": 1,
    //    +"predpolozhitelnaya_tsena": null,
    //    +"doplata": "300000.00",
    //    +"tseli_obmena": "На_увеличение",
    //    +"addres": null,
    //    +"numberclick": 7,
    //    +"roof": "2",
}
