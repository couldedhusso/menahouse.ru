<?php

namespace App\Policies;

use DB;
use Cache;
use App\User;



use Illuminate\Auth\Access\HandlesAuthorization;
use Menahouse\Repositories\PolicyRepository;



class UserPolicy
{
    use HandlesAuthorization;

    protected $repos ;

    public function __construct(PolicyRepository $policyRepo){

        $this->repos = $policyRepo;

    }


    public function owner($user){

       //  TODO :: Voir s il est possible d utiliser un systeme de softdelete pour empecher
       //  qu un user enregistre plusieur appart en supprimant les anciens

       return $this->repos->isOwner($user);

    }

    public function wasbanned($user){

        return $this->repos->wasBanned($user);
    }

    public function update($user){

        return $this->repos->canUpdate($user);
    }

    public function cannotupdate($user){
        if ($this->update($user)){
            return false ;
        }
        return true ;
    }

}
