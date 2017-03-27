<?php

namespace App\Http\Controllers\Api\V1;

use DB;
use Cache;
use Session;


use Illuminate\Support\Collection;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;

use Menahouse\Contracts\CitiesInterface;


class CitiesController extends Controller
{
    use Helpers;

    protected $repos ;

    public function __construct(CitiesInterface $repos){
        $this->repos = $repos;
    }

    public function index(Request $request) : Response {
        $cities =  $this->repos->getCities();
        return $this->response->array($cities);
    }

    public function getDistrictByCity(Request $request) : Response {
        $id_city = $request->query('id');
        $districts =  $this->repos->getDistricts($id_city);
        return $this->response->array($districts);
    }

}
