<?php

namespace App\Models;

use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as StanclTenant;

class Tenant extends StanclTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public function domains()
    {
        return $this->hasMany(\App\Models\Domain::class);
    }
}
