<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UserController;

use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingsController extends UserController {

    public function index()
    {
        return view('settings', ['active_page' => 'settings', 'user' => Auth::user()]);
    }

    /**
     * Сохранение настроек
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(Request $request)
    {
        $user = Auth::user();
        $lang = 'ru';
        $currency = $request->get('currency', 'rub');
        $user->lang = $lang;
        $user->currency = $currency;
        $user->save();
        return redirect('/settings')->with('message', 'Настройки успешно сохранены.');

    }
}
