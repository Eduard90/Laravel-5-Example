<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Auth;

use App\Setting;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct() {
        $balance = Auth::user()->balance_display();
        view()->share('user_balance', $balance);

        $products = Auth::user()->list_active_products;
        view()->share('user_need_products', count($products));

        $members = Setting::get('members', '23 541');
        view()->share('members', $members);

        $best_member = Setting::get('best_member', 'Andrey87 - 3 400 руб.');
        view()->share('best_member', $best_member);
    }
}
