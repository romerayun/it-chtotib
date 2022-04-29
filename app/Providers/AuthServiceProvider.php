<?php

namespace App\Providers;

use App\Invoice;
use App\Policies\InvoicePolicy;
use App\Policies\SupplierPolicy;
use App\Policies\TypePolicy;
use App\Supplier;
use App\Type;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Type::class => TypePolicy::class,
        Supplier::class => SupplierPolicy::class,
        Invoice::class => InvoicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
