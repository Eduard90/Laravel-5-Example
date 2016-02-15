<?php

use Illuminate\Database\Seeder;

use App\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['key' => 'rub_course', 'value' => 1]);
        Setting::create(['key' => 'usd_course', 'value' => 78]);
        Setting::create(['key' => 'eur_course', 'value' => 87]);
    }
}
