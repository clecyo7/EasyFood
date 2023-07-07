<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['name', 'description'];


    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Roles not linked with this user
     */
    public function roleAvailable($filter = null)
    {
        $permissions = Role::whereNotIn('roles.id', function($query) {
            $query->select('roler_user.permission_id');
            $query->from('roler_user');
            $query->whereRaw("roler_user.user_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('roles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissions;
    }
}
