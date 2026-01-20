<?php

namespace App\Models\Concerns;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToTenant
{
    public static function bootBelongsToTenant()
    {
        // This automatically adds "where tenant_id = ..." to every query
        static::addGlobalScope("tenant", function (Builder $builder) {
            if (Tenant::current()) {
                $builder->where("tenant_id", Tenant::current()->id);
            }
        });

        // This automatically sets the tenant_id when you create a new record
        static::creating(function ($model) {
            if (Tenant::current() && !$model->tenant_id) {
                $model->tenant_id = Tenant::current()->id;
            }
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
