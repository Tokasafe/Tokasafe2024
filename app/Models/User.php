<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;

class User extends Authenticatable implements LdapAuthenticatable
{
    use HasApiTokens, HasFactory, Notifiable, AuthenticatesWithLdap;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function getLdapDomainColumn(): string
    {
        return 'domain';
    }

    public function getLdapGuidColumn(): string
    {
        return 'guid';
    }

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'roles_id'
    ];
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Roles()
    {
        return $this->belongsTo(Roles::class,'role_users_id');
    }
    public function companies()
    {
        return $this->belongsToMany(Companies::class, 'admin_control_company_manhours');
    }

    public function scopeSearchUsers($query, $term)
    {

        $query->where('name', 'LIKE', '%' . $term . '%');
    }
    public function scopeSearchcompany($query, $term)
    {
        $query->whereHas('companies', function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%');
        });

    }
}
