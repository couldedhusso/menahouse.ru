<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Response\FractalResponse;
use League\Fractal\TransformerAbstract;


abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $fractal;

    public function __construct(FractalResponse $fractal){
        $this->fractal = $fractal;
    }

    //   /**
    //   * @param $data
    //   * @param TransformerAbstract $transformer
    //   * @param null $resourceKey
    //   * @return array
    //   */
    // public function item($data, TransformerAbstract $transformer, $resourceKey = null )
    // {
    //     return $this->fractal->item($data, $transformer, $resourceKey);
    // }
    //   /**
    //   * @param $data
    //   * @param TransformerAbstract $transformer
    //   * @param null $resourceKey
    //   * @return array
    //   */
    // public function collection($data, TransformerAbstract $transformer, $resourceKey = null )
    // {
    //     return $this->fractal->collection($data, $transformer, $resourceKey);
    // }
}
