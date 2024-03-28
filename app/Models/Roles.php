<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Roles extends Model
{
    use HasFactory;
    protected $table ='role_users';
    protected $guarded =['id'];

   
    public function User(): HasMany
    {
        return $this->hasMany(User::class,'role_users_id');
    }
}
