<?php namespace App\Http\Transformers;

use App\Images;
use League\Fractal\TransformerAbstract;


class ImageTransformer extends TransformerAbstract
{
    
    public function transform(Images $model)
    {
        return [
            'id' => $model->id,
            'source' => $model->path
        ];
    }
}
