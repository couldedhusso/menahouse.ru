<?php

namespace App\Http\Middleware;

use Gate;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Policies\UserMessagePolicy;


class MailboxAccess
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $policies;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth, UserMessagePolicy $umspolicy)
    {
        $this->auth = $auth;
        $this->policies = $umspolicy;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!$this->policies->validSubscriptionPlan($request->user()->id)){
            return redirect('subscription-plan');
        }

        // if (Gate::denies('valid', $request->user()->id)){
        //     return redirect('subscription-plan');
        // }

        return $next($request);
    }
}
