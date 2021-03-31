<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchTrait;

class Release extends Model
{
    use HasFactory;
    use SearchTrait;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [

    ];
}
