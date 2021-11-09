<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Permission;
use App\Apllication;
use App\Policies\ApllicationPolicy;
use App\Policies\PermissionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
		Apllication::class => ApllicationPolicy::class,
		Permission::class => PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
		
		Gate::define( 'client_view', function($user){
			return $user->canDo( 'client_view' ); 
		} );
		
		Gate::define( 'client_create', function($user){
			return $user->canDo( 'client_create' ); 
		} );
		
		Gate::define( 'moderator_view', function($user){
			return $user->canDo( 'moderator_view' ); 
		} );
		
		Gate::define( 'moderator_update', function($user){
			return $user->canDo( 'moderator_update' ); 
		} );
		
		Gate::define( 'moderator_create', function($user){
			return $user->canDo( 'moderator_create' ); 
		} );

        //
    }
}
