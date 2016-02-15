<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

use App\Product;
use App\User;
use App\UserProduct;

use SleepingOwl\Admin\Admin;


class AdminController extends Controller {

    public function getSendProducts() {
        $users = User::all();
        $count_users = count($users);
        $count_success = 0;
        $max_products_per_user = config('main.max_products_per_user', 3);
        foreach($users as $key => $user) {
            $active_products = $user->list_active_products;
            $count_active_products = count($active_products);
            if ($count_active_products >= 0 && $count_active_products < $max_products_per_user) {
                $random_product = Product::orderByRaw("RAND()")->first();
                try {
                    $user_product = UserProduct::create(['user_id' => $user->id, 'product_id' => $random_product->id]);
                    $count_success++;
                } catch (QueryException $e) {
                    //Nothing
                }
            }
        }

        $result_str = "Раздача товаров...<br>Всего юзеров: " . $count_users . ". Успешно раздали: " . $count_success;

        return Admin::view($result_str, 'Раздача товаров');
    }
}