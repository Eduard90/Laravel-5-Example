<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = "feedback";

    protected $fillable = [
        'user_id', 'text'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
