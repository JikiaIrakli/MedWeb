<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $table = 'researches';
    protected $primaryKey = 'id'; // assuming 'id' is the primary key

    protected $fillable = ['name'];
}