<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UserController;

use App\User;

use Auth;

class MainController extends UserController {

    public function index()
    {
//         var_dump(Auth::user());
        $products = Auth::user()->list_active_products;

        return view('index', ['active_page' => 'index', 'products' => $products]);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
