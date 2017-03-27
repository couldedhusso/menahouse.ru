<?php namespace App\Http\Transformers;

use App\Bookmarked;
use League\Fractal\TransformerAbstract;


class FavorisTransformer extends TransformerAbstract
{
    public function transform(Bookmarked $favoris) {
        return [
            'date_ajout' => $favoris->created_at->format('Y-m-d')
        ];
    }
}
