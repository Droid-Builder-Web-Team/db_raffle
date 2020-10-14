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

    public function names_left()
    {
        return $this->hasMany('App\Models\Name')->where('picked', 0);
    }

    public function prizes_left()
    {
        return $this->hasMany('App\Models\Prize')->where('picked', 0);
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
