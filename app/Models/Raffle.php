<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    use HasFactory;

    public function names()
    {
        return $this->hasMany('App\Models\Name');
    }

    public function prizes()
    {
        return $this->hasMany('App\Models\Prize');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }
}
