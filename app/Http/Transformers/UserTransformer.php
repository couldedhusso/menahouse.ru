<?php namespace App\Http\Transformers;


use App\User;

use League\Fractal\TransformerAbstract;



class UserTransformer extends TransformerAbstract
{
    public function transform(User $user) {
        return [
            'imia' => $user->imia,
            'familia' => $user->familia,
            'otchestvo' => $user->otchestvo,
            'mail' => $user->email,
        ];
    }
}
