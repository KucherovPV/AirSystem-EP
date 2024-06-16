<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 0;
    const ROLE_ANALYST = 1;
    const ROLE_OPERATOR = 2;

    private static array $roles = [
        self::ROLE_ADMIN => 'admin',
        self::ROLE_ANALYST => 'analyst',
        self::ROLE_OPERATOR => 'operator',
    ];

    public static function getRoles()
    {
        return self::$roles;
    }

    public function getRole()
    {
        return self::$roles[$this->role];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //protected $guard_name = 'api';

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'role',
        'email',
        'password',
    ];

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
        'password' => 'hashed',
    ];
}
