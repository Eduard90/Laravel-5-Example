<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value'
    ];

    public $timestamps = false;

    /**
     * Получение значения параметра по ключу $key
     * @param string $key Ключ
     * @param string $default Дефолтное значение
     * @return string
     */
    public static function get($key = '', $default = '')
    {
        if ($key) {
            $setting = self::where('key', '=', $key)->first();
            if ($setting) {
                return $setting->value;
            }
        }

        return $default;
    }
}
