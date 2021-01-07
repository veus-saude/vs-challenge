<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // update this line
    CONST STATUS_INACTIVE = 0;
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_ADMIN = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getStatusesText(){
        return [
            self::STATUS_INACTIVE => "Inactive",
            self::STATUS_ACTIVE => "Active",
            self::STATUS_ADMIN => "Admin",
        ];
    }

    public function getStatusText(){
        return $this->getStatusesText()[$this->status];
    }
}
