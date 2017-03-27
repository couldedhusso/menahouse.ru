<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Cache;
use Session;

use App\User;
use App\Obivlenie;

use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Transformers\UserTransformer;
use App\Http\Transformers\HomeTransformer;

use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;

use Menahouse\Contracts\AdvertiseInterface;


class ObivlenieController extends Controller
{
    use Helpers;

    protected $repos ;

    public function __construct(AdvertiseInterface $repos){
        $this->repos = $repos;
    }


    public function index(Request $request) : Response {
        $users =  User::paginate(3);
        //  if($request->has('page')){
        //   dd($request->query('page') );
        //  }
        return $this->response->paginator($users, new UserTransformer);
    }


    public function getHomeByType(Request $request) : Response {

        /// $request->get('page') or $request->query('page')
        $page = $request->has('page') ? $request->query('page') : 1;

        $home =  $this->repos->housesByType($page);

        return $this->response->paginator($home, new HomeTransformer);
    }

    public function favorisUser(Request $request) : Response{
        $page = $request->has('page') ? $request->query('page') : 1;
        $favoris =  $this->repos->getbookmarks($page);
        return $this->response->paginator($favoris);
    }


    public function userFavoris(Request $request) : Response{

        $favoris =  $this->repos->userBookmarks($request::all());

        if ($favoris){

            return $this->response->errorNotFound();
        }

        /// error
         return $this->response->error('Erreur lors de l execution.', 404);


    }


     public function informationAppart(Request $request){

          
        $id = $request->query('id');
        $appart =  $this->repos->appartDetails($id);

        return $this->response->item($appart, new HomeTransformer);

     }


     public function recherchesAppartements(Request $request) : Response {

        $params = (Session::get('menahouseUserQuery'));
        $page = $request->has('page') ? $request->query('page') : 1;

        $apparts =  $this->repos->resultatRecherches($page);
        if (!$apparts) return $this->response->noContent();

        //dd($this->response->paginator($apparts, new HomeTransformer));

        return $this->response->paginator($apparts, new HomeTransformer);
    }

    public function favoris(Request $request) : Response {
        $page = $request->has('page') ? $request->query('page') : 1;
        $apparts =  $this->repos->favorisUtilisateur($page);

        return $this->response->paginator($apparts, new HomeTransformer);
    }

    public function ajoutFavoris(Request $request) : Response {

        // 'api/add/favoris?userid=x&houseid = y';
        // return $this->repos->ajouterAuxFavoris($request);
        $bookmark =  $this->repos->ajouterAuxFavoris($request);
        
        $reponse = $this->response->noContent();

        if($bookmark){

            $reponse = $this->response->created();
        }
        return $reponse;

        // dd($reponse);

    }

    public function obyavlenieUtilisateur(Request $request) : Response {

        // 'api/add/favoris?userid=x&houseid = y';
        $appart =  $this->repos->obyavlenie();

        return $this->response->item($appart, new HomeTransformer);
    }

    public function  obyavlenieUtilisateurBySupport(Request $request) : Response {

        // 'api/add/favoris?userid=x&houseid = y';
        $appart =  $this->repos->userObyavlenie($request);

        return $this->response->item($appart, new HomeTransformer);
    }


   

}
