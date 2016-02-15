<?php

namespace App\Exceptions;

use Exception;

/**
 * Исключение если отзыв слишком короткий
 * Class ShortReviewException
 * @package App\Exceptions
 */
class ShortReviewException extends Exception
{
    protected $message = "Введите не менее 5ти слов";
}