<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\TenancyServiceProvider::class,
    Nwidart\Modules\LaravelModulesServiceProvider::class,
    Modules\Core\Providers\CoreServiceProvider::class,
    Modules\School\Providers\SchoolServiceProvider::class,
];
