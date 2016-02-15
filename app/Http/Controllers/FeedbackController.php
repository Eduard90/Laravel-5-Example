<?php
namespace App\Http\Controllers;

use App\Http\Controllers\UserController;

use App\User;
use App\Feedback;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FeedbackController extends UserController {

    public function index()
    {
        return view('feedback', ['active_page' => 'feedback']);
    }

    /**
     * Сохранение отзыва
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postFeedback(Request $request)
    {
        $text = $request->get('text', '');

        if (!empty($text) && strlen($text) > 10 && strlen($text) < 1000) {
            $user_id = Auth::user()->id;
            $feedback = Feedback::create(['user_id' => $user_id, 'text' => $text]);

            if ($feedback) {
                return redirect('/feedback')->with('message', 'Ваш запрос успешно отправлен.');
            }
        }

        return redirect('/feedback')->with('errors', 'Введите текст запроса (не менее 10 символов).');
    }
}
