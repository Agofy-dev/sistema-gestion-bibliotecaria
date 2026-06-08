<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Permission;
use App\Models\RolePermission;

class Role extends Model
{
    protected $fillable = [
        'key',
        'name',
        'description',
        'status',
        'disabled',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    public function addPermission(Permission $permission): RolePermission
    {
        $relation = new RolePermission();
        $relation->role_id = $this->id;
        $relation->permission_id = $permission->id;
        $relation->save();

        return $relation;
    }
}
