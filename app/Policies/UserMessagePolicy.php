<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Menahouse\Repositories\PolicyRepository;

class UserMessagePolicy
{
   use HandlesAuthorization;

    protected $repos ;

    public function __construct(PolicyRepository $repo){

        $this->repos = $repo;

    }

    public function canwriteto($from, $to){

        return $this->repos->canwrite($from, $to);
    }

    public function canNotSend($from, $to){

        return $this->repos->canNotSendMessage($from, $to);
     }

    public function Valid($from){
        
        return $this->repos->Subscribed($from);
     }

     public function validSubscriptionPlan($from){
        
        return $this->repos->Subscribed($from);
     }
}
