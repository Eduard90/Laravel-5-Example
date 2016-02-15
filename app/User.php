<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Setting;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products() {
        return $this->hasMany('App\UserProduct');
    }

    /**
     * Баланс пользователя в валюте пользователя
     * @return float
     */
    public function balance_currency() {
        $currency = $this->currency;
        $course = Setting::get($currency.'_course', 1);
        $balance = $this->balance / $course;
        return $balance;
    }

    /**
     * "Display" метод для баланса
     * @return string
     */
    public function balance_display() {
        $currency = $this->currency;
        $balance = $this->balance_currency();
        $balance *= 2;
        $balance_format = number_format( $balance, 2, '.', ' ' );

        $balance_display = "";

        switch($currency) {
            case 'rub': $balance_display = $balance_format . " руб."; break;
            case 'usd': $balance_display = $balance_format . " USD"; break;
            case 'eur': $balance_display = $balance_format . " EUR"; break;
            default: $balance_display = $balance_format . " руб.";
        }

        return $balance_display;
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    public function list_products() {
        return $this->belongsToMany('App\Product', 'user_product');
    }

    public function list_active_products() {
        return $this->belongsToMany('App\Product', 'user_product')->where('review', '=', null);
    }
}
