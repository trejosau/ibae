<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    protected $table = 'users';


    protected $fillable = [
        'username',
        'email',
        'password',
        'email_verified_at',
        'remember_token',
        'estado',
        'password',
        'remember_token'
    ];







}
