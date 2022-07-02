<?php

namespace PterodactylCN\Addon\ApiFix;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use PterodactylCN\Addon\ApiFix\Middleware\ApiAllowCors;

class ApiFixServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app[Kernel::class]->prependMiddleware(ApiAllowCors::class);
    }
}
