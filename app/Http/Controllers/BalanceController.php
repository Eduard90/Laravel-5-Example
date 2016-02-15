<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UserController;

use App\User;

use Illuminate\Support\Facades\Auth;

class BalanceController extends UserController {

    public function index()
    {
        $balance = Auth::user()->balance;
        $need_balance = (floor($balance/1000) * 1000 * 2) + 4000;

        $date = new \DateTime();
        $date_format = $date->format('d.m.Y');

        return view('balance', ['active_page' => 'balance', 'need_balance' => $need_balance, 'date_format' => $date_format]);
    }

    public function postIndex()
    {
//        $user = Auth::user();
//        $user->balance = 0;
//        $user->save();
//        return redirect()->intended('/balance')->with('message', 'Ваши средства успешно выведены. Спасибо за работу!');
        return redirect()->intended('/balance');
    }
}
