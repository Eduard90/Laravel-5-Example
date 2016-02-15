<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use SleepingOwl\Admin\Traits\OrderableModel;

class Product extends Model
{
    protected $fillable = [
        'title', 'ym_url', 'ym_id', 'image_url'
    ];
    //
}
