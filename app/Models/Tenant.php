<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ["name", "slug", "email", "password"];

    //tells spatie -> look at the slug.
    public function getTenantKeyName(): string
    {
        return "slug";
    }
}
