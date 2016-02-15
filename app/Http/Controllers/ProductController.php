<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UserController;

use App\Product;
use App\User;
use App\UserProduct;
use App\Exceptions\ShortReviewException;
use App\Exceptions\InternalReviewException;
use App\Exceptions\AlreadyReviewException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductController extends UserController {

    /**
     * Отправка информации о товаре в виде JSON
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getProduct(Request $request)
    {
        if (!$request->ajax()) {
            return response("", 403);
        }

        $product_id = (int)$request->get('id', 0);
        if ($product_id && is_int($product_id)) {
            $product = Product::find($product_id);

            if ($product) {
                $product_ar = ['id' => $product->id, 'title' => $product->title, 'ym_url' => $product->ym_url, 'image_url' => $product->image_url];
                return response()->json($product_ar);
            }
        }
    }

    /**
     * Обработка отправленного на товар отзыва
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function postReview(Request $request)
    {
        if (!$request->ajax()) {
            return response("", 403);
        }

        $result = ['ok' => 0, 'errors' => ''];
        $product_id = (int)$request->get('product_id', 0);
        $review = $request->get('review', '');
        $user_id = Auth::user()->id;

        $words_count = count(preg_split('~[^\p{L}\p{N}\']+~u', $review));

        try {
            if ($words_count < 5) {
                throw new ShortReviewException();
            }

            $user_product = UserProduct::where('user_id', $user_id)->where('product_id', $product_id)->first();
            if (!$user_product) {
                throw new InternalReviewException();
            }
            if (!empty($user_product->review)) {
                throw new AlreadyReviewException();
            }

            $user_product->review = $review;
            $user_product->status = 'M';
            $user_product->sum = $words_count * 1; //Maybe 2 rub?
            $user_product->save();

            //TODO: Create model method for recalc balance
            $balance = 0;
            $products = Auth::user()->products;
            foreach($products as $product) {
                $balance += $product->sum;
            }
            Auth::user()->balance = $balance;
            Auth::user()->save();

            $result['ok'] = 1;

        } catch (ShortReviewException $e) {
            $result['errors'] = $e->getMessage();
        } catch (InternalReviewException $e) {
            //TODO: Need logging ...
            $result['errors'] = $e->getMessage();
        } catch (AlreadyReviewException $e) {
            $result['errors'] = $e->getMessage();
        }

        return response()->json($result);
    }
}
