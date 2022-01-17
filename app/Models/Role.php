<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=['role_name'];
    protected $table = "roles";
    public function User(){
        return $this->hasMany(User::class,'role_id','id');
    }
}
