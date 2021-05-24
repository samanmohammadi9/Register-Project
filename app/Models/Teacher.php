<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $guard = 'student';

    protected $fillable=[
        'first_name','last_name','email','password','email_verified_at'
    ];

    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
}
